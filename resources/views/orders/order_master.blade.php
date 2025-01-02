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
                        <li class="breadcrumb-item active" aria-current="page">Orders</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if(in_array(7, $user_permissions))

                    <a href="{{route('order-add-page')}}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create new Order
                    </a>
                    @endif
                    <a href="{{route('order-add-page')}}" class="btn btn-primary d-sm-none btn-icon" 
                        aria-label="Create new report">
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
            <div id="alert-container"></div>
            <div class="container">
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

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                        aria-label="Select all invoices"></th>

                                <th>Order Date</th>
                                <th>Order Type</th>
                                <th>From Branch</th>
                                <th>To Branch</th>

                                <th>order_number</th>
                                <th>Item Current Brach</th>

                                <th>qr_number</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <input type="hidden" name="" id="transfer_order_id">
    <div class="modal modal-blur fade" id="transfer_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfer Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Order To</label>
                    <select id="searchableSelectTo" class="form-select select2">


                    </select>
                </div>


                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="TransferOrderBtn" href="#" class="btn btn-primary">
                        Transfer This Order
                    </a>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" name="" id="delete_order_id">
    <div class="modal modal-blur fade" id="delete_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div id="transfer-container"></div>
                <div class="modal-header">
                    <h5 class="modal-title">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Do you want to delete this order?
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="DeleteOrderBtn" href="#" class="btn btn-primary" data-bs-dismiss="modal">
                        Delete This Order
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#order_date').val('');
            $('#order_type').val('');
            $('#searchableSelectFrom').val('');
            $('#searchableSelectTo').val('');
            $('#item_metal').val('');
            $('#item_name').val('');
            $('#item_melting').val('');
            $('#item_weight').val('');
            $('#item_image_id').val('');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            let userActiveBranch = "{{ $login['user_active_branch'] }}";

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('order_list') }}",
                    type: 'POST',
                    data: function (d) {
                        d.search = d.search.value;
                        d.per_page = d.length;
                        d.page = d.start / d.length + 1;
                        d.draw = d.draw;
                        d.sort = d.order[0].column === 1 ? 'order_date' : 'order_id';
                        d.sortOrder = d.order[0].dir;
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    dataSrc: function (response) {

                        if (response.status === 200) {
                            return response.data.orders;
                        }
                        return [];  // Return an empty array if no data
                    }
                },
                columns: [
                    { data: 'serial_number', name: 'serial_number', orderable: false },
                    { data: 'order_date', name: 'order_date', orderable: true },
                    { data: 'order_type', name: 'order_type', orderable: false },
                    { data: 'order_from_name', name: 'order_from_name', orderable: false },
                    { data: 'order_to_name', name: 'order_to_name', orderable: false },
                    { data: 'order_number', name: 'order_number', orderable: false },
                    { data: 'order_current_branch', name: 'order_current_branch', orderable: false },
                    { data: 'order_qr_code', name: 'order_qr_code', orderable: false },
                    {
                        data: 'order_id',
                        name: 'operations',
                        render: function (data, type, row) {
                            console.log(row);
                            let dropdown = `<button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split"></button>
                                <div class="dropdown-menu dropdown-menu-end drop-option">
                                  <a class="dropdown-item" href="#" onclick="edit_order(${row.order_id})">
                                    Edit
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="view_order(${row.order_qr_code})">
                                    View
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="transfer_order(${row.order_id})">
                                    Transfer Order
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="delete_order(${row.order_id})">
                                    Delete
                                  </a>`;

                            let showApprove = false;
                            let transaction_id;
                            row.transactions.forEach(transaction => {
                                console.log(transaction, userActiveBranch);
                                if (parseInt(userActiveBranch) === parseInt(transaction.trans_to) && transaction.trans_status === 0) {
                                    showApprove = true;
                                    console.log(transaction.trans_id, userActiveBranch);
                                    transaction_id = transaction.trans_id;
                                }
                            });
                            // if (parseInt(userActiveBranch) === parseInt(row.trans_to) && row.trans_status === 0) {
                            //     dropdown += `
                            //         <a class="dropdown-item" href="#" onclick="approve_order(${row.order_id})">
                            //             Approve this
                            //         </a>`;
                            // }
                            if (showApprove) {
                                dropdown += `
                                        <a class="dropdown-item" href="#" onclick="approve_order(${row.order_qr_code})">
                                            Approve this
                                        </a>`;
                            }
                            dropdown += `</div>`;
                            return dropdown;

                        },
                    }
                ],
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100]
            });
            $('input[aria-controls="branch_table"]').on('keyup', function () {
                table.search(this.value).draw();
            });

            $('#DeleteOrderBtn').click(function (e) {
                e.preventDefault();

                var orderId = $('#delete_order_id').val();
                if (orderId) {
                    $.ajax({
                        url: "{{ route('order_remove') }}",
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            order_id: orderId,
                        },
                        success: function (response) {
                            if (response.status == 200) {
                                $('#delete_order_id').val();
                                $('#delete_order').modal('hide');
                                $('#branch_table').DataTable().ajax.reload();

                                showAlertOrder('success', response.message);
                            } else {

                                showAlertOrder('warning', response.message);
                            }
                        },
                        error: function (xhr, status, error) {
 
                            showAlertOrder('warning', response.message);

                        }
                    });
                } else {
                    alert('Please fill in both fields.');
                }
            });
        });

        function edit_order(order_id) {
            window.location.href = `/edit-order/${order_id}`;
            // var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // $.ajax({
            //     url: "{{ route('order_details') }}",
            //     type: 'POST',
            //     data: {
            //         _token        : csrfToken,
            //         order_id     : order_id,
            //     },
            //     success: function(response) {
            //         // Handle success
            //         console.log("Success",response.data);

            //         if (response.status==200) {
            //             var order = response.data;
            //             var items = response.data.items[0];
            //             console.log("Items",items);
            //             $('#edit_order_id').val(order.order_id);
            //             $('#edit_order_date').val(order.order_date);
            //             $('#edit_order_type').val(order.order_type);
            //             $('#edit_searchableSelectFrom').val(order.order_from_branch_id);
            //             $('#edit_searchableSelectTo').val(order.order_to_branch_id);
            //             $('#edit_item_name').val(items.item_name);
            //             $('#edit_item_metal').val(items.item_metal);
            //             $('#edit_item_melting').val(items.item_melting);
            //             $('#edit_item_weight').val(items.item_weight);
            //             $('body').addClass('modal-open');
            //             $('#edit_order').modal('show');

            //         } else {
            //             alert('Error fetching branch: ' + response.message);
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         alert('An error occurred: ' + error);
            //     }
            // });
        }

        function view_order(order_id) {
            window.location.href = `/view-order/${order_id}`;

        }

        function view_qr_code(order_id) {
            window.location.href = `/qr-code/${order_id}`;

        }

        function delete_order(order_id) {
            $('#delete_order_id').val(order_id);
            $('#delete_order').modal('show');

        }

        function formatDate(date) {
            var d = new Date(date);
            var year = d.getFullYear();
            var month = ('0' + (d.getMonth() + 1)).slice(-2);
            var day = ('0' + d.getDate()).slice(-2);
            return year + '-' + month + '-' + day;
        }


        function showAlertOrder(type, message) {
            const alertContainer = document.getElementById('alert-container');
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





        function transfer_order(order_id) {

            $('#transfer_order_id').val(order_id);
            $('#transfer_order').modal('show');

        }
        $(document).ready(function () {

            $('#searchableSelectTo').on('select2:open', function () {
                $('.select2-search__field').on('input', function () {
                    userInput = $(this).val();
                });
            });
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#searchableSelectTo').select2({

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
                            results: data.data.branches.map(function (item) {
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


            $('#TransferOrderBtn').click(function (e) {
                e.preventDefault();

                var orderId = $('#transfer_order_id').val();
                var transferTo = $('#searchableSelectTo').val();

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
                                $('#transfer_order_id').val('');
                                $('#searchableSelectTo').val('');
                                $('#branch_table').DataTable().ajax.reload();
                                alert(response.message);
                                showAlertTransfer('success', response.message);

                                setTimeout(function () {
                                    $('#transfer_order').modal('hide');
                                }, 2000);
                            } else {
                                alert('Error Transferring order: ' + response.message);
                                $('#searchableSelectTo').val('');

                            }
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred: ' + error);
                            $('#searchableSelectTo').val('');

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

        });
        function approve_order(transaction_id) {
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

                            $('#branch_table').DataTable().ajax.reload();
                            showAlertOrder('success', response.message);
                        } else {
                            showAlertOrder('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        showAlertOrder('warning', error.message);
                    }
                });
            } else {
                showAlertOrder('warning', 'Please select Transaction id');
            }
        }

    </script>
    @endsection
