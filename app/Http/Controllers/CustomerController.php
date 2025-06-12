<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
class CustomerController extends Controller
{
    //

    
    // Customer add edit ajax call
    public function add_edit_customer(Request $request){
        $params = $request->all();
        $user   = auth()->user();
        $rules = [   
            'customer_id'           => ['nullable','string'],
            'customer_name'         => ['required','string'],  
            'customer_phone_no'     => ['required','string','regex:/^\+?[0-9]{10,15}$/'],
            'customer_address'      => ['nullable','string']

        ]; 
        $messages = [
            'customer_name.required'         => 'Branch name is required.',
            'customer_name.string'           => 'Branch name must be a string.',
            'customer_phone_no.required'     => 'Please provide customer phone number.',
            'customer_address.string'        => 'Please provide branch address'
            
        ]; 
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 
        $combined_permissions = session('combined_permissions', []);

        if(empty($params['customer_id'])){
            if(! in_array(22 ,$combined_permissions)){
                return response()->json([
                    'status' => 500,
                    'message' => 'You dont have permission to add customer' 
                ]);
            }

            $customer = new Customers();
            $customer->cust_name     = $params['customer_name'];
            $customer->cust_phone_no = $params['customer_phone_no'];
            $customer->cust_address  = $params['customer_address'];
            $customer->save();
            return response()->json([
                'status'  => 200,
                'message' => 'Customer added successfully',
                'data'    => [
                    'cust_id'   => $customer->cust_id,
                    'cust_name' =>$customer->cust_name
                ]
            ]);
        }else{
            if(! in_array(21 ,$combined_permissions)){
                return response()->json([
                    'status' => 500,
                    'message' => 'You dont have permission to update customer' 
                ]);
            }

            $customer = Customers::find($params['customer_id']);
            if(empty($customer)){
                return response()->json([
                    'status'  => 500,
                    'message' => 'Customer not found' 
                ]);
            }
            $customer->cust_name      = $params['customer_name'];
            $customer->cust_address   = $params['customer_address'];
            $customer->cust_phone_no   = $params['customer_phone_no'];
            
            $customer->save();
            return response()->json([
                'status' => 200,
                'message' => 'Customer updated successfully'
            ]);
        }
      
    }

    // Branch List ajax
    public function customer_list(Request $request){
        
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
        if($login['user_role_id'] != 1){
            $user_permissions = session('combined_permissions', []);
            
            if (!in_array(20, $user_permissions)) {
                
                // return redirect()->route('dashboard')->with('error', 'You are not allowed to view order');
                    return response()->json([
                    'status' => 'error',
                    'message' => 'You are not allowed to view customer list'
                ]);
            }
        }
    
        $searchQuery = $request->input('search', ''); 

        $perPage     = $request->input('per_page', 15);   
        $page        = $request->input('page', 1);  
        $offset      = ($page - 1) * $perPage;
  
        $custQuery  = Customers::query()->where('is_delete',0);      
         
        if (!empty($searchQuery)) {
            $custQuery->where(function ($query) use ($searchQuery) {
                $query->where('cust_name', 'like', "%{$searchQuery}%");
            });
        }
        $custQuery->orderBy('cust_id', 'desc');
        $total_cust = $custQuery->count();
        $cust = $custQuery
            ->offset($offset)
            ->limit($perPage)
            ->get();
        $cust->each(function ($cust, $index) {
            $cust->serial_number = $index + 1; 
        });
        $total_pages = ceil($total_cust / $perPage);

        return response()->json([
            'status' => 200,
            'message' => 'Customer list fetched successfully!',
            'data'    => [
                'cust'     => $cust,
            ],
            'draw' => intval($request->input('draw')),

            'recordsTotal'        => $total_cust,
            'recordsFiltered' => $cust->count(),
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages'  => $total_pages,
        ]);
    }

    
}
