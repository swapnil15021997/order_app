@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <!-- <div class="page-pretitle">
                Overview
                </div> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order-master') }}">Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Receipt</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div id="alert-container"></div>
            <div class="container">
                <div id="alert-site"></div>
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

            </div>

            <div class="row row-deck row-cards custom-table-resposive">

                <div class="alert-site">

                </div>
                <div class="table-responsive" style="overflow-y: auto;">

                @php

                    $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
                @endphp


                @if($firstTransaction)
                <p class="me-2">Transfer From:  {{ $firstTransaction['from_branch_name'] }} </p>
                <p>Transfer To:  {{ $firstTransaction['to_branch_name'] }} </p>

                @endif

                    <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">Sr No</th>
                                <th class="">Order Date</th>
                                <th class="">Order Number</th>
                                <th class="">Transfer By</th>
                                <th class="">Items</th>
                                <th class="">Action</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction['orders'][0]['order_date'] ?? 'N/A' }}</td>
                                    <td>{{ $transaction['orders'][0]['order_qr_code'] ?? 'N/A' }}</td>
                                    <td>{{ $transaction['trans_user']['name'] ?? 'N/A' }}</td>
                                    <td>{{ $transaction['items'][0]['item_name']}} -- {{ $transaction['items'][0]['item_weight'] ?? 'N/A'  }}</td>
                                    <td> 
                                        <span onclick="view_order({{    $transaction['orders'][0]['order_qr_code']    }})">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.45448 13.8458C1.84656 12.7245 1.84656 11.3653 2.45447 10.2441C4.29523 6.84896 7.87965 4.54492 11.9999 4.54492C16.1202 4.54492 19.7046 6.84897 21.5454 10.2441C22.1533 11.3653 22.1533 12.7245 21.5454 13.8458C19.7046 17.2409 16.1202 19.5449 11.9999 19.5449C7.87965 19.5449 4.29523 17.2409 2.45448 13.8458Z" stroke="black" stroke-width="1.6"/>
                                                <path d="M15.0126 12C15.0126 13.6569 13.6695 15 12.0126 15C10.3558 15 9.01263 13.6569 9.01263 12C9.01263 10.3431 10.3558 9 12.0126 9C13.6695 9 15.0126 10.3431 15.0126 12Z" stroke="black" stroke-width="1.6"/>
                                            </svg>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        
        function view_order(trans_id) {
            window.location.href = `/view-order/${trans_id}`;
        }
    </script>
    @endsection
