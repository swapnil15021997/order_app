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

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $transaction['orders'][0]['order_date'] ?? 'N/A' }}</td>
                                    <td>{{ $transaction['orders'][0]['order_number'] ?? 'N/A' }}</td>
                                    <td>{{ $transaction['trans_user']['name'] ?? 'N/A' }}</td>
                                    <td>{{ $transaction['items'][0]['item_name']}} -- {{ $transaction['items'][0]['item_weight'] ?? 'N/A'  }}</td>

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

    </script>
    @endsection
