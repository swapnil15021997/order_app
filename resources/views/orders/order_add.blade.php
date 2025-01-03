@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- <h2 class="page-title">
                    New Order
                    </h2> -->

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('order-master')}}">Orders</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Order</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div id="alert-container"></div>
        <div class="row">

            <div class="col-lg-6">

                <div class="mb-3">
                    <label class="form-label">Order Date</label>
                    <input type="date" id="order_date" class="form-control" form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <!-- <label class="form-label">Order Type</label>
                        <select id="order_type"  class="form-select">
                            <option value="1" selected>Repairing</option>
                            <option value="2">Order</option>
                        </select> -->
                    <label class="form-label">Order Type</label>
                    <div class="d-flex align-items-center">
                        <label class="form-check-label ms-2">Order</label>
                        <label class="form-check form-switch m-0 ms-2">
                            <input class="form-check-input" id="order_type" type="checkbox" checked>
                        </label>
                        <label class="form-check-label me-2 ms-2">Reparing</label>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Order From</label>

                    <select id="searchableSelectFrom" class="form-select" type="text">

                        @foreach ($user_branch as $branch)

                            <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $login['user_active_branch']) selected @endif>
                                {{ $branch['branch_name'] }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Order To</label>
                    <select id="searchableSelectTo" class="form-select select2">

                        <!-- @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                            @endforeach -->
                    </select>
                </div>
            </div>

            <!-- <div class="col-lg-2">
                    <div class="mb-3">
                        <label class="form-label">Create New</label>
                        <button class="btn btn-primary" onclick="create_new_branch()">Create New</button>
                    </div>
                </div> -->
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Item name</label>
                    <input type="text" class="form-control" id="item_name">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Metal</label>
                    <select class="form-select" id="item_metal">
                        <option value="" disabled selected>Select a metal</option>

                        @foreach ($metals as $metal)
                            <option value="{{ $metal->metal_name }}" selected>{{ $metal->metal_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <div>
                    <label class="form-label">Melting</label>
                    <select class="form-select" id="item_melting">
                        <option value="" disabled selected>Select a melting</option>
                        @foreach ($melting as $melt)
                            <option value="{{ $melt->melting_name }}" selected>{{ $melt->melting_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label class="form-label">Weight</label>
                    <input type="number" class="form-control" id="item_weight" name="example-text-input"
                        placeholder="Weight of item">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Item Images</label>
                    <input type="file" class="form-control" id="item_image_id" multiple placeholder="Choose Images">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label class="form-label">Select Customer</label>
                    <select id="searchableCust" class="form-select select2">
                        <!-- @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                            @endforeach -->
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


        <div class="row d-none" id="payment">
            <div class="col-lg-6">
                <div>
                    <label class="form-label">Payment Advance</label>
                    <input type="number" class="form-control" id="payment_advance" name="example-text-input">

                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Payment Booking</label>
                    <input type="number" class="form-control" id="payment_booking">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6">

                <div class="mb-3">

                    <a href="#" class="btn btn-primary ms-auto" id="saveBranchBtn">
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
                paymentDiv.addClass('d-none'); // Hide payment div
            } else {
                paymentDiv.removeClass('d-none'); // Show payment div
            }
        });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#saveBranchBtn').click(function (e) {

            e.preventDefault();
            var orderDate = $('#order_date').val();
            var orderType = document.getElementById('order_type');

            const orderTypeValue = orderType.checked ? 2 : 1;
            var orderFrom = $('#searchableSelectFrom').val();
            var orderTo = $('#searchableSelectTo').val();
            var cust = $('#searchableCust').val();
             
            var item_metal = $('#item_metal').val();
            var item_name = $('#item_name').val();
            var item_melting = $('#item_melting').val();
            var item_weight = $('#item_weight').val();
            var payment_advance = $('#payment_advance').val();
            var payment_booking = $('#payment_booking').val();
            var itemImages = $('#item_image_id')[0].files;
            var formattedOrderDate = formatDate(orderDate);

            if (orderDate && orderType && orderFrom && orderTo) {
                var formData = new FormData();
                formData.append('_token', csrfToken);  // Add CSRF token
                formData.append('order_date', orderDate);
                formData.append('order_type', orderTypeValue);
                formData.append('order_from_branch_id', orderFrom);
                formData.append('order_to_branch_id', orderTo);
                formData.append('order_user_id', cust);


                formData.append('item_metal', item_metal);
                formData.append('item_name', item_name);
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

                formData.append('item_melting', item_melting);
                formData.append('item_weight', item_weight);

                // Append files to FormData
                for (var i = 0; i < itemImages.length; i++) {
                    formData.append('item_file_images[]', itemImages[i]);
                }
                $.ajax({
                    url: "{{ route('order-add') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 200) {
                            $('#branch_table').DataTable().ajax.reload();  // Reload table

                            showOrderAlert('success', response.message);

                            $('#order_date').val('');
                            $('#order_type').val('');
                            $('#searchableSelectFrom').val('');
                            $('#searchableSelectTo').val('');
                            $('#item_metal').val('');
                            $('#item_name').val('');
                            $('#item_melting').val('');
                            $('#item_weight').val('');
                            $('#item_image_id').val('');
                            setTimeout(function () {
                                location.href = "{{ route('order-master') }}";
                            }, 1000);
                        } else {
                            alert('Error creating order: ' + response.message);
                            showOrderAlert('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // alert('An error occurred: ' + error);
                        showOrderAlert('warning', error);
                    }
                });
            } else {
                alert('Please fill in all fields.');

                showOrderAlert('warning', 'Please fill in all fields orderDate, orderType and Order To');
            }
        });



    });

    var userInput = '';
    // $('#searchableSelectTo').on('select2:selecting', function (e) {

    //     userInput = e.params.args.data.text;

    //     console.log("New/custom input: " + userInput);
    // });

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



        // $('#searchableCust').on('select2:open', function() {
        //         $('.select2-search__field').on('input', function() {
        //             userInput = $(this).val();
        //         });
        //     });
        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     $('#searchableCust').select2({

        //         placeholder: "Select an option",

        //         allowClear: true,
        //         ajax: {
        //             url: "{{route('customer_list')}}",
        //         dataType: 'json',
        //         type: 'POST',
        //         headers: {
        //                 'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
        //         },
        //         delay: 250,
        //         data: function (params) {
        //             return {

        //                 search: params.term,
        //                 per_page: 10,
        //                 page: params.page || 1
        //             };
        //         },
        //         processResults: function (data) {

        //             return {
        //                 results: data.data.cust.map(function (item) {
        //                     return {
        //                         id: item.cust_id,
        //                         text: item.cust_name
        //                     };
        //                 }),
        //                 pagination: {
        //                     more: data.data.length >= 10 // Check if there are more results
        //                 }
        //             };
        //         },
        //         cache: true
        //     },

        // });

        // $('#searchableCust').on('select2:open', function() {
        //     $('.select2-search__field').on('input', function() {
        //         userInput = $(this).val();
        //     });
        // });
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
            })
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
                        // return $('<span><em>Click Here to Create New": ' + data.text + '"</em></span>');
                        return $('<div class="select2-add-new">' +
                            '<span class="add-new-text">Click Here to Create New: "' + data.text + '"</span>' +
                            '</div>');
                    }
                    return data.text;
                },
                templateSelection: function (data) {
                    // Display the selected item properly

                    // if (data.newOption) {
                    //     $('#cust_div').removeClass('d-none');
                    // }else{
                    //     $('#cust_div').addClass('d-none');
                    // }
                    return data.text;
                }
            })
            // $('#searchableCust').on('select2:select', function (e) {
            //     console.log("Event triggered:", e.params.data);

            //     // Check if the selected option is a new customer
            //     if (e.params.data.newOption) {
            //         console.log("New customer selected");
            //         $('#cust_div').removeClass('d-none'); // Remove the 'd-none' class
            //     } else {
            //         console.log("Existing customer selected");
            //         $('#cust_div').addClass('d-none'); // Add the 'd-none' class
            //     }
            // });
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

                            showOrderAlert('success', response.message);
                            // alert(response.message);

                        } else {
                            // alert('Error creating branch: ' + response.message);
                            showOrderAlert('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // alert('An error occurred: ' + error);
                        showOrderAlert('warning', error);
                    }
                });
            } else {
                // alert('Please fill in both fields.');
                showOrderAlert('warining', 'Please fill in both fields, Name and address');
            }
        });
    });

    function formatDate(date) {
        var d = new Date(date);
        var year = d.getFullYear();
        var month = ('0' + (d.getMonth() + 1)).slice(-2);
        var day = ('0' + d.getDate()).slice(-2);
        return year + '-' + month + '-' + day;
    }


    function create_new_branch() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        console.log("Creating new branch", userInput);


        if (userInput) {
            $.ajax({
                url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                type: 'POST',
                data: {
                    _token: csrfToken,
                    branch_name: userInput,
                    branch_id: '',
                    branch_address: userInput,
                },
                success: function (response) {
                    // Handle success

                    if (response.status == 200) {
                        alert(response.message);
                    } else {
                        alert('Error creating branch: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        } else {
            alert("Please enter a branch name")
        }
    }


    function showOrderAlert(type, message) {
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

    function showAlertCust(type, message) {
        const alertContainer = document.getElementById('alert-container-cust');
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
