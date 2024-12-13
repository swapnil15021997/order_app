@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards mb-3">
                <div class="col-12">
                    <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$user_count}} Users
                                </div>
                                <div class="text-secondary">
                                {{$user_count}} Total Users
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$branch_count}} Branch
                                </div>
                                <div class="text-secondary">
                                {{$branch_count}} Total Branches
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" /></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$order_count}} Orders
                                </div>
                                <div class="text-secondary">
                                {{$order_count}} Total Orders
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$total_role}} Roles
                                </div>
                                <div class="text-secondary">
                                {{$total_role}} Total Roles
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Orders</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Order Date</th>
                                        <th>Order Type</th>
                                        <th>Order From</th>
                                        <th>Order To</th>
                                        <th>View</th>
                                    </tr>
                                </thead>

                                <tr>
                                @foreach ($order as $order)
                                    <td class="text-secondary">
                                        
                                        {{$order['order_date']}}
                                    </td>
                                    <td class="text-secondary">   
                                            {{$order['order_type']}}
                                    </td>
                                    <td class="text-secondary">{{$order['order_from_name']}}</td>
                                    <td class="text-secondary">{{$order['order_to_name']}}</td>
                                    <td class="text-end w-1">
                                        <a href="#" onclick="ViewOrder({{$order['order_id']}})">View</a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Orders</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Branch Name</th>
                                    </tr>
                                </thead>

                                <tr>
                                @foreach ($branch as $index => $branch)
                                    <td class="text-secondary">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-secondary">   
                                        {{$branch['branch_name']}}

                                    </td>
                                </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                    
              </div>
            </div>
        </div>
    <div>

   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        function ViewOrder(order_id){
            window.location.href = `/view-order/${order_id}`;
        }
     
    </script>

    @endsection
