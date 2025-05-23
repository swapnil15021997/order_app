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
                        <li class="breadcrumb-item active"><a href="#">Order Roadmap</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card  my-4 mx-auto">
        <div class="card-body">
            <div class="timeline">

                @php
                $formattedDate = \Carbon\Carbon::parse($check_order['created_at'])
                ->setTimezone('Asia/Kolkata')
                ->format('g:i A, M j, Y');
                @endphp
                <div class="timeline-item completed">
                    <h3>Created</h3>
                    <p>{{$check_order['order_user']['name']}}</p>
                    <p>{{$formattedDate}}</p>
                </div>

                @if(isset($check_order['transactions']) && is_array($check_order['transactions']))
                    @foreach($check_order['transactions'] as $transaction)
                        @if(!empty($transaction))
                            @php
                                $formattedDate = isset($transaction['trans_time']) 
                                    ? \Carbon\Carbon::parse($transaction['trans_time'])                
                                    ->setTimezone('Asia/Kolkata')
                                    ->format('g:i A, M j, Y') 
                                    : 'N/A';
                            @endphp
                            <div class="timeline-item completed">
                                <h3>
                                    Transfered From --  {{ $transaction['trans_from']['branch_name'] ?? '' }}
                                    {{ $transaction['trans_user']['name'] ?? '' }} -- 
                                    {{ $transaction['trans_to']['branch_name'] ?? '' }}
                                </h3>
                                <p>{{ $formattedDate }}</p>
                                <h3>
                                        @if(isset($transaction['trans_approved_by']))

                                            @php
                                                $acceptedDate = isset($transaction['trans_accepted_time']) 
                                                    ? \Carbon\Carbon::parse($transaction['trans_accepted_time'])
                                                    ->setTimezone('Asia/Kolkata')
                                                    ->format('g:i A, M j, Y') 
                                                    : 'N/A';
                                            @endphp
                                            Accepted -- 
                                            {{ $transaction['trans_approved_by']['name'] ?? '' }} -- 
                                            {{ $transaction['trans_to']['branch_name'] ?? '' }}
                                            <p>{{$acceptedDate}}</p>
                                        @endif
                                    </h3>
                            </div>
                        @endif
                    @endforeach
                @endif
               
            </div>
            <div class="tracking-info">
                <p>Order Number: <span>{{$check_order['order_qr_code']}}</span></p>

            </div>
        </div>
    </div>


   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @endsection
