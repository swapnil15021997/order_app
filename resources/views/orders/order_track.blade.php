@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->

                <!-- <h2 class="page-title">
                  Branch
                </h2> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('order-master')}}">Orders</a></li>
                        <li class="breadcrumb-item active"><a href="#">Track Orders</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if(in_array(3, $user_permissions))

                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                           
                            Create new branch
                        </a>
                    @endif
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
         
    <div class="container-xl">
        <div class="order-from-page">
            <div class="w-full">
                <div>
                    <div class="page-body">
                        <div class="d-flex flex-column gap-3">
                            <ul>
                                <li>
                                @php

                                    $formattedDate = \Carbon\Carbon::parse($check_order['created_at'])->format('g:i, M j, Y');
                                @endphp

                                    Order Date -- {{$formattedDate}} <br/>
                                    Created -- {{$check_order['order_user']['name']}} -- {{$check_order['from_branch']['branch_name']}} <br>
                                    
                                </li>
                                @foreach($check_order['transactions'] as $transaction)
                                @php

                                    $formattedDate = \Carbon\Carbon::parse($transaction['trans_time'])->format('g:i, M j, Y');
                                @endphp

                                    <li>
                                        Order Date -- {{$formattedDate }} <br/>
                                        Transfered -- {{$transaction['trans_approved_by']['name']}} -- {{$transaction['trans_from']['branch_name']}} <br>
                                        Accepted   -- {{$transaction['trans_user']['name']}} -- {{$transaction['trans_to']['branch_name']}}
                                    
                                    </li>
                                @endforeach
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection
