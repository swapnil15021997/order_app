@extends('app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div id="alert-site"></div>
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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('order-master')}}">Orders</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Order</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto ms-auto d-print-none">
                @php
                    $lastTransaction = end($order['transactions']); // Get the last transaction
                @endphp

                @if ($lastTransaction && $lastTransaction['trans_status'] === 0)
                    <!-- If both conditions are satisfied, show the "Approve" button -->
                    <a class="btn btn-primary" href="#" onclick="approve_order_view({{ $order['order_qr_code'] }})">
                        Approve Order
                    </a>
                @else
                    <a class="btn btn-primary" href="#" onclick="transfer_order_view({{$order['order_id']}})">
                        Transfer Order
                    </a>
                @endif

                <button type="button" class="btn btn-primary printMe" onclick="printDiv()">Print</button>
 
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="transfer_order_id_view">
    <div class="modal modal-blur fade" id="transfer_order_view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfer Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="transfer-container"></div>
                    <label class="form-label">Order To</label>
                    <select id="searchableSelectToView" class="form-select select2">


                    </select>
                </div>


                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="TransferOrderBtnView" href="#" class="btn btn-primary">
                        Transfer This Order
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body chalan">
        <div class="container-xl ">
            <div class="row" id="transfer-container">
            </div>
            <div class="container">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
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
                                <p>Customer Name: <b> @if(!empty($customer_order['cust_name']))
                                {{$customer_order['cust_name']}} @endif </b></p>
                                <p>Customer Address: <b>@if(!empty($customer_order['cust_address']))
                                {{$customer_order['cust_address']}} @endif </b></p>
                                <p>Phone No: <b> @if(!empty($customer_order['cust_phone_no']))
                                {{$customer_order['cust_phone_no']}} @endif </b></p>
                            </div>
                        </div>
                        <div style="width: 50%; border-left: 1px solid #cccccc">
                            <div style="display: flex; flex-wrap: wrap">
                                <div style="padding: 8px; width: 50%">
                                    <p>Delivery Note No.</p>
                                    <p><b>KARI/24-251217</b></p>
                                </div>
                                <div style="border-left: 1px solid #cccccc; padding: 8px; width: 50%">
                                    <p>Dated</p>
                                    <p><b>{{$order['order_date']}}</b></p>
                                </div>
                                <div style="padding: 8px; width: 50%; border-top: 1px solid #cccccc">
                                    <p>QR Code: &nbsp; {{$qr_code}}</p>

                                </div>
                                <div style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        ">
                                    <p>Mode/Terms of Payment</p>
                                </div>
                                <div style="padding: 8px; width: 50%; border-top: 1px solid #cccccc">
                                    <p>Reference No & Date</p>
                                </div>
                                <div style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        ">
                                    <p>Other References</p>
                                </div>
                                <div style="padding: 8px; width: 50%; border-top: 1px solid #cccccc">
                                    <p>Byurs's Order NO.</p>
                                </div>
                                <div style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        ">
                                    <p>Dated</p>
                                </div>
                                <div style="padding: 8px; width: 50%; border-top: 1px solid #cccccc">
                                    <p>Dispatch Doc No</p>

                                </div>
                                <div style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        ">

                                    @if($order['order_type'] == 1)
                                        <p>Order Type: &nbsp; &nbsp;&nbsp;&nbsp;<b>Order</b>
                                            <br />
                                            Order Number: &nbsp;{{$order['order_number']}}
                                        </p>
                                    @else
                                        <p>Order Type: &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<b>Repairing</b>
                                            <br />
                                            Order Number: &nbsp;<b>{{$order['order_number']}}</b>
                                        </p>
                                    @endif
                                </div>
                                <div style="padding: 8px; width: 50%; border-top: 1px solid #cccccc">
                                    <p>Dispatched through <br>
                                        <b>{{$order['order_from_name']}}</b>
                                    </p>

                                </div>
                                <div style="
                          border-left: 1px solid #cccccc;
                          padding: 8px;
                          width: 50%;
                          border-top: 1px solid #cccccc;
                        ">
                                    <p>Destination <br>
                                        <b>{{$order['order_to_name']}}</b>
                                    </p>

                                </div>

                                <div style="padding: 8px; width: 100%; border-top: 1px solid #cccccc">
                                    <p>Terms of Delivery</p>
                                </div>

                                @if($order['order_type'] == 1)

                                            <div style="padding: 8px; width: 50%; border-top: 1px solid #cccccc">
                                                <p>Advance Cash Deposit
                                                    <br>
                                                    @if(!empty($payment['payment_advance_cash']))
                                                    {{$payment['payment_advance_cash']}} @endif
                                                </p>


                                            </div>
                                            <div style="
                                        border-left: 1px solid #cccccc;
                                        padding: 8px;
                                        width: 50%;
                                        border-top: 1px solid #cccccc;
                                      ">
                                                <p>Advance Rate Book
                                                    <br>
                                                    <b>@if(!empty($payment['payment_booking_rate']))
                                                    {{$payment['payment_booking_rate']}} @endif</b>
                                                </p>
                                                <p></p>
                                            </div>
                                @endif
                            </div>
                        </div>


                    </div>
                    <div style="
                    border-top: 1px solid #cccccc;
                    border-bottom: 1px solid #cccccc;
                  ">
                        <div style="
                      display: flex;
                      align-items: stretch;
                      flex-wrap: nowrap;
                      overflow: hidden;
                    ">
                            <div style="padding: 4px; width: 100%; max-width: 4%">
                                <p>Sr No.</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                      ">
                                <p>Desciprion of Goods</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                        text-align: center;
                      ">
                                <p>HSN/SAC</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                        text-align: center;
                      ">
                                <p>Gross Weight</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      ">
                                <p>Quantity</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      ">
                                <p>Rate</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 6%;
                      ">
                                <p>per</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 14%;
                      ">
                                <p>Amount</p>
                            </div>
                        </div>


                        <!-- item -->
                        <div style="
                      display: flex;
                      align-items: stretch;
                      flex-wrap: nowrap;
                      overflow: hidden;
                      border-top: 1px solid #cccccc;
                    ">
                            <div style="padding: 4px; width: 100%; max-width: 4%">
                                <p style="text-align: center">1</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                      ">
                                <p style="text-align: center">{{$order['items'][0]['item_name']}}</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      ">
                                <p style="text-align: center">{{$order['items'][0]['item_melting']}}</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      ">
                                <p style="text-align: center">{{$order['items'][0]['item_weight']}} GRM</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      ">
                                <p style="text-align: center"><b>1</b></p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "></div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 6%;
                      "></div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 14%;
                      "></div>
                        </div>
                        <div style="
                      display: flex;
                      align-items: stretch;
                      flex-wrap: nowrap;
                      overflow: hidden;
                      border-top: 1px solid #cccccc;
                    ">
                            <div style="padding: 4px; width: 100%; max-width: 4%"></div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 35%;
                        text-align: center;
                      ">
                                <p style="text-align: center">Total</p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "></div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                        text-align: center;
                      ">{{$order['items'][0]['item_weight']}} GRM</div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      ">
                                <p style="text-align: center"><b></b></p>
                            </div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 10%;
                      "></div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 6%;
                      "></div>
                            <div style="
                        padding: 4px;
                        border-left: 1px solid #cccccc;
                        width: 100%;
                        max-width: 14%;
                      "></div>
                        </div>
                    </div>
                    <div style="margin-top: 32px; padding: 8px">
                        <p>Company's GSTIN/UIN : <b>24ABDCS4503K1ZG</b></p>
                        <p>Companys PAN : <b>ABDCS450Kk</b></p>
                    </div>
                    <div style="
                    display: flex;
                    align-items: stretch;
                    border-top: 1px solid #cccccc;
                  ">
                        <div style="width: 50%; padding: 8px">
                            <p>Recd. in Good Condition</p>
                        </div>
                        <div style="width: 50%; padding: 8px; border-left: 1px solid #cccccc">
                            <small style="text-align: end; display: block"><b>for Sonic Jewellers
                                    Limited-2024-25</b></small>
                            <div style="
                        display: flex;
                        align-items: stretch;
                        justify-content: space-between;
                      ">
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<style type="text/css">

	@media print {
    /* Adjust the page margins */
    @page {
        margin: 0;
        size: A4;
    }

}
</style> 
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
          

        function transfer_order_view(order_id) {
            $('#transfer_order_id_view').val(order_id);
            $('#transfer_order_view').modal('show');

        }


        $('#TransferOrderBtnView').click(function (e) {
            e.preventDefault();

            var orderId = $('#transfer_order_id_view').val();
            var transferTo = $('#searchableSelectToView').val();

            if (orderId) {
                $.ajax({
                    url: "{{ route('order_transfer') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        order_id: orderId,
                        transfer_to: transferTo

                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('#transfer_order_id_view').val('');
                            $('#searchableSelectToView').val('');
                            $('#transfer_order_view').modal('hide');
                            alert(response.message);
                            showAlertTransfer('success', response.message);

                            setTimeout(function () {
                                location.href = "{{ route('order-master') }}";
                            }, 2000);
                        } else {
                            
                            showAlertTransfer('success', response.message);
                            $('#searchableSelectToView').val('');


                        }
                    },
                    error: function (xhr, status, error) {
                        showAlertTransfer('success', error);
                            
                        $('#searchableSelectToView').val('');

                    }
                });
            } else {
                alert('Please fill in both fields.');
            }
        });

        function showAlertTransfer(type, message) {
            const alertContainer = document.getElementById('transfer-container');
            const alertHTML = `
                  <div class="alert alert-${type} alert-dismissible" role="alert">
                      <div class="d-flex">
                          <div>
                              ${type === 'success' ? `
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M5 12l5 5l10 -10" />
                              </svg>` : `
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                  <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                  <path d="M12 9v4" />
                                  <path d="M12 17h.01" />
                              </svg>`}
                          </div>
                          <div>${message}</div>
                      </div>
                      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                  </div>
              `;
            alertContainer.innerHTML = alertHTML;
            console.log("here");
        }


        function approve_order_view(transaction_id) {
            if (transaction_id) {
                $.ajax({
                    url: "{{ route('order_approve') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        trans_id: transaction_id,
                    },
                    success: function (response) {
                        if (response.status == 200) {

                            location.reload();
                            showAlert('success', response.message);
                        } else {
                            showAlert('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        showAlert('warning', error.message);
                    }
                });
            } else {
                showAlert('warning', 'Please select Transaction id');
            }
        }


        function showAlert(type, message) {
            const alertContainer = document.getElementById('alert-site');
            const alertHTML = `
            <div class="alert alert-${type} alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        ${type === 'success' ? `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>` : `
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>`}
                    </div>
                    <div>${message}</div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        `;
            alertContainer.innerHTML = alertHTML;
            console.log("here");
        }

        $(document).ready(function () {
            $('#searchableSelectToView').on('select2:open', function () {
                $('.select2-search__field').on('input', function () {
                    userInput = $(this).val();
                });
            });
             $('#searchableSelectToView').select2({

                placeholder: "Select an option",
                allowClear: true,
                ajax: {
                    url: "{{route('branch_list')}}",
                    dataType: 'json',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    delay: 250,
                    data: function (params) {
                        return {

                            search: params.term,
                            per_page: 10,
                            page: params.page || 1
                        };
                    },
                    processResults: function (data) {

                        return {
                            results: data.data.map(function (item) {
                                return {
                                    id: item.branch_id,
                                    text: item.branch_name
                                };
                            }),
                            pagination: {
                                more: data.data.length >= 10 // Check if there are more results
                            }
                        };
                    },
                    cache: true
                }
            });
        });
        function printDiv() {
            var printContents = document.getElementsByClassName('chalan')[0].innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
       
    </script>

    @endsection
