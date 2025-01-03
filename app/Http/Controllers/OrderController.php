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
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Jobs\SendEmailJob;
use App\Jobs\SendNotification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class OrderController extends Controller
{

    public function view_order(Request $request,$id){

        $order = Order::get_order_by_qr_number_id($id);  
        $order = $order->toArray();
        
        $login = auth()->user();
        
        $fileArray = [];
        if(!empty($login)){
           
            if($login['user_role_id'] != 1){

                $userBranchIds = explode(',', $login['user_branch_ids']);
                $userBranchIds = array_map('trim', $userBranchIds); 
                $userBranchIds = array_filter($userBranchIds); 
              
                if(!empty($userBranchIds)){

                    $users_branch  = Branch::get_users_branch($userBranchIds);
                }else{
                    $users_branch  = [];
                }

                
            }else{
                $users_branch  = Branch::get_all_branch();
    
            }
        }
        if(!empty($users_branch)){
            foreach ($users_branch as $branch) {
                if ($branch['branch_id'] == $login['user_active_branch']) {
                    $activeBranchName = $branch['branch_name'];
                    break;
                }
            }
            $activeBranchName = '';
        }else{
            $activeBranchName ='';
        }
        if (!empty($order['items'][0]['files'])){
            $fileArray = $order['items'][0]['files']->toArray();
        }

        $customer_order = [];
        if(!empty($order['order_customer_id'])){
            $customer_order = Customers::get_cust_by_id($order['order_customer_id']);
        }
        $payment = [];
        if($order['order_type']==1){
            $payment = Payment::get_payment_by_id($order['order_id']);
        }
        $activePage       = 'orders';
        
        $user_permissions = session('combined_permissions', []);
        if($order['order_type']==1){
            $type = 'Order';
        }else{
            $type = 'Reparing';
        }
        // $qr_code = QrCode::size(50)->generate(
        //     implode('|', [
        //         $order['order_qr_code']
        //     ])
        // ); 
        $orderUrl = route('order_get_approve', ['id' => $order['order_qr_code']]);
        $qr_code = QrCode::size(50)->generate($orderUrl);
        return view('orders/view_order',['order'=>$order,'fileArray'=>$fileArray,
            'pageTitle'=>'Order','login'=>$login,'activePage'=>$activePage,
            'user_branch'=>$users_branch,'user_permissions'=>$user_permissions,
            'customer_order'=>$customer_order,'payment'=>$payment,'qr_code'=>$qr_code,
            'activeBranchName'=>$activeBranchName
        ]);
 
    }
    public function order_index(Request $request){
        // $metals        = DB::table('metals')->select('metal_name')->get();
        // $melting       = DB::table('melting')->select('melting_name')->get();
        $pageTitle     = 'Orders';
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

        $activePage       = 'orders';
        $user_permissions = session('combined_permissions', []);
      
        return view('orders/order_master',compact('pageTitle','login','activePage','user_branch','user_permissions','activeBranchName'));
    }

    public function order_add(Request $request){
        $params = $request->all();
        $login  = auth()->user();
        if ($params['order_from_branch_id'] == null){
            return response()->json([
                'status' => 500,
                'message' =>"Please select active branch"
            ]);
        }
        $rules = [   
            
            'order_date'           => ['required', 'date', 'date_format:Y-m-d'],  
            'order_from_branch_id' => ['required','string'],
            'order_to_branch_id'   => ['required','string'],
            'order_type'           => ['required','in:1,2'],
            'item_metal'           => ['required', 'string'],
            'item_name'            => ['required', 'string'],
            'item_melting'         => ['required', 'string'],
            'order_user_id'        => ['required', 'string'],
            'item_weight'          => ['required', 'numeric'],
            'item_file_images'     => ['nullable'],  
            'item_file_images.*'   => ['file', 'mimes:jpeg,jpg,png,pdf', 'max:10240'],
            'payment_advanced' => ['nullable','numeric'],
            'payment_booking' => ['nullable','numeric'],
            
            ]; 
        $messages = [
                'order_date.required'         => 'Order date is required.',
                'order_date.date'             => 'Order date must be a valid date.',
                'order_date.date_format'      => 'Order date must be in the format YYYY-MM-DD.',            
                'order_from_branch_id.required' => 'From branch ID is required.',
                'order_from_branch_id.string' => 'From branch ID must be a string.',
                'order_to_branch_id.required' => 'To branch ID is required.',
                'order_to_branch_id.string'   => 'To branch ID must be a string.',
                'order_type.required'         => 'Order type is required.',
                'order_type.string'           => 'Order type must be a string.',
                'order_type.in'               => 'Order type must be 1 or 2.',

                'order_user_id.required'         => 'Customer Details is required.',
                'order_user_id.string'           => 'Customer Details must be a string.',
                
                'item_metal.required'         => 'Item metal is required.',
                'item_metal.string'           => 'Item metal must be a string.',
                'item_name.required'          => 'Item name is required.',
                'item_name.string'            => 'Item name must be a string.',
                'item_melting.required'       => 'Item melting is required.',
                'item_melting.string'         => 'Item melting must be a string.',
                'item_weight.required'        => 'Item weight is required.',
                'item_weight.numeric'         => 'Item weight must be a number.',
                'item_file_images.array'      => 'Item file images must be an array.',
                'item_file_images.*.file'     => 'Each item file image must be a valid file.',
                'item_file_images.*.mimes'    => 'Each item file image must be a jpeg, jpg, png, or pdf file.',
                'item_file_images.*.max'      => 'Each item file image cannot exceed 10MB.',
                'payment_advance.numeric'         => 'Payment Advance must be a number.',
                'payment_booking.numeric'         => 'Payment Booking must be a number.',

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
        if(! in_array(7 ,$combined_permissions)){
            return response()->json([
                'status' => 500,
                'message' => 'You dont have permission to Create order' 
            ]);
        }
        if ($params['order_type']==1 && ($params['payment_advance']== null || $params['payment_booking']==null)){
            return response()->json([
                'status' => 500,
                'message' =>"Please enter payment details"
            ]);
        }
       
        $branch = Branch::get_branch_by_id($params['order_from_branch_id']);

        if (empty($branch)) {
            return response()->json([
                'status'  => 500,
                'message' => 'Branch does not exists' 
            ]);
        }
        $to_branch = Branch::get_branch_by_id($params['order_to_branch_id']);
        if (empty($to_branch)) {
            return response()->json([
                'status'  => 500,
                'message' => 'Branch does not exists' 
            ]);
        }     

        $order_number   = $this->generateUniqueNumber('order_number');
        $qr_code_number = $this->generateUniqueNumber('order_qr_code');
    

        $order                       = new Order();
        $order->order_date           = $params['order_date'];
        $order->order_number         = $order_number;
        $order->order_qr_code        = $qr_code_number;
        $order->order_from_branch_id = $params['order_from_branch_id'];
        $order->order_to_branch_id   = $params['order_to_branch_id'];
        $order->order_type           = $params['order_type'];
        $order->order_user_id        = $login->id;
        $order->order_customer_id    = $params['order_user_id'];
        $order->save();

        
        $item = new Item();
        $item->item_metal = $params['item_metal'];
        $item->item_name = $params['item_name'];
        $item->item_melting = $params['item_melting'];
        $item->item_weight   = $params['item_weight'];
        $item->item_order_id = $order->order_id;
        $item->save();

        $fileIds = [];
        if ($request->hasFile('item_file_images')) {
            $files = $request->file('item_file_images');
            \Log::info('Files uploaded: ' . count($files));
            foreach ($files as $file) {

                $filePath = $file->store('uploads', 'public'); 
                $fileModel = new File();
                $fileModel->file_name = $file->hashName(); 
                $fileModel->file_original_name = $file->getClientOriginalName();
                $fileModel->file_path = $filePath;
                $fileModel->file_url = asset('storage/' . $filePath); 
                $fileModel->file_type = $file->getClientMimeType();
                $fileModel->file_size = $file->getSize();
                $fileModel->save();
                $fileIds[] = $fileModel->file_id;
            }
        }
        $item->item_file_images = implode(',', $fileIds);
        $item->save();
        $active_branch = $login->user_active_branch;
        $trans = new Transactions();
        $trans->trans_from          = $params['order_from_branch_id'];
        $trans->trans_to            = $params['order_to_branch_id'];
        $trans->trans_active_branch = $active_branch ?? $params['order_from_branch_id'];
        $trans->trans_user_id       = $login->id;
        $trans->trans_order_id      = $order->order_id;
        $trans->trans_item_id       = $item->item_id;
        $trans->trans_date          = Carbon::now()->toDateString();
        $trans->trans_time          = Carbon::now()->toDateTimeString(); 
        $trans->save();

        if($params['order_type'] == 1){
            $payment = new Payment();
            $payment->payment_order_id      = $order->order_id;
            $payment->payment_booking_rate  = $params['payment_booking'];
            $payment->payment_customer_id   = 1;
            $payment->payment_advance_cash  = $params['payment_advance'];
            $payment->payment_date          = Carbon::now()->toDateString();
            $payment->save();
        }

        SendEmailJob::dispatch($order->order_id,$type="Add");
        SendNotification::dispatch($order->order_id,$type="Add");
        return response()->json([
            "status" =>200,
            "message"=>"Order created successfully"
        ]);
    }

    // order add page
    public function order_add_page(Request $request){
        $metals        = DB::table('metals')->select('metal_name')->get();
        $melting       = DB::table('melting')->select('melting_name')->get();
        $branches      = Branch::select('branch_id', 'branch_name')->take(5)->get();
        $branchesArray = $branches->toArray();
        $pageTitle     = 'Orders';
        $login         = auth()->user()->toArray();
        $activePage    = 'orders';
        $user_permissions = session('combined_permissions', []);
      
        $login = auth()->user();
         
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
        }

    
        return view('orders/order_add',compact('metals', 'melting','branchesArray','pageTitle','login','activePage','user_branch','user_permissions'));
    }

    private function generateUniqueNumber($column)
    {
        do {
            $number = mt_rand(1000000000, 9999999999); // Generate a 10-digit number
        } while (Order::where($column, $number)->exists()); // Check for uniqueness

        return $number;
    }

    
    public function order_edit_page(Request $request,$id){
        $metals        = DB::table('metals')->select('metal_name')->get();
        $melting       = DB::table('melting')->select('melting_name')->get();
        $branches      = Branch::select('branch_id', 'branch_name')->take(5)->get();
        $branchesArray = $branches->toArray();
        $order         = Order::get_order_with_items($id);
        $order         = $order->toArray();

        if (empty($order)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }
        $paymentArray = [];
        if($order['order_type']==2){
            $paymentArray = Payment::where('payment_order_id',$id)->first();
           
        }
        $customer  = Customers::get_all_customers();
        
        // $order['order_cust']
        $pageTitle     = 'Orders';
        $login         = auth()->user()->toArray();
        $activePage    = 'orders';
        $fileArray = [];
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
        }
       
        if (!empty($order['items'][0]['files'])){
            $fileArray = $order['items'][0]['files']->toArray();
        }
        $user_permissions = session('combined_permissions', []);
      
        return view('orders/order_edit'
        ,compact('metals', 'melting','branchesArray',
        'pageTitle','login','activePage','order','fileArray','user_branch','paymentArray','customer','user_permissions'));
    }


    public function order_qr_code(Request $request,$id){

        $order  = Order::get_order_with_items($id);
        $order  = $order->toArray();

        if (empty($order)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }
        if($order['order_type']==1){
            $type = 'Order';
        }else{
            $type = 'Reparing';
        }

        return QrCode::generate(
            implode('|', [
                $order['order_qr_code'],
                $order['order_date'],
                $type
            ])
        );

    }


    public function order_details(Request $request){
        $params = $request->all();
             
        $rules = [   
            
            'order_id' => ['required','string'],
           
            ]; 
        $messages = [
 
                'order_id.required'         => 'Order id is required.',
                'order_id.string'           => 'Order id must be a string.'

            ]; 
            
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 

        $check_order = Order::get_order_with_items($params['order_id']);
        if (empty($check_order)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Order details fetch successfully',
            'data'    => $check_order
        ]);

    }

    // List of order table
    public function order_list(Request $request){
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
        $sortColumn  = $request->input('sort', 'order_id'); 
        $sortOrder   = $request->input('sortOrder', 'desc');
        $allowedSortColumns = ['order_id', 'order_date'];
        if (!in_array($sortColumn, $allowedSortColumns)) {
            $sortColumn = 'order_id'; 
        }
        $ordersQuery = Order::with('transactions')    
        ->leftJoin('branch AS from_branch', 'from_branch.branch_id', '=', 'orders.order_from_branch_id')  
        ->leftJoin('branch AS to_branch', 'to_branch.branch_id', '=', 'orders.order_to_branch_id')  
        ->leftJoin('branch AS current_branch', 'current_branch.branch_id', '=', 'orders.order_current_branch')  
        
        // ->leftJoin('transactions', 'transactions.trans_order_id', '=', 'orders.order_id')  
  
        ->select(
            'orders.*', 
            'from_branch.branch_name AS order_from_name',   
            'to_branch.branch_name AS order_to_name',
            'current_branch.branch_name AS order_current_branch'
            )
            ->distinct()  
        ->where('orders.is_delete',0)

        ->orderBy($sortColumn, $sortOrder);
       
        if (!empty($searchQuery)) {
            $ordersQuery->where(function ($query) use ($searchQuery) {
                $query->where('order_number', 'like', "%{$searchQuery}%")
                      ->orWhere('order_qr_code', 'like', "%{$searchQuery}%");
            });
        }

        
        $total_orders = $ordersQuery->count();
        $orders = $ordersQuery
        ->offset($offset)
        ->limit($perPage)
        ->get();
        $orders->each(function ($order, $index) {
            $order->serial_number = $index + 1; 
        });

        
        $total_pages = ceil($total_orders / $perPage);
        
        return response()->json([
            'status' => 200,
            'message' => 'Orders list fetched successfully!',
            'data'    => [
                'orders'     => $orders,
                'total'        => $total_orders,
                'per_page'     => $perPage,
                'current_page' => $page,
                'total_pages'  => $total_pages,
            ],
            'recordsTotal'  => $total_orders,
            'recordsFiltered' => $orders->count(),
            'per_page'     => $perPage,
            'current_page' => $page,
            'total_pages'  => $total_pages,
    
        ]);
    }

    // Order Updte
    public function order_update(Request $request){
        $params = $request->all();

        $rules = [   
            'order_id'             => ['required','string'],
            'order_date'           => ['required', 'date', 'date_format:Y-m-d'],  
            'order_from_branch_id' => ['required','string'],
            'order_to_branch_id'   => ['required','string'],
            'order_type'           => ['required','in:1,2'],
            'item_metal'           => ['required', 'string'],
            'item_name'            => ['required', 'string'],
            'item_melting'         => ['required', 'string'],
            'item_weight'          => ['required', 'numeric'],
            'item_file_images'     => ['nullable'],  
            'item_file_images.*'   => ['file', 'mimes:jpeg,jpg,png,pdf', 'max:10240'],
            'payment_advanced'     => ['nullable','numeric'],
            'payment_booking'      => ['nullable','numeric'],
            'order_user_id'        => ['required', 'string'],

        ]; 
        $messages = [
                'order_id.required' => 'Order ID is required.',
                'order_id.string' => 'Order ID must be a string.',         
                'order_date.required'         => 'Order date is required.',
                'order_date.date'             => 'Order date must be a valid date.',
                'order_date.date_format'      => 'Order date must be in the format YYYY-MM-DD.',            
                'order_from_branch_id.required' => 'From branch ID is required.',
                'order_from_branch_id.string' => 'From branch ID must be a string.',
                'order_to_branch_id.required' => 'To branch ID is required.',
                'order_to_branch_id.string'   => 'To branch ID must be a string.',
                'order_type.required'         => 'Order type is required.',
                'order_type.string'           => 'Order type must be a string.',
                'order_type.in'               => 'Order type must be 1 or 2.',
                
                'order_user_id.required'      => 'Customer Details is required.',
                'order_user_id.string'        => 'Customer Details must be a string.',
                
                'item_metal.required'         => 'Item metal is required.',
                'item_metal.string'           => 'Item metal must be a string.',
                'item_name.required'          => 'Item name is required.',
                'item_name.string'            => 'Item name must be a string.',
                'item_melting.required'       => 'Item melting is required.',
                'item_melting.string'         => 'Item melting must be a string.',
                'item_weight.required'        => 'Item weight is required.',
                'item_weight.numeric'         => 'Item weight must be a number.',
                'item_file_images.array'      => 'Item file images must be an array.',
                'item_file_images.*.file'     => 'Each item file image must be a valid file.',
                'item_file_images.*.mimes'    => 'Each item file image must be a jpeg, jpg, png, or pdf file.',
                'item_file_images.*.max'      => 'Each item file image cannot exceed 10MB.',
                'payment_advance.numeric'         => 'Payment Advance must be a number.',
                'payment_booking.numeric'         => 'Payment Booking must be a number.',
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
        if(! in_array(6 ,$combined_permissions)){
            return response()->json([
                'status' => 500,
                'message' => 'You dont have permission to Update order' 
            ]);
        }
        $order_rec = Order::get_order_by_id($params['order_id']);

        if(empty($order_rec)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }
        $branch = Branch::get_branch_by_id($params['order_from_branch_id']);

        if (empty($branch)) {
            return response()->json([
                'status'  => 500,
                'message' => 'Branch does not exists' 
            ]);
        }
        $to_branch = Branch::get_branch_by_id($params['order_to_branch_id']);
        if (empty($to_branch)) {
            return response()->json([
                'status'  => 500,
                'message' => 'Branch does not exists' 
            ]);
        }    

        $order_rec->order_date           = $params['order_date'];
        $order_rec->order_from_branch_id = $params['order_from_branch_id'];
        $order_rec->order_to_branch_id   = $params['order_to_branch_id'];
        $order_rec->order_type           = $params['order_type'];
        $order_rec->order_customer_id    = $params['order_user_id'];
       
        $order_rec->save();
        $item = Item::where('item_order_id', $order_rec->order_id)->first();

        $item->item_metal = $params['item_metal'];
        $item->item_name = $params['item_name'];
        $item->item_melting = $params['item_melting'];
        $item->item_weight = $params['item_weight'];
    
        $fileIds = [];
        if ($request->hasFile('item_file_images')) {
            $files = $request->file('item_file_images');
            \Log::info('Files uploaded: ' . count($files));
            foreach ($files as $file) {

                $filePath = $file->store('uploads', 'public'); 
                $fileModel = new File();
                $fileModel->file_name = $file->hashName(); 
                $fileModel->file_original_name = $file->getClientOriginalName();
                $fileModel->file_path = $filePath;
                $fileModel->file_url = asset('storage/' . $filePath); 
                $fileModel->file_type = $file->getClientMimeType();
                $fileModel->file_size = $file->getSize();
                $fileModel->save();
                $fileIds[] = $fileModel->file_id;
            }
        }
        $existing_file_ids = explode(',', $item->item_file_images);
        $all_file_ids = array_merge($existing_file_ids, $fileIds);
        $item->item_file_images = implode(',', $all_file_ids);
        $item->save();

        // payment update
        if($params['order_type'] == 1){
            
            $payment = Payment::where('payment_order_id', $params['order_id'])->first();
            if(!empty($payment)){
                $payment->payment_booking_rate  = $params['payment_booking'];
                $payment->payment_advance_cash  = $params['payment_advance'];
                $payment->save();
            }else{
                $payment = new Payment();
                $payment->payment_order_id      = $order_rec->order_id;
                $payment->payment_booking_rate  = $params['payment_booking'];
                $payment->payment_customer_id   = 1;
                $payment->payment_advance_cash  = $params['payment_advance'];
                $payment->payment_date          = Carbon::now()->toDateString();
                $payment->save();
            }
        }
        SendEmailJob::dispatch($order_rec->order_id,$type="Edit");
        SendNotification::dispatch($order_rec->order_id,$type="Edit");

        return response()->json([
            'status'  => 200,
            'message' => 'Order updated successfully' 
        ]);

    }



    // order delete
    public function order_remove(Request $request){
        $params = $request->all();
        $rules = [   
            
            'order_id' => ['required','string'],
           
            ]; 
        $messages = [
 
                'order_id.required'         => 'Order id is required.',
                'order_id.string'           => 'Order id must be a string.'

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
        if(! in_array(8 ,$combined_permissions)){
            return response()->json([
                'status' => 500,
                'message' => 'You dont have permission to delete order' 
            ]);
        }

        $check_order = Order::get_order_with_items($params['order_id']);
        if (empty($check_order)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }

        $check_order->is_delete = true;
        $check_order->save();
        $item = Item::get_item_by_id($check_order->order_id);
        if (!empty($item)){
            $item->is_delete = 1;
            $item->save();
            $file_ids = explode(',', $item->item_file_images);  
            if (!empty($file_ids)){
                File::whereIn('file_id', $file_ids)->update(['is_delete' => 1]);
            }
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Order removed successfully'

        ]);
    }



    public function order_transfer(Request $request){


        $params = $request->all();
             
        $rules = [   
            
            'order_id'    => ['required','string'],
            'transfer_to' => ['required','string'],           
        ]; 
        $messages = [
 
                'order_id.required'         => 'Order id is required.',
                'order_id.string'           => 'Order id must be a string.',
                'transfer_to.required'         => 'Transfer to is required.',
                'transfer_to.string'           => 'Transfer to must be a string.'

            ]; 
            
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 

        $order = Order::get_order_with_items($params['order_id']);
        if (empty($order)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }

        $user_permissions = session('combined_permissions', []);
       
        if (!in_array(18, $user_permissions)) {
            return response()->json([
                'status' => 500,
                'message' => 'You are not allowed to transfer this order'
            ]);
        }
        // if( $order->order_to_branch_id == $params['transfer_to']){
        //     return response()->json([
        //         'status' => 500,
        //         'message' => 'Cant transfer to the same branch'
        //     ]);
        // }
        if ($order->order_status==0){
            return response()->json([
                'status' => 500,
                'message' => 'Cant transfer item right now'
            ]);
        }
        $items = $order->items->toArray();
        // $order->order_current_branch= $params['transfer_to'];
        $order->order_status        = 0;
        $order->save();

        $login                      = auth()->user()->toArray();
        $active_branch              = $login['user_active_branch'];
        $trans                      = new Transactions();
        $trans->trans_from          = $order->order_from_branch_id;
        $trans->trans_to            = $params['transfer_to'];
        $trans->trans_active_branch = $active_branch ?? $order->order_from_branch_id;
        $trans->trans_user_id       = $login['id'];
        $trans->trans_order_id      = $order->order_id;
        $trans->trans_item_id       = $items[0]['item_id'];
        $trans->trans_date          = Carbon::now()->toDateString();
        $trans->trans_time          = Carbon::now()->toDateTimeString(); 
        $trans->trans_status        = 0;
        $trans->save();
        SendEmailJob::dispatch($order->order_id,$type="Transfer");
        SendNotification::dispatch($order->order_id,$type="Transfer");
        return response()->json([
            'status'  => 200,
            'message' => "Item Transfered successfully" 
        ]);
    }


    public function order_approve(Request $request){

        $params = $request->all();
             
        $rules = [   
            
            'trans_id'    => ['required','string'],
        ]; 
        $messages = [

            'trans_id.required'         => 'Trans id is required.',
            'trans_id.string'           => 'Trans id must be a string.',
                
        ]; 
            
        $validator = Validator::make($params, $rules, $messages);
        
        if($validator->fails()){
            return response()->json([
                'status' => 500,
                'message' => Arr::flatten($validator->errors()->toArray())[0], 
                'errors'  => $validator->errors(), 
            ]);
        } 

        $order = Order::get_order_by_qr_number_id($params['trans_id']);  
        $order = $order->toArray();
        
        $trans = Transactions::get_trans_by_order_id($order['order_id']);
         
        if (empty($trans)){
            return response()->json([
                'status' => 500,
                'message' => 'Order does not exist'
            ]);
        }
        $user_permissions = session('combined_permissions', []);

        
        if (!in_array(17, $user_permissions)) {
            return response()->json([
                'status' => 500,
                'message' => 'You are not allowed to approve this order'
            ]);
        }
        $trans->trans_status = 1;
        $trans->save();
        $order = Order::get_order_by_id($trans->trans_order_id);
        $order->order_status        = 1;
        $order->order_current_branch= $trans->trans_to;
        $order->save();
        SendEmailJob::dispatch($order->order_id,$type="Approve");
        SendNotification::dispatch($order->order_id,$type="Approve");
        
        return response()->json([
            'status' => 200,
            'message' => "Order Received Successfully" 
        ]);
    }

    public function success(){
        return view('orders/order_success');
    }

    public function order_get_approve(Request $request,$id){

        $order = Order::get_order_by_qr_number_id($id);  
        $order = $order->toArray();
        
        if (empty($order)) {
            return redirect()->back()->with('error', 'Order does not exist or already approved');
        }
    
        $trans = Transactions::get_trans_by_order_id($order['order_id']);

        if (empty($trans)) {
            return redirect()->back()->with('error', 'Order does not exist or already approved');
        }
        $user_permissions = session('combined_permissions', []);
        if (!in_array(17, $user_permissions)) {
            return response()->json([
                'status' => 500,
                'message' => 'You are not allowed to approve this order'
            ]);
        }
    
        SendEmailJob::dispatch($order->order_id,$type="Approve");
        SendNotification::dispatch($order->order_id,$type="Approve");
        $trans->trans_status = 1;
        $trans->save();
        $order = Order::get_order_by_id($trans->trans_order_id);
        $order->order_status        = 1;
        $order->order_current_branch= $trans->trans_to;
        $order->save();
        // return response()->json([
        //     'status' => 200,
        //     'message' => "Order Received Successfully" 
        // ]);
        return redirect()->route('order-master')->with('success', 'Order received successfully');
    }
}
