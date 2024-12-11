@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    New Order
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
        
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
                            <label class="form-check-label me-2">Reparing</label>
                            <label class="form-check form-switch m-0">
                                <input class="form-check-input" id="orderType" type="checkbox" checked>
                            </label>
                            <label class="form-check-label ms-2">Order</label>
                        </div>
                         
                    </div>
                </div>
            </div>
                    
            <div class="row">
                        
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order From</label>

                        <select id="searchableSelectFrom" class="form-select"  type="text">
                       
                            @foreach ($branchesArray as $branch)
                               
                                <option value="{{ $branch['branch_id'] }}"  @if ($branch['branch_id'] == $login['user_active_branch']) selected @endif>{{ $branch['branch_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Order To</label>
                        <select id="searchableSelectTo" class="form-select select2">
                            
                            <!-- @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                            @endforeach -->
                        </select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="mb-3">
                        <label class="form-label">Create New</label>
                        <button class="btn btn-primary" onclick="create_new_branch()">Create New</button>
                    </div>
                </div>
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

            <div class="row">
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
                        <input type="text" class="form-control" id="item_weight" name="example-text-input" placeholder="Weight of item">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Item Images</label>
                        <input type="file" class="form-control" id="item_image_id"  multiple  placeholder="Choose Images">
                    </div>
                </div>
            </div>
         
            <div class="row">
                <div class="col-lg-6">
                    
                    <div class="mb-3">
                        
                        <a href="#" class="btn btn-primary ms-auto"  id="saveBranchBtn">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
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
        $(document).ready(function() {
       
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#saveBranchBtn').click(function(e) {

                e.preventDefault(); 
                var orderDate    = $('#order_date').val();
                var orderType    = $('#order_type');
                const orderTypeValue = orderType.checked ? 2 : 1;
                var orderFrom    = $('#searchableSelectFrom').val();
                var orderTo      = $('#searchableSelectTo').val();
                var item_metal   = $('#item_metal').val();
                var item_name    = $('#item_name').val();
                var item_melting = $('#item_melting').val();
                var item_weight  = $('#item_weight').val();
                var itemImages   = $('#item_image_id')[0].files; 
                var formattedOrderDate = formatDate(orderDate);
                
                if (orderDate && orderType && orderFrom && orderTo) {
                    var formData = new FormData();
                    formData.append('_token', csrfToken);  // Add CSRF token
                    formData.append('order_date', orderDate);
                    formData.append('order_type', orderTypeValue);
                    formData.append('order_from_branch_id', orderFrom);
                    formData.append('order_to_branch_id', orderTo);
                    formData.append('item_metal', item_metal);
                    formData.append('item_name', item_name);
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
                        success: function(response) {
                            if (response.status == 200) {
                                $('#branch_table').DataTable().ajax.reload();  // Reload table
                                alert(response.message);
                                $('#order_date').val('');
                                $('#order_type').val('');
                                $('#searchableSelectFrom').val('');
                                $('#searchableSelectTo').val('');
                                $('#item_metal').val('');
                                $('#item_name').val('');
                                $('#item_melting').val('');
                                $('#item_weight').val('');
                                $('#item_image_id').val('');
                                location.href = "{{route('order-master')}}";
                            } else {
                                alert('Error creating order: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                } else {
                    alert('Please fill in all fields.');
                }
            });
        });

        var userInput = '';
        // $('#searchableSelectTo').on('select2:selecting', function (e) {

        //     userInput = e.params.args.data.text;
            
        //     console.log("New/custom input: " + userInput);
        // });

        $(document).ready(function() {
            
            $('#searchableSelectTo').on('select2:open', function() {
                $('.select2-search__field').on('input', function() {
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
        
    });

        function formatDate(date) {
            var d = new Date(date);
            var year = d.getFullYear();  
            var month = ('0' + (d.getMonth() + 1)).slice(-2); 
            var day = ('0' + d.getDate()).slice(-2);  
            return year + '-' + month + '-' + day;  
        }


        function create_new_branch(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            console.log("Creating new branch",userInput);


            if (userInput ) {
                $.ajax({
                    url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                    type: 'POST',
                    data: {
                        _token         : csrfToken,
                        branch_name    : userInput,
                        branch_id      : '',
                        branch_address : userInput,
                    },
                    success: function(response) {
                        // Handle success

                        if (response.status==200) {
                            alert(response.message);
                        } else {
                            alert('Error creating branch: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            }else{
                alert("Please enter a branch name")
            }
        }
    </script>
@endsection