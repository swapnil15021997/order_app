<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Item;
use App\Models\File;
use App\Models\Transactions;
use App\Models\Payment;
use App\Models\Customers;
use App\Models\Colors;
use App\Models\TempOrders;
use App\Models\Notes;
use App\Models\Transfer;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class TransferController extends Controller
{
    

    public function transfer_index(Request $request){
        
        $pageTitle     = 'Transfer';
        $login         = auth()->user();
       
        if(!empty($login)){
            if($login['user_role_id'] != 1){

                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 
              
                if(!empty($userBranchIds)){

                    $user_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $user_branch  = [];
                }
                
            }else{
                $user_branch  = Branch::get_all_branch();
    
            }
            if(!empty($user_branch)){
                foreach ($user_branch as $branch) {
                    if ($branch['branch_id'] == $login['user_active_branch']) {
                        $activeBranchName = $branch['branch_name'];
                        break;
                    }
                }
            }
            $activeBranchName = '';

        }

        $activePage       = 'transfer';
        $user_permissions = session('combined_permissions', []);

        return view('orders/transfer_master',compact('pageTitle','login','activePage','user_branch','user_permissions','activeBranchName'));
    }


    public function transfer_list(Request $request){
        
        $rules = [
            'search'   => ['nullable', 'string'], 
            'per_page' => ['nullable', 'integer', 'min:1'], 
            'page'     => ['nullable', 'integer', 'min:1'], 
        ];
    
        $messages = [
            'search.string'   => 'Search query must be a valid string.',
            'per_page.integer' => 'Items per page must be a valid integer.',
            'per_page.min'     => 'Items per page must be at least 1.',
            'page.integer'     => 'Page number must be a valid integer.',
            'page.min'         => 'Page number must be at least 1.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0],
                'errors'  => $validator->errors(),
            ]);
        }
        
        $login   = auth()->user()->toArray();
       
        $searchQuery = $request->input('search', ''); 

        $perPage     = $request->input('per_page', 15);   
        $page        = $request->input('page', 1);  
        $offset      = ($page - 1) * $perPage;
        $sortColumn  = $request->input('sort', 'trans_id'); 
        $sortOrder   = $request->input('sortOrder', 'desc'); 

        $allowedSortColumns = ['trans_id'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'trans_id'; // Fallback to default
        }
        // if(!empty($login)){
        //     if ($login['user_role_id']!=1){

        //         $user_branch_ids = $login['user_branch_ids'];
        //         $branchIdsArray = explode(',', $user_branch_ids);
        
        //         $branchQuery  = Branch::query()->where('is_delete',0)
        //         ->whereIn('branch_id', $branchIdsArray);      
        //     }else{
        //         $branchQuery  = Branch::query()->where('is_delete',0);      

        //     }
        // }
        $transferQuery  = Transfer::query()
        ->where('is_delete',0)
        ->orderBy('trans_id', 'desc')
        ->get();
        foreach ($transferQuery as $transfer) {
            $trans_Ids = explode(',', $transfer->trans_ids);
            $transactions = Transactions::whereIn('trans_id', $trans_Ids)
            ->with('items','items.colors') 
            ->get();
            $transfer->transactions = $transactions->toArray();
        }
        
        // $transferQuery = Transactions::whereIn('trans_id', function($query) {
        //     $query->select(DB::raw('trans_id'))
        //         ->from('multiple_transfer')
        //         ->where('is_delete', 0)
        //     ->unionAll(
        //         Transfer::where('is_delete', 0)
        //             ->selectRaw('SUBSTRING_INDEX(SUBSTRING_INDEX(trans_ids, ",", n.digit + 1), ",", -1) as trans_id')
        //             ->crossJoin(DB::raw('(SELECT 0 digit UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3) n'))
        //             ->whereRaw('LENGTH(REPLACE(trans_ids, ",", "")) <= LENGTH(trans_ids) - n.digit')
        //     );
        // })->get();


        // // ->where(function ($query) use ($trans_ids) {
        //     foreach ($trans_ids as $transaction_id) {
        //         // Use FIND_IN_SET to check if the transaction_id exists in trans_ids
        //         $query->orWhereRaw("FIND_IN_SET(?, trans_ids) > 0", [$transaction_id]);
        //     }
        // });
        // if (!empty($searchQuery)) {
        //     $transferQuery->where(function ($query) use ($searchQuery) {
        //         $query->where('branch_name', 'like', "%{$searchQuery}%");
        //     });
        // }
        // $transferQuery->orderBy($sortColumn, $sortOrder);
        $total_branches = $transferQuery->count();
        // $branches = $transferQuery
        //     ->offset($offset)
        //     ->limit($perPage)
        //     ->get();
        $transferQuery->each(function ($transfer, $index) {
            $transfer->serial_number = $index + 1; 
            $transfer->trans_at    = Carbon::parse($transfer->created_at)->format('d-m-Y');
            
        });

        $total_pages = ceil($total_branches / $perPage);

        return response()->json([
            'status' => 200,
            'message' => 'Transfer list fetched successfully!',
            'data'    =>  $transferQuery,
            
            'draw' => intval($request->input('draw')),

            'recordsTotal'        => $transferQuery->count(),
            'recordsFiltered' => $total_branches,
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages'  => $total_pages,
        ]);
    }


    public function view_receipt(Request $request,$id){
        
         
        $pageTitle     = 'Transfer';
        $login         = auth()->user();
       
        if(!empty($login)){
            if($login['user_role_id'] != 1){

                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 
              
                if(!empty($userBranchIds)){

                    $user_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $user_branch  = [];
                }
                
            }else{
                $user_branch  = Branch::get_all_branch();
    
            }
            if(!empty($user_branch)){
                foreach ($user_branch as $branch) {
                    if ($branch['branch_id'] == $login['user_active_branch']) {
                        $activeBranchName = $branch['branch_name'];
                        break;
                    }
                }
            }
            $activeBranchName = '';

        }

        $activePage       = 'transfer';
        $user_permissions = session('combined_permissions', []);


        $transferQuery  = Transfer::query()
        ->where('is_delete',0)
        ->where('trans_id',$id)
        ->get();
        foreach ($transferQuery as $transfer) {
            $trans_Ids = explode(',', $transfer->trans_ids);
            $transactions = Transactions::whereIn('trans_id', $trans_Ids)
            ->leftJoin('branch AS from_branch', 'from_branch.branch_id', '=', 'transactions.trans_from')
            ->leftJoin('branch AS to_branch', 'to_branch.branch_id', '=', 'transactions.trans_to')        
            ->with('items','transUser', 'transApprovedBy','orders')
            ->select(
                'transactions.*',
                'from_branch.branch_name AS from_branch_name',
                'to_branch.branch_name AS to_branch_name',
            ) 
            ->get();
            $transfer->transactions = $transactions->toArray();
        }

        $transfer_array = $transferQuery->toArray();
        
        return view('orders/receipt',compact('pageTitle','login','activePage','user_branch','user_permissions','activeBranchName','transfer_array'));

    }


    public function transfer_receipt(Request $request,$id){
        $pageTitle     = 'Transfer';
        $login         = auth()->user();
       
        if(!empty($login)){
            if($login['user_role_id'] != 1){

                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 
              
                if(!empty($userBranchIds)){

                    $user_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $user_branch  = [];
                }
                
            }else{
                $user_branch  = Branch::get_all_branch();
    
            }
            if(!empty($user_branch)){
                foreach ($user_branch as $branch) {
                    if ($branch['branch_id'] == $login['user_active_branch']) {
                        $activeBranchName = $branch['branch_name'];
                        break;
                    }
                }
            }
            $activeBranchName = '';

        }

        $activePage       = 'transfer';
        $user_permissions = session('combined_permissions', []);


        $transferQuery  = Transfer::query()
        ->where('is_delete',0)
        ->where('trans_id',$id)
        ->get();
        foreach ($transferQuery as $transfer) {
            $trans_Ids = explode(',', $transfer->trans_ids);
            $transactions = Transactions::whereIn('trans_id', $trans_Ids)
            ->leftJoin('branch AS from_branch', 'from_branch.branch_id', '=', 'transactions.trans_from')
            ->leftJoin('branch AS to_branch', 'to_branch.branch_id', '=', 'transactions.trans_to')        
            ->with('items.colors','transUser', 'transApprovedBy','orders')
            ->select(
                'transactions.*',
                'from_branch.branch_name AS from_branch_name',
                'to_branch.branch_name AS to_branch_name',
            ) 
            ->get();
            $transfer->transactions = $transactions->toArray();
        }

        $transfer_array = $transferQuery->toArray();
        
        return view('orders/transfer_receipt',compact('pageTitle','login','activePage','user_branch','user_permissions','activeBranchName','transfer_array'));

    }
}
