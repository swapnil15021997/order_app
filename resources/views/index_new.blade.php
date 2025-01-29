@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- <h2 class="page-title">
                    Dashboard
                    </h2> -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="{{route('dashboard')}}">Home</a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if($login['user_role_id'] == 1)
            <div id="alert-site"></div>
            <div class="row row-deck row-cards mb-3">
                <div class="col-12">
                    <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$user_count}} Users
                                </div>
                                <div class="text-secondary">
                                {{$user_count}} Total Users
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                                    <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/>
                                    <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/>
                                </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$branch_count}} Branch
                                </div>
                                <div class="text-secondary">
                                {{$branch_count}} Total Branches
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                    <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                                </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$order_count}} Orders
                                </div>
                                <div class="text-secondary">
                                {{$order_count}} Total Orders
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                            <div class="col-auto">
                                <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                                        </svg>
                                </span>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                {{$total_role}} Roles
                                </div>
                                <div class="text-secondary">
                                {{$total_role}} Total Roles
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                
            </div>
            @endif

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transfer or Accept with Order Numbers</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <textarea  name="" class="form-control" id="qr_code_numbers" placeholder="Please provide order number in comma seperated format"></textarea>
                                </div>
                                <div class="col-md-4 mt-3">
                                
                                    <a id="accept_button" href="#" onclick="approve_qr_order()" class="d-none btn btn-danger" >
                                        Approve Orders
                                    </a>
                                    <a href="#" id="transfer_button" onclick="transfer_multiple()" class="d-none btn btn-danger">
                                        Transfer Orders
                                    </a>
                                </div>
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <!-- <button id="detailBtn" onclick="get_details_of_qr_code()" class="btn btn-secondary"> Click Here to Approve or Transfer </button> -->
                                    <button id="mismatchBtn" onclick="remove_mismatch()" class="btn d-none btn-secondary"> Remove Mismatch QR </button>
                                    <button id="resetBtn" onclick="reset()" class="btn d-none btn-secondary"> Reset </button>
                                </div>
                                
                            </div>

                            <div id="orders" class="row mt-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Approved Orders</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Order Date</th>
                                        <th>Order Type</th>
                                        <th>Order From</th>
                                        <th>Order To</th>
                                        <th>View</th>
                                    </tr>
                                </thead>

                                <tr>
                                @foreach ($order as $order)
                                    <td class="text-secondary">
                                        
                                        {{$order['order_date']}}
                                    </td>
                                    <td class="text-secondary">   
                                            {{$order['order_type']}}
                                    </td>
                                    <td class="text-secondary">{{$order['order_from_name']}}</td>
                                    <td class="text-secondary">{{$order['order_to_name']}}</td>
                                    <td class="text-end w-1">
                                        <a href="#" onclick="ViewOrder({{$order['order_qr_code']}})">View</a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Branch</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Branch Name</th>
                                    </tr>
                                </thead>

                                <tr>
                                @foreach ($branch as $index => $branch)
                                    <td class="text-secondary">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-secondary">   
                                        {{$branch['branch_name']}}

                                    </td>
                                </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                    
              </div>
            </div>

        </div>

        <div class="modal modal-blur fade" id="transfer_multiple" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Transfer Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label class="form-label">Order To</label>
                        <div class="row">
                            <div class="col-6 select-full">
                                <select id="TransferHome" class="form-select select-2  w-100 " type="text">
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <a id="TransferChalanBtn" onclick="transfer_qr_open()" href="#" class="btn btn-primary">
                            Transfer This Order
                        </a>
                    </div>

                </div>
            </div>
        </div>
    <div>

   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>

        $('document').ready(function (){
            $('#resetBtn').addClass('d-none');
        });

        function ViewOrder(order_id){
            window.location.href = `/view-order/${order_id}`;
        }

        let approve_qr_array  = [];
        let transfer_qr_array = [];
        let total_qr_array    = [];
        let mismatch_qr = [];
        
        function get_details_of_qr_code(){
            var qr_num = $('#qr_code_numbers').val();
            var qr_num_array = qr_num.split(',');
            total_qr_array = qr_num_array
            $('#resetBtn').removeClass('d-none');
            $('#qr_code_numbers').val('')
            // $('#detailBtn').addClass('d-none');
            
            $.ajax({
                url: "{{ route('qr_details') }}",  
                type: 'POST',
                data: {
                    _token: csrfToken,

                    qr_number: qr_num,
                },
                success: function (response) {
                    if(response.status==200){
                        console.log(response);
                        // response.data.forEach(order => {
                            var order = response.data[0];
                            let lastTransaction = order.transactions[order.transactions.length - 1];
                            console.log(lastTransaction);
                            let isAnyOrderApproved = approve_qr_array.length > 0;
                            let isAnyOrderTransferred = transfer_qr_array.length > 0;
                            if (lastTransaction != null){
                                if (lastTransaction.trans_status === 1 && isAnyOrderApproved) {
                                    mismatch_qr.push({ order_id: order.order_id, qr_code: order.order_qr_code });
                                    toggleButtons();
                                    show_data_on_page(order);
                                    alert(`Previous order was approved, and the current order is of transfer. Please remove. ${order.order_qr_code}`);
                                    return false;
                                }
                                if (lastTransaction.trans_status === 0 && isAnyOrderTransferred) {
                                    mismatch_qr.push({ order_id: order.order_id, qr_code: order.order_qr_code });

                                    toggleButtons();
                                    show_data_on_page(order);
                                    alert(`Previous order was transfer, and the current order is of approve. Please remove. ${order.order_qr_code}`);
                                    return false;
                                }
                                if (lastTransaction.trans_status === 0) {
                                    // Add to approve_orders_array
                                    approve_qr_array.push({ order_id: order.order_id, qr_code: order.order_qr_code });
                                    show_data_on_page(order);
                                }
                                else {

                                    transfer_qr_array.push({ order_id: order.order_id, qr_code: order.order_qr_code });
                                    show_data_on_page(order);
                                }
                            }else{
                                approve_qr_array.push({ order_id: order.order_id, qr_code: order.order_qr_code });
                                show_data_on_page(order);
                            }
                        toggleButtons();
                        return true;   
                        // });  
                    }else{
                        alert('Error',response.message);
                    }
                }

          });


        }


        function toggleButtons(){
            console.log("All 3 Arrays are",approve_qr_array);
            console.log("Transfer",transfer_qr_array);
            console.log("Approve",mismatch_qr);
            if (approve_qr_array.length > 0) {
                $('#accept_button').prop('disabled', false).removeClass('d-none');
            } else {
                $('#accept_button').addClass('d-none');
            }

            // Show "Transfer" button if there are any transferred orders
            if (transfer_qr_array.length > 0) {
                $('#transfer_button').prop('disabled', false).removeClass('d-none');
            } else {
                $('#transfer_button').addClass('d-none');
            }

            if (approve_qr_array.length === 0 && transfer_qr_array.length === 0) {
                $('#accept_button').addClass('d-none');
                $('#transfer_button').addClass('d-none');
            }
            if (mismatch_qr.length > 0) {
                $('#mismatchBtn').removeClass('d-none');
                $('#accept_button').addClass('d-none');
                $('#transfer_button').addClass('d-none');                
            }

        }

        function reset(){

            approve_qr_array  = [];
            transfer_qr_array = [];
            total_qr_array    = [];
            mismatch_qr       = [];
            $('#qr_code_numbers').val('');
            $('#detailBtn').removeClass('d-none');
            $('#resetBtn').addClass('d-none');
            $('#accept_button').addClass('d-none');
            $('#transfer_button').addClass('d-none');
            
            
        }

        function remove_mismatch(){
            approve_qr_array  = approve_qr_array.filter(item => !mismatch_qr.includes(item.qr_code));
            transfer_qr_array = transfer_qr_array.filter(item => !mismatch_qr.includes(item.qr_code));
            // clear container

            mismatch_qr.forEach(qrCode => {
                console.log(qrCode);
                $(`#orders [data-index="${qrCode.qr_code}"]`).remove();
            });
            mismatch_qr = [];
          
            let aprove_qr = approve_qr_array.map(item => item.qr_code);            
            let transfer_qr = transfer_qr_array.map(item => item.qr_code);            
          
            // $('#qr_code_numbers').val(aprove_qr.join(', ')); 
            // $('#qr_code_numbers').val(transfer_qr.join(', ')); 
            $('#mismatch_qr').addClass('d-none');
            toggleButtons();
        }
        
        $(document).ready(function() {
          

            $('#qr_code_numbers').on('paste', function (event) {
                const element = $(this);
        
                setTimeout(function () {
                    const pastedValue = element.val();
                    get_details_of_qr_code(pastedValue);

                });
            });

        });

        function approve_qr_order(){
            let orderIds = approve_qr_array.map(item => item.order_id);            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('body').addClass('loading');
            $('#accept_btn').prop('disabled', true);

            $.ajax({
                url: "{{ route('multiple_approve') }}",
                type: 'POST',
                data: {
                    _token  : csrfToken,
                    order_id: orderIds
                },
                success: function (response) {
                    if (response.status == 200) {

                        $('body').removeClass('loading');
                        $('#accept_button').prop('disabled', false);
                        showAlert('success', response.message);
                        alert(response.message);

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        $('body').removeClass('loading');
                        $('#accept_button').prop('disabled', false);
                        alert(response.message);

                        showAlert('warning', response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                    }
                },
                error: function (xhr, status, error) {
                    $('body').removeClass('loading');
                    $('#accept_button').prop('disabled', false);
                    showAlert('success', error);
                }
            });
        }


        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#TransferHome').select2({
            dropdownParent: $('#transfer_multiple'),
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

        function transfer_multiple() {

            $('#transfer_multiple').modal('show');
        }


        function transfer_qr_open(){
            
            let orderIds = transfer_qr_array.map(item => item.order_id);            
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var transferTo = $('#TransferHome').val();
            $('body').addClass('loading');
            $('#TransferChalanBtn').prop('disabled', true);
          
            $.ajax({
                url: "{{ route('multiple_transfer') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    order_id: orderIds,
                    transfer_to: transferTo

                },
                success: function (response) {
                    if (response.status == 200) {
                        $('body').removeClass('loading');
                        $('#TransferChalanBtn').prop('disabled', false);
          
                        $('#TransferHome').val('');
                        $('#transfer_multiple').modal('hide');
                        alert(response.message);
                        showAlert('success', response.message);

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        $('body').removeClass('loading');
                        $('#TransferChalanBtn').prop('disabled', false);
                        alert(response.message);

                        showAlert('success', response.message);
                        $('#TransferHome').val('');


                    }
                },
                error: function (xhr, status, error) {
                    $('body').removeClass('loading');
                    $('#TransferChalanBtn').prop('disabled', false);
                    showAlert('success', error);

                    $('#TransferHome').val('');

                }
            });
        }


        
        function show_data_on_page(order){
            console.log("Order show",order);

            const container = $("#orders");
            if (order.items && order.items.length > 0) {
                order.items.forEach((item, index) => {
                      const itemHtml = `
                        <div class="col-md-4 mb-3" data-index="${order.order_qr_code}">
                            <div class="card p-3 shadow-sm">
                                <h5 class="card-title">${item.item_name}</h5>
                                <p class="card-text">
                                    <strong>Metal:</strong> ${item.item_metal}  <strong>Melting:</strong> ${item.item_melting} <br>
                                    <strong>Weight:</strong> ${item.item_weight}g  
                                    <strong>Color:</strong> ${item.colors?.color_name || "N/A"} <br>
                                </p>
                            </div>
                        </div>
                    `;

                    container.append(itemHtml);
                });
            }
        }
          
     
    </script>

    @endsection
