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
        // $query = Transfer::query()
        // ->where('is_delete', 0);
         
        // $totalRecords = $query->count();
        // $transfers = $query
        // // ->orderBy($sortColumn, $sortOrder)
        // ->skip(($page - 1) * $perPage)
        // ->take($perPage)
        // ->get();
        
        // $transfers = collect();

        // foreach ($transfers as $transfer) {
        //     $trans_Ids = explode(',', $transfer->trans_ids);
        //     $transactions = Transactions::whereIn('trans_id', $trans_Ids)
        //     ->with('items_trans','items.colors','orders_trans') 
        //     ->where('is_delete',0)
        //     ->get()
        //     ->filter(function ($transaction) {
        //         return !$transaction->orders_trans->isEmpty();
        //     })
        //     ->values();
        //     if (!$transactions->isEmpty()) {
        //         $transfer->transactions = $transactions->toArray();
                
        //     }
        
            
        // }
        // dd($transfers->toArray());
        
        // $transfers->each(function ($transfer, $index) {
        //     $transfer->serial_number = $index + 1; 
        //     $transfer->trans_at    = Carbon::parse($transfer->created_at)->format('d-m-Y');
            
        // });
 

        $query = Transfer::query()
            ->where('is_delete', 0)->orderBy($sortColumn, $sortOrder);

        // Only needed if you want total **before filtering**
        $rawTotal = $query->count();

        $rawTransfers = $query
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        $filteredTransfers = collect();

        foreach ($rawTransfers as $transfer) {
            $trans_Ids = explode(',', $transfer->trans_ids);

            $transactions = Transactions::whereIn('trans_id', $trans_Ids)
                ->with('items_trans', 'items.colors', 'orders_trans')
                ->where('is_delete', 0)
                ->get()
                ->filter(function ($transaction) {
                    return !$transaction->orders_trans->isEmpty();
                })
                ->values();

            // if (!$transactions->isEmpty()) {
                $transfer->transactions = $transactions->toArray();
                $filteredTransfers->push($transfer);
            // }
        }

        // Update serial number and date
        $filteredTransfers->each(function ($transfer, $index) {
            $transfer->serial_number = $index + 1;
            $transfer->trans_at = Carbon::parse($transfer->created_at)->format('d-m-Y');
        });
     
        // Update total count **after filtering**
        $totalFiltered = $filteredTransfers->count();

         
        return response()->json([
            'status' => 200,
            'message' => 'Transfer list fetched successfully!',
            'data'    =>  $filteredTransfers,
            
            'draw' => intval($request->input('draw')),

            'recordsTotal'        => $rawTotal,
            'recordsFiltered' => $rawTotal,
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages' => ceil($rawTotal / $perPage),
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
                'from_branch.branch_address AS from_branch_address',
                'to_branch.branch_address AS to_branch_address',
            ) 
            ->get();
            $transfer->transactions = $transactions->toArray();
        }
        $transfer_type = '';
        if($transferQuery[0]['multiple_transfer_type'] == 1){
            $transfer_type = 'Issue for Karagir';
        }else{
            $transfer_type = 'Issue for Hallmarking';
        }
        $transfer_array = $transferQuery->toArray();
        
        // dd($transfer_array);
        return view('orders/transfer_receipt_latest',compact('pageTitle','login','activePage','user_branch','user_permissions','activeBranchName','transfer_array','transfer_type'));

    }

    public function transfer_receipt_pdf(Request $request, $id){
        $login = auth()->user();
        
        $transferQuery = Transfer::query()
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
                'from_branch.branch_address AS from_branch_address',
                'to_branch.branch_address AS to_branch_address',
            ) 
            ->get();
            $transfer->transactions = $transactions->toArray();
        }
        
        $transfer_type = '';
        if($transferQuery[0]['multiple_transfer_type'] == 1){
            $transfer_type = 'Issue for Karagir';
        }else{
            $transfer_type = 'Issue for Hallmarking';
        }
        
        $transfer_array = $transferQuery->toArray();
        $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
        
        $pdf = \PDF::loadView('orders.transfer_receipt_pdf', compact('transfer_array', 'transfer_type', 'firstTransaction'));
        
        return $pdf->stream('transfer_receipt.pdf');
    }



    public function transfer_receipt_edit(Request $request,$id){
        $pageTitle     = 'Transfer';
        $login         = auth()->user();
        $transfer      = Transfer::where('trans_id',$id)
        ->where('is_delete',0)
        ->first();
        $activePage       = 'transfer';
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
        
        $user_permissions = session('combined_permissions', []);

        return view('orders/transfer_receipt_edit',compact('pageTitle','login','transfer','user_permissions','activePage','user_branch','activeBranchName'));
    }



    public function transfer_receipt_save(Request $request){
        $params = $request->all();
        
        $rules = [
            'multiple_transfer_delivery_note'   => ['nullable', 'string'], 
            'multiple_transfer_type' => ['required', 'integer', 'min:1'], 
            'trans_id'     => ['required', 'integer'], 
        ];
    
        $messages = [
            'multiple_transfer_delivery_note.string'   => 'Delivery note must be a valid string.',
            'multiple_transfer_type.integer' => 'Transfer type must be a valid integer.',
            'multiple_transfer_type.min'     => 'Transfer type must be at least 1.',
            'trans_id.integer'     => 'Transfer id must be a valid integer.',
         ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0],
                'errors'  => $validator->errors(),
            ]);
        }
        $transfer = Transfer::where('trans_id',$params['trans_id'])
        ->where('is_delete',0)
        ->first();
        $transfer->multiple_transfer_delivery_note = $params['multiple_transfer_delivery_note'];
        $transfer->multiple_transfer_type = $params['multiple_transfer_type'];
        $transfer->save();
        return response()->json(['status' => 200, 'message' => 'Transfer receipt saved successfully!']);
        
    }

}
