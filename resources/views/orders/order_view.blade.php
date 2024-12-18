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
            </div>
            <h2 class="page-title">
                View Order
            </h2> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('order-master')}}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Order</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto ms-auto d-print-none">
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">  
                <div class="table_print">
                    <div style="display: flex; flex-wrap: wrap">
                        <div style="width: 100%">
                            <div style="padding: 3px; text-align:center">
                                <p><b>Sonic Jewellers Limited-2024-25</b></p>
                                <p>Company's GSTIN/UIN : <b>24ABDCS4503K1ZG</b></p>
                                <p>GIN: U36996GJ2020PLC112753</p>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; border-top: 1px solid #cccccc;">
                        <div style="display: flex; flex-wrap: wrap">
                            <div style=" width: 70%; padding: 3px; text-align:center">

                                @if($order['order_type']==1)
                                    <p><b>Order Form</b></p>
                                @else
                                    <p><b>Repairing Form</b></p>
                                @endif

                            </div>
                            <div style="width: 30%;">
                                <div style="padding: 3px; text-align:center; border-left: 1px solid #cccccc;">
                                    <p><b>QR Code</b></p>
                                    <p><b>{{$order['order_qr_code']}}</b></p>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div style="
                    border-top: 1px solid #cccccc;
                    border-bottom: 1px solid #cccccc;">
                    <div
                        style="
                        display: flex;
                        align-items: stretch;
                        flex-wrap: nowrap;
                        overflow: hidden;
                        ">

                        <div
                        style="
                            padding: 4px;
                            border-left: 1px solid #cccccc;
                            width: 100%;
                            max-width: 35%;
                        "
                        >
                        <p>Order Number</p>
                        </div>
                        <div
                        style="
                            padding: 4px;
                            border-left: 1px solid #cccccc;
                            width: 100%;
                            max-width: 30%;
                        "
                        >
                        <p>{{$order['order_number']}}</p>
                        </div>
                    
                        <div
                        style="
                            padding: 4px;
                            border-left: 1px solid #cccccc;
                            width: 100%;
                            max-width: 10%;
                        "
                        >
                        <p>Order Date</p>
                        </div>
                        <div
                        style="
                            padding: 4px;
                            border-left: 1px solid #cccccc;
                            width: 100%;
                            max-width: 20%;
                        "
                        >
                            <p>{{$order['order_date']}}</p>
                        </div>
                    </div>


                    <div
                    style="
                        border-top: 1px solid #cccccc;
                        border-bottom: 1px solid #cccccc;
                    "
                    >
                        <div
                            style="
                            display: flex;
                            align-items: stretch;
                            flex-wrap: nowrap;
                            overflow: hidden;
                            "
                        >
                    
                            <div
                            style="
                                padding: 4px;
                                border-left: 1px solid #cccccc;
                                width: 100%;
                                max-width: 35%;
                            "
                            >
                            <p>Customer Name</p>
                            </div>
                            <div
                            style="
                                padding: 4px;
                                border-left: 1px solid #cccccc;
                                width: 100%;
                                max-width: 60%;
                            "
                            >
                            <p>@if(!empty($customer_order['cust_name'])) {{$customer_order['cust_name']}} @endif</p>
                            </div>
                
                        </div>


                <div
                style="
                    border-top: 1px solid #cccccc;
                    border-bottom: 1px solid #cccccc;
                "
                >
                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                
                    border-bottom: 1px solid #cccccc;
                
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                    "
                    >
                    <p>Customer Phone Number</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>@if(!empty($customer_order['cust_phone_no'])) {{$customer_order['cust_phone_no']}} @endif</p>
                    </div>
                
                </div>


                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                    "
                    >
                    <p>Customer Address</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>@if(!empty($customer_order['cust_address'])) {{$customer_order['cust_address']}} @endif</p>
                    </div>
                
                </div>

                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                    "
                    >
                    <p>Item Metal</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>{{$order['items'][0]['item_metal']}}</p>
                    </div>
                
                </div>

                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                    "
                    >
                    <p>Item Name</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>{{$order['items'][0]['item_name']}}</p>
                    </div>
                
                </div>

                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                        
                    "
                    >
                    <p>Melting</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>{{$order['items'][0]['item_melting']}}</p>
                    </div>
                
                </div>

                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                        
                    "
                    >
                    <p>Weight</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>{{$order['items'][0]['item_weight']}}</p>
                    </div>
                
                </div>
                @if($order['order_type']==1)
                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                        
                    "
                    >
                    <p>Advance Cash Deposit</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>@if(!empty($payment['payment_advance_cash'])) {{$payment['payment_advance_cash']}} @endif</p>
                    </div>
                
                </div>


                <div
                    style="
                    display: flex;
                    align-items: stretch;
                    flex-wrap: nowrap;
                    overflow: hidden;
                    border-bottom: 1px solid #cccccc;
                    "
                >
                    <!-- <div style="padding: 4px; width: 100%; max-width: 4%">
                    <p>SI No.</p>
                    </div> -->
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                        
                    "
                    >
                    <p>Advance Rate Book</p>
                    </div>
                    <div
                    style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 60%;
                    "
                    >
                    <p>@if(!empty($payment['payment_booking_rate'])) {{$payment['payment_booking_rate']}} @endif</p>
                    </div>
                
                </div>
                
                
                
                </div>
                @endif
                <div style="margin-top: 32px; padding: 8px">
                <p>Company's GSTIN/UIN : <b>24ABDCS4503K1ZG</b></p>
                <p>Companys PAN : <b>ABDCS450Kk</b></p>
                </div>
                <div
                style="
                    display: flex;
                    align-items: stretch;
                    border-top: 1px solid #cccccc;
                "
                >
                    <div style="width: 10%; padding: 8px; border-right: 1px solid #cccccc">
                        <p>Item Remark</p>
                </div>
                <div style="width: 40%; padding: 8px">
                    <p>Recd. in Good Condition</p>
                </div>
                <div style="width: 50%; padding: 8px; border-left: 1px solid #cccccc">
                    <small style="text-align: end; display: block"
                    ><b>for Sonic Jewellers Limited-2024-25</b></small
                    >
                    <div
                    style="
                        display: flex;
                        align-items: stretch;
                        justify-content: space-between;
                    "
                    >
                    <div>
                        <div style="margin: 36px 0"></div>
                        <p>Customer Sign</p>
                    </div>
                    <div>
                        <div style="margin: 36px 0"></div>
                        <p>SalesMan Sign</p>
                    </div>
                    <div>
                        <div style="margin: 36px 0"></div>
                        <p>Authorized Manager Signatory</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            </div>
        </div>
    </div>

    @endsection