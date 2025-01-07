@extends('app')

@section('content')
<!-- Page header -->

<div class="container-xl">
    <div class="order-from-page">
        <div class="w-full">
            <div>
                <div class="page-body">
                    <div class="d-flex flex-column gap-3">
                        <div id="alert-container"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <img src="{{ asset('static/logo_order.png')}}" alt="Tabler" class="img-fluid "
                                    width="80px" height="40px" />
                                <p class="mb-0 mt-1">Pansuriya Ashok <br /> +91 9898989898</p>
                            </div>
                            <img src="{{ asset('static/qr_code.png')}}" alt="Tabler" class="img-fluid" width="100px">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="order_nu" class="form-label">Order Number</label>
                                        <input type="text" class="form-control" id="order_nu">
                                    </div>
                                    <div class="col-4">
                                        <label for="order_date" class="form-label">Order Date</label>
                                        <input type="date" id="order_date" class="form-control"
                                            value="{{$order['order_date']}}" form>
                                    </div>
                                    <div class="col-4">
                                        <label for="order_type" class="form-label">Order Type</label>
                                        <select id="order_type" class="form-select" type="text">
                                            <option value="" disabled selected>Select type</option>
                                            <option value="order">Order</option>
                                            <option value="reparing">Reparing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="order_customer_details" class="form-label">Customer
                                            Details</label>
                                        <input type="text" placeholder="Enter details" id="order_customer_details"
                                            class="form-control" form>
                                    </div>
                                    <div class="col-4">
                                        <label for="order_customer_name" class="form-label">Customer name</label>
                                        <input type="text" placeholder="Enter name" id="order_customer_name"
                                            class="form-control" form>
                                    </div>
                                    <div class="col-4">
                                        <label for="cust_phone_no" class="form-label">Phone number</label>
                                        <input type="text" placeholder="Enter number" id="cust_phone_no"
                                            class="form-control" form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="h2">Branch & Transfer</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="searchableSelectFrom" class="form-label">From</label>

                                        <select id="searchableSelectFrom" class="form-select" type="text">

                                            @foreach ($user_branch as $branch)

                                                <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $login['user_active_branch']) selected @endif>
                                                    {{ $branch['branch_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="searchableSelectTo" class="form-label">To</label>

                                        <select id="searchableSelectTo" class="form-select w-100" type="text">

                                            @foreach ($branchesArray as $branch)
                                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="h2">Item Details</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="item_name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="item_name" placeholder="Select Item"
                                            value="{{$order['items'][0]['item_name']}}" />
                                    </div>
                                    <div class="col-6">
                                        <label for="item_metal" class="form-label">Metal</label>
                                        <select class="form-select" id="item_metal">
                                            <option value="" disabled selected>Select a metal</option>

                                            @foreach ($metals as $metal)
                                                <option value="{{ $metal->metal_name }}" selected>
                                                    {{ $metal->metal_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="item_melting" class="form-label">Melting</label>
                                        <select class="form-select" id="item_melting">
                                            <option value="" disabled selected>Select a melting</option>
                                            @foreach ($melting as $melt)
                                                <option value="{{ $melt->melting_name }}" selected>
                                                    {{ $melt->melting_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="item_weight" class="form-label">Weight</label>
                                        <input type="number" class="form-control" id="item_weight"
                                            name="example-text-input" value="{{$order['items'][0]['item_weight']}}"
                                            placeholder="Weight of item" />
                                    </div>
                                    <div class="col-4">
                                        <label for="item_colors" class="form-label">Colors</label>
                                        <select class="form-select" id="item_colors">
                                            <option value="" disabled selected>Select color</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input type="file" class="form-control" id="item_image_id" multiple
                                            placeholder="Choose Images" />
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="selected-files">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://images.unsplash.com/photo-1736148912326-aeeda15df88f?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                    alt="select image" width="35px" />
                                                <div>
                                                    <p>Image potrait.jpg</p>
                                                    <small>500kb</small>
                                                </div>
                                            </div>
                                            <button>
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.59 6L10 8.59L7.41 6L6 7.41L8.59 10L6 12.59L7.41 14L10 11.41L12.59 14L14 12.59L11.41 10L14 7.41L12.59 6ZM10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z"
                                                        fill="#858585" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="h2">Payment Details</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="payment_advance" class="form-label">Advance cash deposit</label>
                                        <input type="number" placeholder="Enter here" class="form-control"
                                            id="payment_advance"
                                            value="{{ optional($paymentArray)['payment_advance_cash'] }}"
                                            name="example-text-input">
                                    </div>
                                    <div class="col-6">
                                        <label for="payment_booking" class="form-label">Rate</label>
                                        <input type="number" class="form-control" id="payment_booking"
                                            value="{{ optional($paymentArray)['payment_advance_cash'] }}"
                                            placeholder="Enter here">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <a href="#" class="btn btn-primary ms-auto" id="saveBranchBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Create new Order
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="note-sidebar" id="note_sheet">

            <div class="note-header">
                <h5 class="mb-0">Notes</h5>
                <button class="btn btn-tabler btn-ghost-secondary note-close-btn ms-auto btn-icon"
                    onclick="toogleNoteSheet()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="notes-container"></div>
            <div class="space-y-2 scrollable h-100 py-2 px-1" id="notes_body"></div>
            <div class="note-footer">
                <input type="text" autocomplete="off" placeholder="Write your message" id="TextNotes" />
                <span class="custom-btn">
                    <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(event)"
                        multiple />
                    <a href="#" onclick="open_file_select()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Please Select file to upload">
                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.879 6.37503L5.39297 11.861C4.56697 12.687 4.56697 14.027 5.39297 14.853V14.853C6.21897 15.679 7.55897 15.679 8.38497 14.853L15.617 7.62103C17.132 6.10603 17.132 3.65003 15.617 2.13503V2.13503C14.102 0.620029 11.646 0.620029 10.131 2.13503L2.89897 9.36703C0.694972 11.571 0.694972 15.143 2.89897 17.347V17.347C5.10297 19.551 8.67497 19.551 10.879 17.347L15.268 12.958"
                                stroke="#000E08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </span>
                <span class="custom-btn">
                    <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(event)"
                        multiple />
                    <a href="#" onclick="open_file_select()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Audio File">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 4V4.75C6.25076 4.75 6.48494 4.62467 6.62404 4.41603L6 4ZM7.40627 1.8906L6.78223 1.47457V1.47457L7.40627 1.8906ZM14.5937 1.8906L15.2178 1.47457L14.5937 1.8906ZM16 4L15.376 4.41603C15.5151 4.62467 15.7492 4.75 16 4.75V4ZM13.25 11.5C13.25 12.7426 12.2426 13.75 11 13.75V15.25C13.0711 15.25 14.75 13.5711 14.75 11.5H13.25ZM11 13.75C9.75736 13.75 8.75 12.7426 8.75 11.5H7.25C7.25 13.5711 8.92893 15.25 11 15.25V13.75ZM8.75 11.5C8.75 10.2574 9.75736 9.25 11 9.25V7.75C8.92893 7.75 7.25 9.42893 7.25 11.5H8.75ZM11 9.25C12.2426 9.25 13.25 10.2574 13.25 11.5H14.75C14.75 9.42893 13.0711 7.75 11 7.75V9.25ZM6.62404 4.41603L8.0303 2.30662L6.78223 1.47457L5.37596 3.58397L6.62404 4.41603ZM9.07037 1.75H12.9296V0.25H9.07037V1.75ZM13.9697 2.30662L15.376 4.41603L16.624 3.58397L15.2178 1.47457L13.9697 2.30662ZM12.9296 1.75C13.3476 1.75 13.7379 1.95888 13.9697 2.30662L15.2178 1.47457C14.7077 0.709528 13.8491 0.25 12.9296 0.25V1.75ZM8.0303 2.30662C8.26214 1.95888 8.65243 1.75 9.07037 1.75V0.25C8.1509 0.25 7.29226 0.709528 6.78223 1.47457L8.0303 2.30662ZM20.25 8V15H21.75V8H20.25ZM17 18.25H5V19.75H17V18.25ZM1.75 15V8H0.25V15H1.75ZM5 18.25C3.20507 18.25 1.75 16.7949 1.75 15H0.25C0.25 17.6234 2.37665 19.75 5 19.75V18.25ZM20.25 15C20.25 16.7949 18.7949 18.25 17 18.25V19.75C19.6234 19.75 21.75 17.6234 21.75 15H20.25ZM17 4.75C18.7949 4.75 20.25 6.20507 20.25 8H21.75C21.75 5.37665 19.6234 3.25 17 3.25V4.75ZM5 3.25C2.37665 3.25 0.25 5.37665 0.25 8H1.75C1.75 6.20507 3.20507 4.75 5 4.75V3.25ZM5 4.75H6V3.25H5V4.75ZM17 3.25H16V4.75H17V3.25Z"
                                fill="#000E08" />
                        </svg>
                    </a>
                </span>
                <span class="custom-btn">
                    <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(event)"
                        multiple />
                    <a href="#" onclick="open_file_select()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Audio File">
                        <svg width="16" height="22" viewBox="0 0 16 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 10V11C15 14.866 11.866 18 8 18M1 10V11C1 14.866 4.13401 18 8 18M8 18V21M8 21H11M8 21H5M8 15C5.79086 15 4 13.2091 4 11V5C4 2.79086 5.79086 1 8 1C10.2091 1 12 2.79086 12 5V11C12 13.2091 10.2091 15 8 15Z"
                                stroke="#000E08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </span>
                <button class="note-submit-btn">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.43013 2.72003L15.3787 8.19293C15.6845 8.34573 15.8777 8.65821 15.8777 9.00004C15.8777 9.34187 15.6845 9.65435 15.3787 9.80715L4.43013 15.28C4.11287 15.4387 3.73208 15.3968 3.4569 15.173C3.18171 14.9492 3.06316 14.5849 3.15391 14.2419L4.54235 9.00004L3.15391 3.75813C3.06316 3.41521 3.18171 3.05093 3.4569 2.82709C3.73208 2.60325 4.11287 2.56136 4.43013 2.72003Z"
                            fill="white" />
                        <path d="M8.66223 9.0001H4.54236" stroke="#0054a6" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
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
