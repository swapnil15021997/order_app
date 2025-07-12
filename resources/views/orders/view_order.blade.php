@extends('app')

@section('content')
    <style>
    </style>
    <div class="page-header d-print-none">
        <div class="container">
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('order-master') }}">Orders</a>
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
                        <a class="btn btn-primary" href="#"
                            onclick="approve_order_view({{ $order['order_qr_code'] }})">
                            Approve Order
                        </a>
                    @else
                        <a class="btn btn-primary" href="#" onclick="transfer_order_view({{ $order['order_id'] }})">
                            Transfer Order
                        </a>
                    @endif

                    <button type="button" class="btn btn-primary printMe" onclick="printDiv('original')">Original
                        Print</button>
                    <button type="button" class="btn btn-primary printMe" onclick="printDiv('duplicate')">Duplicate
                        Print</button>

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
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="chalan-card">
                    <div class="head">
                        <div class="child">
                            <img src="{{ asset('static/sonic-large.svg') }}" width="240" height="auto" alt="Tabler" />
                        </div>
                        <div class="child">
                            <p><b>Branch</b><br />

                                @if (!empty($order['current_branch']))
                                    {{ $order['order_current_branch'] }}
                                @else
                                    {{ $order['order_from_name'] }}
                                @endif
                                <br />
                                <!-- Amreli,<br />
                                GJ 360 002</p> -->
                        </div>
                        <div class="child">
                            <ul>
                                <li>
                                    <p id="print_type"></p>
                                </li>
                                <li>
                                    <p><b>Order Number</b>
                                    @if ($order['order_type'] == 1)
                                        <span>O - # {{ $order['order_qr_code'] }}</span>
                                    @else
                                        <span>R - # {{ $order['order_qr_code'] }}</span>
                                    @endif
                                    <br /></p>
                                
                                </li>
                                <li>
                                    <p><b>Order Date</b></p>
                                    <p>{{ $order['order_date'] }}</p>
                                </li>
                                <!-- <li>
                                    <p><b>Due Date</b></p>
                                    <p>01 / 01 / 2025</p>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="body">
                        <div class="child" id="cust_details">
                            <p><b>For,</b><br />

                                @if (!empty($customer_order['cust_name']))
                                    {{ $customer_order['cust_name'] }}
                                @endif <br />
                                @if (!empty($customer_order['cust_phone_no']))
                                    {{ $customer_order['cust_phone_no'] }}
                                @endif
                                <br />
                                @if (!empty($customer_order['cust_address']))
                                    {{ $customer_order['cust_address'] }}
                                @endif
                            </p>
                            @if ($order['order_type'] == 1)
                                <h1>Order </h1>
                            @else
                                <h1>Reparing</h1>
                            @endif
                        </div>
                        <div class="table-my">
                            <div class="table-col">
                                <div>
                                    <p>Item</p>
                                </div>
                                <div>
                                    <p>Metal</p>
                                </div>
                                <div>
                                    <p>Melting</p>
                                </div>
                                <div>
                                    <p>Weight</p>
                                </div>
                                <div>
                                    <p>Color</p>
                                </div>
                            </div>

                            <div class="table-col">
                                <div>
                                    <p>{{ $order['items'][0]['item_name'] }}</p>
                                </div>
                                <div>
                                    <p>{{ $order['items'][0]['item_metal'] }}</p>
                                </div>
                                <div>
                                    <p>{{ $order['items'][0]['item_melting'] }}</p>
                                </div>
                                <div>
                                    <p>{{ $order['items'][0]['item_weight'] }} GM</p>
                                </div>
                                <div>
                                    <p>{{ $order['items'][0]['colors']['color_name'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="child" style="display:flex; align-items:start;">
                            @php
                                $hasFiles = false;
                            @endphp
                            <div class="w-100">
                                @foreach ($order['items'] as $file)
                                    @if (!empty($file['files']) && $file['files']->isNotEmpty())
                                        @php
                                            $hasFiles = true;
                                            $firstFile = $file['files']->first();

                                        @endphp


                                        <img class="child_img" src="{{ asset($firstFile->file_url) }}" alt="image"
                                            width="240px" height="200px" class="rounded-4" />
                                    @endif
                                @endforeach
                            </div>

                            <div class="w-100">
                                <p><b>Notes:</b></p>
                                <br />
                                <p>{{ $order['order_remark'] }}</p>
                                <!-- <p>Gold Ring with original diamon</p> -->
                            </div>
                        </div>

                        <div class="child" id="payment_info">
                            @if ($order['order_type'] == 1)
                                <div class="cash-box">
                                    <div>
                                        <p><b>Advance Cash</b></p>
                                        <p>
                                            @if (!empty($payment['payment_booking_rate']))
                                                {{ $payment['payment_booking_rate'] }}
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            <b> Cash Deposit </b>
                                        </p>
                                        <p>
                                            @if (!empty($payment['payment_advance_cash']))
                                                {{ $payment['payment_advance_cash'] }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="foot">
                        <div class="child">
                            <div>
                                <p><b>Manager Signatory:</b></p>
                            </div>
                            <div>
                                <p><b>Salesman Signatory :</b></p>
                            </div>
                            <div>
                                <p><b>Customer Signatory:</b></p>
                            </div>
                        </div>
                        <div class="child">
                            <p><b>Scan to Accept :</b></p>
                            {{ $qr_code }}
                            <p>{{ $order['order_number'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

        <style type="text/css">
            /* @media print {


                @page {
                    margin: 0;
                    size: A4;
                }

            } */
            /*
            @media print {
                body {
                    font-size: 12px;
                }

                .chalan {
                    width: 100%;
                    font-size: 10pt;
                }
                .no-print {
                    display: none !important;
                }
            }
            */
        </style>
        <script>
            var csrfToken = $('meta[name="csrf-token"]').attr('content');


            function transfer_order_view(order_id) {
                $('#transfer_order_id_view').val(order_id);
                $('#transfer_order_view').modal('show');

            }


            $('#TransferOrderBtnView').click(function(e) {
                e.preventDefault();

                var orderId = $('#transfer_order_id_view').val();
                var transferTo = $('#searchableSelectToView').val();

                if (orderId) {
                    $('body').addClass('loading');
                    $('#TransferOrderBtnView').prop('disabled', true);
                    $.ajax({
                        url: "{{ route('order_transfer') }}",
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            order_id: orderId,
                            transfer_to: transferTo

                        },
                        success: function(response) {
                            if (response.status == 200) {
                                $('body').removeClass('loading');
                                $('#TransferOrderBtnView').prop('disabled', false);

                                $('#transfer_order_id_view').val('');
                                $('#searchableSelectToView').val('');
                                $('#transfer_order_view').modal('hide');
                                alert(response.message);
                                showAlertTransfer('success', response.message);

                                setTimeout(function() {
                                    location.href = "{{ route('order-master') }}";
                                }, 2000);
                            } else {
                                $('body').removeClass('loading');
                                $('#TransferOrderBtnView').prop('disabled', false);

                                showAlertTransfer('success', response.message);
                                $('#searchableSelectToView').val('');


                            }
                        },
                        error: function(xhr, status, error) {
                            $('body').removeClass('loading');
                            $('#TransferOrderBtnView').prop('disabled', false);

                            showAlertTransfer('success', error);

                            $('#searchableSelectToView').val('');

                        }
                    });
                } else {
                    alert('Please select any one order.');
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
                    $('body').addClass('loading');
                    $('#accept_btn').prop('disabled', true);
                    $.ajax({
                        url: "{{ route('order_approve') }}",
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            trans_id: transaction_id,
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                $('body').removeClass('loading');
                                $('#accept_btn').prop('disabled', false);
                                location.reload();
                                showAlert('success', response.message);
                            } else {
                                $('body').removeClass('loading');
                                $('#accept_btn').prop('disabled', false);
                                showAlert('warning', response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            $('body').removeClass('loading');
                            $('#accept_btn').prop('disabled', false);
                            showAlert('warning', error.message);
                        }
                    });
                } else {
                    $('body').removeClass('loading');
                    $('#accept_btn').prop('disabled', false);
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

            $(document).ready(function() {
                $('#searchableSelectToView').on('select2:open', function() {
                    $('.select2-search__field').on('input', function() {
                        userInput = $(this).val();
                    });
                });
                $('#searchableSelectToView').select2({

                    placeholder: "Select an option",
                    allowClear: true,
                    ajax: {
                        url: "{{ route('branch_list') }}",
                        dataType: 'json',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Add CSRF token in the header
                        },
                        delay: 250,
                        data: function(params) {
                            return {

                                search: params.term,
                                per_page: 10,
                                page: params.page || 1
                            };
                        },
                        processResults: function(data) {

                            return {
                                results: data.data.map(function(item) {
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

            function printDiv(type) {
                $('.container-xl').addClass('on-print');
                var existingStyle = document.querySelector('style#customPrintStyle');
                if (existingStyle) {
                    document.head.removeChild(existingStyle);
                }
                if (type == "original") {
                    $('#print_type').text("Original");
                } else {
                    $('#print_type').text("Duplicate");
                    var style = document.createElement('style');
                    style.id = "customPrintStyle";
                    style.innerHTML = `
                    @media print {
                        #payment_info, #cust_details {
                            display: none !important;
                        }


                    }
                `;
                    document.head.appendChild(style);
                }
                var printContents = document.getElementsByClassName('chalan')[0].innerHTML;

                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();
                document.body.innerHTML = printContents;
                window.onafterprint = function() {
                    console.log("Removing")
                    $('.container-xl').removeClass('on-print');
                    document.body.innerHTML = originalContents;
                };

            }
        </script>

    @endsection
