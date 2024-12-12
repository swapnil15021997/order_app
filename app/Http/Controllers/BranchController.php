<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class BranchController extends Controller
{

    public function branch_index(Request $request){
        $login = auth()->user();
        $activePage = 'branch';

        $login = auth()->user();

        if(!empty($login)){
            $userBranchIds = explode(',', $login['user_branch_ids']);
        }
        $branch       = Branch::get_all_branch();
        $users_branch = Branch::whereIn('branch_id', $userBranchIds)->get()->toArray();
        
        return view('branch/branch_master',['pageTitle'=>'Branch','login'=>$login,'activePage'=>$activePage,'user_branch'=>$users_branch]);
    }
    public function add_edit_branch(Request $request){
        $params = $request->all();
        $user = auth()->user();

        // $token = $request->header('Authorization');

        // $session = DB::table('sessions')
        // ->where('session_token', $token)
        // ->where('session_status', 1) 
        // ->where('session_is_delete', false)
        // ->first();

        $rules = [   
            'branch_id'           => ['nullable','string'],
            'branch_name'         => ['required','string'],  
            'branch_address'      => ['nullable','string']
        ]; 
        $messages = [
            'branch_name.required'         => 'Branch name is required.',
            'branch_name.string'           => 'Branch name must be a string.',
            // 'branch_address.required'      => 'Please provide branch address',
            'branch_address.string'        => 'Please provide branch address'
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        if(empty($params['branch_id'])){
            $branch = new Branch();
            $branch->branch_name      = $params['branch_name'];
            $branch->branch_address   = $params['branch_address'];
            $branch->branch_added_by  = $user->id;
            $branch->save();
            return response()->json([
                'status' => 200,
                'message' => 'Branch added successfully' 
            ]);
        }else{
            $branch = Branch::find($params['branch_id']);
            if(empty($branch)){
                return response()->json([
                    'status'  => 500,
                    'message' => 'Branch not found' 
                ]);
            }
            $branch->branch_name      = $params['branch_name'];
            $branch->branch_address   = $params['branch_address'];
            $branch->save();
            return response()->json([
                'status' => 200,
                'message' => 'Branch updated successfully'
            ]);
        }
      
    }

    public function branch_list(Request $request){
        
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
    
        $searchQuery = $request->input('search', ''); 

        $perPage     = $request->input('per_page', 15);   
        $page        = $request->input('page', 1);  
        $offset      = ($page - 1) * $perPage;
  
        $branchQuery  = Branch::query()->where('is_delete',0);      
         
        if (!empty($searchQuery)) {
            $branchQuery->where(function ($query) use ($searchQuery) {
                $query->where('branch_name', 'like', "%{$searchQuery}%");
            });
        }
        $branchQuery->orderBy('branch_id', 'desc');
        $total_branches = $branchQuery->count();
        $branches = $branchQuery
            ->offset($offset)
            ->limit($perPage)
            ->get();
        $branches->each(function ($branches, $index) {
            $branches->serial_number = $index + 1; 
        });
        $total_pages = ceil($total_branches / $perPage);

        return response()->json([
            'status' => 200,
            'message' => 'Branch list fetched successfully!',
            'data'    => [
                'branches'     => $branches,
            ],
            'draw' => intval($request->input('draw')),

            'recordsTotal'        => $total_branches,
            'recordsFiltered' => $branches->count(),
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages'  => $total_pages,
        ]);
    }


    function change_active_branch(Request $request){
        $params = $request->all();
      
        $rules = [   
            'branch_id'           => ['required','string']
         ]; 
        $messages = [
            'branch_id.required'           => 'Branch id is required.',
        ]; 

        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $branch = Branch::find($params['branch_id']);
        if(empty($branch)){
            return response()->json([
                'status'  => 500,
                'message' => 'Branch not found' 
            ]);
        }
        $login = auth()->user()->toArray();

        $user = User::get_user_by_id($login['id']);
           
        $user->user_active_branch = $params['branch_id'];
        $user->save();
        return response()->json([
            'status'  => 200,
            'message' => 'Active branch updated successfully'
        ]);
    }
    

    public function branch_details(Request $request){
        $params = $request->all();
      
        $rules = [   
            'branch_id'           => ['required','string']
         ]; 
        $messages = [
            'branch_id.required'           => 'Branch id is required.',
            'branch_name.string'           => 'Branch id must be a string.'            
        ]; 

        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $branch = Branch::find($params['branch_id']);
        if(empty($branch)){
            return response()->json([
                'status'  => 500,
                'message' => 'Branch not found' 
            ]);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Branch details find successfully',
            'data'    => $branch
        ]);
    }

    public function branch_remove(Request $request){
        $params = $request->all();
      
        $rules = [   
            'branch_id'           => ['required','string']
         ]; 
        $messages = [
            'branch_id.required'           => 'Branch id is required.',
            'branch_name.string'           => 'Branch id must be a string.'            
        ]; 

        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $branch = Branch::find($params['branch_id']);
        if(empty($branch)){
            return response()->json([
                'status'  => 500,
                'message' => 'Branch not found' 
            ]);
        }
        $branch->is_delete      = 1;
        $branch->save();
        return response()->json([
            'status'  => 200,
            'message' => 'Branch removed successfully' 
        ]);
    }





}
