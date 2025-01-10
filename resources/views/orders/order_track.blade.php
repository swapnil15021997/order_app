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
        </div>
    </div>

    <div class="card  my-4 mx-auto">
        <div class="card-body">
            <div class="timeline">
                <div class="timeline-item completed">
                    <h3>Ordered</h3>
                    <p>15:30, September 9, 2018</p>
                </div>

                <div class="timeline-item completed">
                    <h3>Shipped</h3>
                    <p>15:45, September 9, 2018</p>
                </div>

                <div class="timeline-item">
                    <h3>Delivered</h3>
                    <p>Estimated delivery by 17:30</p>
                </div>
            </div>
            <div class="tracking-info">
                <p>Courier: <span>On Fleet</span></p>
                <p>Tracking Number: <span>1234567890123456</span></p>
            </div>
        </div>
    </div>


    <div class="d-flex flex-column gap-3">
        <ul>
            <li>
                @php

                    $formattedDate = \Carbon\Carbon::parse($check_order['created_at'])->format('g:i, M j, Y');
                @endphp

                Order Date -- {{$formattedDate}} <br />
                Created -- {{$check_order['order_user']['name']}} --
                {{$check_order['from_branch']['branch_name']}} <br>

            </li>
            @foreach($check_order['transactions'] as $transaction)
                        @php

                            $formattedDate = \Carbon\Carbon::parse($transaction['trans_time'])->format('g:i, M j, Y');
                        @endphp

                        <li>
                            Order Date -- {{$formattedDate }} <br />
                            Transfered -- {{$transaction['trans_approved_by']['name']}} --
                            {{$transaction['trans_from']['branch_name']}} <br>
                            Accepted -- {{$transaction['trans_user']['name']}} --
                            {{$transaction['trans_to']['branch_name']}}

                        </li>
            @endforeach
        </ul>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @endsection
