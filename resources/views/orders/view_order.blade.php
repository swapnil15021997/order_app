@extends('app')

@section('content')
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

              <div>
                <h1>Karigar issue</h1>
              </div>
              <div class="table_print">
                <div style="display: flex; flex-wrap: wrap">
                  <div style="width: 50%">
                    <div style="padding: 8px">
                      <p><b>Sonic Jewellers Limited-2024-25</b></p>
                      <p>Company's GSTIN/UIN : <b>24ABDCS4503K1ZG</b></p>
                      <p>GIN: U36996GJ2020PLC112753</p>
                    </div>
                    <div style="border-top: 1px solid #cccccc; padding: 8px">
                      <p>Buyer (Bill to)</p>
                      <p>Customer Name: <b> @if(!empty($customer_order['cust_name'])) {{$customer_order['cust_name']}} @endif </b></p>
                      <p>Customer Address: <b>@if(!empty($customer_order['cust_address'])) {{$customer_order['cust_address']}} @endif </b></p>
                      <p>Phone No: <b> @if(!empty($customer_order['cust_phone_no'])) {{$customer_order['cust_phone_no']}} @endif </b></p>
                    </div>
                  </div>
                  <div style="width: 50%; border-left: 1px solid #cccccc">
                    <div style="display: flex; flex-wrap: wrap">
                      <div style="padding: 8px; width: 50%">
                        <p>Delivery Note No.</p>
                        <p><b>KARI/24-251217</b></p>
                      </div>
                      <div
                        style="border-left: 1px solid #cccccc; padding: 8px; width: 50%"
                      >
                        <p>Dated</p>
                        <p><b>{{$order['order_date']}}</b></p>
                      </div>
                      <div
                        style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
                      >
                        <p>QR Code: &nbsp; {{$qr_code}}</p>

                      </div>
                      <div
                        style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        "
                      >
                        <p>Mode/Terms of Payment</p>
                      </div>
                      <div
                        style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
                      >
                        <p>Reference No & Date</p>
                      </div>
                      <div
                        style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        "
                      >
                        <p>Other References</p>
                      </div>
                      <div
                        style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
                      >
                        <p>Byurs's Order NO.</p>
                      </div>
                      <div
                        style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        "
                      >
                        <p>Dated</p>
                      </div>
                      <div
                        style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
                      >
                        <p>Dispatch Doc No</p>
                        
                      </div>
                      <div
                        style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        "
                      >
                    
                      @if($order['order_type']==1)
                          <p>Order Type: &nbsp; &nbsp;&nbsp;&nbsp;<b>Order</b>
                          <br/>
                          Order Number: &nbsp;{{$order['order_number']}} </p>
                      @else
                          <p>Order Type: &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<b>Repairing</b>  
                            <br/> 
                            Order Number: &nbsp;<b>{{$order['order_number']}}</b>
                          </p>
                      @endif
                      </div>
                      <div
                        style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
                      >
                        <p>Dispatched through <br>
                        <b>{{$order['order_from_name']}}</b>
                        </p>

                      </div>
                      <div
                        style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        "
                      >
                        <p>Destination <br>
                        <b>{{$order['order_to_name']}}</b>
                        </p>

                      </div>

                      <div
                        style="padding: 8px; width: 100%; border-top: 1px solid #cccccc"
                      >
                        <p>Terms of Delivery</p>
                      </div>

                      @if($order['order_type']==1)
               
                      <div
                          style="padding: 8px; width: 50%; border-top: 1px solid #cccccc"
                        >
                          <p>Advance Cash Deposit
                            <br>
                            @if(!empty($payment['payment_advance_cash'])) {{$payment['payment_advance_cash']}} @endif
                          </p>
                        

                        </div>
                        <div
                          style="
                            border-left: 1px solid #cccccc;
                            padding: 8px;
                            width: 50%;
                            border-top: 1px solid #cccccc;
                          "
                        >
                          <p>Advance Rate Book
                            <br>
                            <b>@if(!empty($payment['payment_booking_rate'])) {{$payment['payment_booking_rate']}} @endif</b>
                          </p>
                          <p></p>
                        </div>
                        @endif
                    </div>
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
                    <div style="padding: 4px; width: 100%; max-width: 4%">
                      <p>SI No.</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                      "
                    >
                      <p>Desciprion of Goods</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >
                      <p>HSN/SAC</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >
                      <p>Gross Weight</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >
                      <p>Quantity</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >
                      <p>Rate</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 6%;
                      "
                    >
                      <p>per</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 14%;
                      "
                    >
                      <p>Amount</p>
                    </div>
                  </div>
                  

                  <!-- item -->
                  <div
                    style="
                      display: flex;
                      align-items: stretch;
                      flex-wrap: nowrap;
                      overflow: hidden;
                      border-top: 1px solid #cccccc;
                    "
                  >
                    <div style="padding: 4px; width: 100%; max-width: 4%"><p style="text-align: center">1</p></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                      "
                    >
                      <p style="text-align: end">{{$order['items'][0]['item_name']}}</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    > <p style="text-align: center">{{$order['items'][0]['item_melting']}}</p></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    ><p style="text-align: center">{{$order['items'][0]['item_weight']}} GRM</p></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >
                      <p style="text-align: center"><b>1</b></p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    ></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 6%;
                      "
                    ></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 14%;
                      "
                    ></div>
                  </div>
                  <div
                    style="
                      display: flex;
                      align-items: stretch;
                      flex-wrap: nowrap;
                      overflow: hidden;
                      border-top: 1px solid #cccccc;
                    "
                  >
                    <div style="padding: 4px; width: 100%; max-width: 4%"></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                      "
                    >
                      <p style="text-align: end">Total</p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    ></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >{{$order['items'][0]['item_weight']}} GRM</div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    >
                      <p style="text-align: center"><b></b></p>
                    </div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "
                    ></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 6%;
                      "
                    ></div>
                    <div
                      style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 14%;
                      "
                    ></div>
                  </div>
                </div>
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
                  <div style="width: 50%; padding: 8px">
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
                        <p>Prepared by</p>
                      </div>
                      <div>
                        <div style="margin: 36px 0"></div>
                        <p>verified by</p>
                      </div>
                      <div>
                        <div style="margin: 36px 0"></div>
                        <p>Authorized Signatory</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

  @endsection
 