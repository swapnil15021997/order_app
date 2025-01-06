@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- <h2 class="page-title">
                    Edit Order
                    </h2> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('order-master')}}">Orders</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

    <div class="card">
    <div class="card-body">

        <div class="row">
            <div id="alert-container"></div>
            <div class="col-lg-6">

                <div class="mb-3">
                    <input type="hidden" id="edit_order_id" value="{{$order['order_id']}}">
                    <label class="form-label">Order Date</label>
                    <input type="date" id="edit_order_date" value="{{$order['order_date']}}" class="form-control" form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Order Type</label>
                    <div class="d-flex align-items-center">
                        <label class="form-check-label me-2">Order</label>
                        <label class="form-check form-switch m-0">
                            <input class="form-check-input" id="order_type" type="checkbox" @if($order['order_type'] == 2)
                            checked @endif>
                        </label>
                        <label class="form-check-label ms-2">Reparing</label>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Order From</label>
                    <select id="edit_searchableSelectFrom" class="form-select" type="text">

                        @foreach ($branchesArray as $branch)
                            <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $order['order_from_branch_id']) selected @endif>
                                {{ $branch['branch_name'] }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Order To</label>
                    <select id="edit_searchableSelectTo" class="form-select">

                        @foreach ($branchesArray as $branch)
                            <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $order['order_to_branch_id']) selected @endif>
                                {{ $branch['branch_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Item name</label>
                    <input type="text" class="form-control" value="{{$order['items'][0]['item_name']}}"
                        id="edit_item_name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Metal</label>
                    <select class="form-select" id="edit_item_metal">
                        <option value="" disabled selected>Select a metal</option>

                        @foreach ($metals as $metal)
                            <option value="{{ $metal->metal_name }}" @if ($metal->metal_name == $order['items'][0]['item_metal']) selected @endif>
                                {{ $metal->metal_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <div>
                    <label class="form-label">Melting</label>
                    <select class="form-select" id="edit_item_melting">
                        <option value="" disabled selected>Select a melting</option>
                        @foreach ($melting as $melt)
                            <option value="{{ $melt->melting_name }}" @if ($melt->melting_name == $order['items'][0]['item_melting']) selected @endif>
                                {{ $melt->melting_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label class="form-label">Weight</label>
                    <input type="text" class="form-control" id="edit_item_weight"
                        value="{{$order['items'][0]['item_weight']}}" name="example-text-input"
                        placeholder="Weight of item">

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Item Images</label>
                    <input type="file" class="form-control" id="edit_item_image_id" multiple
                        placeholder="Choose Images">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">Select Customer</label>
                    <select id="searchableCust" class="form-select select2">

                        <!-- @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                            @endforeach -->
                        @foreach ($customer as $branch)
                            <option value="{{ $branch['cust_id'] }}" @if ($branch['cust_id'] == $order['order_customer_id'])
                            selected @endif>{{ $branch['cust_name'] }}</option>
                        @endforeach
                    </select>
                    <div class="d-none" id="cust_div">
                        <div>
                            <label class="form-label">Customer Phone Number</label>
                            <input type="text" class="form-control" id="cust_phone_no" placeholder="Customer Phone No">
                        </div>
                        <div>
                            <label class="form-label">Customer Address</label>
                            <textarea id="customer_address" required name="customer_address" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div>
                            <label class="form-label">Create New</label>
                            <button id="saveCustBtn" class="btn btn-primary">Create New</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            @if(!empty($fileArray))
                @foreach($fileArray as $file)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm">
                            <a href="{{ $file['file_url'] ?? '#' }}" class="d-block" target="_blank">
                                <img src="{{ $file['file_url'] ?? './static/photos/default-image.jpg' }}" class="card-img-top"
                                    alt="{{ $file['file_name'] ?? 'File Image' }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">No files available.</p>
            @endif
        </div>

        <div class="row d-none " id="payment">
            <div class="col-lg-6">
                <div>
                    <label class="form-label">Payment Advance</label>
                    <input type="number" class="form-control" id="payment_advance"
                        value="{{ optional($paymentArray)['payment_advance_cash'] }}" name="example-text-input">

                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Payment Booking</label>
                    <input type="number" class="form-control" id="payment_booking"
                        value="{{ optional($paymentArray)['payment_advance_cash'] }}">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-primary ms-auto" id="updateOrderBtn">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                        Update Order
                    </a>
                </div>
            </div>
        </div>

        </div>
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
    $(document).ready(function () {

        $('#order_type').on('change', function () {
            const paymentDiv = $('#payment');
            if (this.checked) {
                paymentDiv.removeClass('d-none'); // Show payment div
            } else {
                paymentDiv.addClass('d-none'); // Hide payment div
            }
        });



        $('#updateOrderBtn').click(function (e) {
            e.preventDefault();
            var orderId = $('#edit_order_id').val();  // Get the order ID to update
            var orderDate = $('#edit_order_date').val();
            var orderType = document.getElementById('order_type');
            const orderTypeValue = orderType.checked ? 2 : 1;
            var orderFrom = $('#edit_searchableSelectFrom').val();
            var orderTo = $('#edit_searchableSelectTo').val();
            var itemMetal = $('#edit_item_metal').val();
            var itemName = $('#edit_item_name').val();
            var itemMelting = $('#edit_item_melting').val();
            var itemWeight = $('#edit_item_weight').val();
            var itemImages = $('#edit_item_image_id')[0].files;
            var payment_advance = $('#payment_advance').val();
            var payment_booking = $('#payment_booking').val();
            var cust = $('#searchableCust').val();
            if (orderDate && orderType && orderFrom && orderTo) {
                var formData = new FormData();
                formData.append('_token', csrfToken);
                formData.append('order_id', orderId);
                formData.append('order_date', orderDate);
                formData.append('order_type', orderTypeValue);
                formData.append('order_from_branch_id', orderFrom);
                formData.append('order_to_branch_id', orderTo);
                formData.append('item_metal', itemMetal);
                formData.append('item_name', itemName);
                formData.append('item_melting', itemMelting);
                formData.append('item_weight', itemWeight);
                formData.append('order_user_id', cust);

                if (payment_advance) {
                    formData.append('payment_advance', payment_advance);
                } else {
                    formData.append('payment_advance', '');
                }
                if (payment_booking) {
                    formData.append('payment_booking', payment_booking);
                } else {
                    formData.append('payment_booking', '');
                }
                // Append files to FormData
                for (var i = 0; i < itemImages.length; i++) {
                    formData.append('item_file_images[]', itemImages[i]);
                }

                $.ajax({
                    url: "{{ route('order-update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 200) {

                            alert(response.message);
                            showAlert('success', response.message);
                            setTimeout(function () {
                                location.href = "{{ route('order-master') }}";
                            }, 1000);

                        } else {
                            alert('Error updating order: ' + response.message);
                            showAlert('warning', response.message);

                        }
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred: ' + error);
                        showAlert('warning', error);

                    }
                });
            } else {
                alert('Please fill in all fields.');
                showAlert('warning', 'Please fill in all fields orderDate, orderType and Order To');

            }
        });



        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#edit_searchableSelectTo').select2({

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
    });


    $(document).ready(function () {

        $('#searchableCust').on('select2:open', function () {
            $('.select2-search__field').on('input', function () {
                userInput = $(this).val();
            });
        });

        $('#searchableCust').on('select2:select', function (e) {
            console.log("Event triggered", e.params.data);
            if (e.params.data.newOption) {
                console.log("New customer added");
                $('#cust_div').removeClass('d-none');
            } else {
                $('#cust_div').addClass('d-none');
            }
        });

        $(document).on('mouseup', '.select2-add-new', function (e) {
            console.log("Direct click on add new option");
            $('#cust_div').removeClass('d-none');
            e.preventDefault();
            e.stopPropagation();
        });
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#searchableCust').select2({
            placeholder: "Search or add a customer",
            allowClear: true,
            tags: true, // Enable adding new tags
            ajax: {
                url: "{{route('customer_list')}}", // Backend route for fetching customers
                dataType: 'json',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // CSRF token for security
                },
                delay: 250, // Debounce for better performance
                data: function (params) {
                    return {
                        search: params.term, // User input for search
                        per_page: 10, // Number of results per page
                        page: params.page || 1 // Current page
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.data.cust.map(function (item) {
                            return {
                                id: item.cust_id,
                                text: item.cust_name
                            };
                        }),
                        pagination: {
                            more: data.data.length >= 10 // Check if there are more results
                        }
                    };
                },
                cache: true
            },
            createTag: function (params) {
                // Allow adding new customer only if input is non-empty
                if ($.trim(params.term) === '') {
                    return null;
                }
                return {
                    id: 'new:' + params.term, // Mark it as a new option
                    text: params.term,
                    newOption: true
                };
            },
            templateResult: function (data) {
                // Highlight the "Add new customer" option
                if (data.newOption) {
                    return $('<span><em>Create ": </em>' + data.text + '"</span>');
                }
                return data.text;
            },
            templateSelection: function (data) {
                // Display the selected item properly

                return data.text;
            }
        })


        $('#searchableCust').on('select2:select', function (e) {
            console.log("Event triggered:", e.params.data);

            // Check if the selected option is a new customer
            if (e.params.data.newOption) {
                console.log("New customer selected");
                $('#cust_div').removeClass('d-none'); // Remove the 'd-none' class
            } else {
                console.log("Existing customer selected");
                $('#cust_div').addClass('d-none'); // Add the 'd-none' class
            }
        });


        $('#saveCustBtn').click(function (e) {
            e.preventDefault();
            var custName = userInput;
            var custAddress = $('#customer_address').val();
            var custPhone = $('#cust_phone_no').val();

            // var branchId = $('#branch_id').val();
            console.log("Customer Info", custAddress, custName);
            if (custName && custPhone) {
                $.ajax({
                    url: "{{ route('add_edit_cust') }}",  // Adjust the route as needed
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        customer_name: custName,
                        customer_address: custAddress,
                        customer_phone_no: custPhone,
                        customer_id: null,
                    },
                    success: function (response) {
                        // Handle success

                        if (response.status == 200) {
                            console.log("Resposne of cust", response.data);
                            UserInput = '';
                            $('#customer_address').val();
                            $('#cust_phone_no').val();

                            var newOption = new Option(response.data.cust_name, response.data.cust_id, true, true);
                            $('#searchableCust').append(newOption).trigger('change');
                            $('#searchableCust').val(response.data.cust_id).trigger('change');

                            showAlert('success', response.message);
                            // alert(response.message);

                        } else {
                            // alert('Error creating branch: ' + response.message);
                            showAlert('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // alert('An error occurred: ' + error);
                        showAlert('warning', error);
                    }
                });
            } else {
                // alert('Please fill in both fields.');
                showAlert('warining', 'Please fill in both fields, Name and address');
            }
        });
    });



    function showAlert(type, message) {
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
</script>
@endsection
