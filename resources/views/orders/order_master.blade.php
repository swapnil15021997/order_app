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



                        <a href="{{route('order-add-page', ['type' => 'order'])}}" class="btn btn-warning d-none d-sm-inline-block">

                            Order Form
                        </a>
                        <a href="{{route('order-add-page', ['type' => 'repairing'])}}" class="btn btn-primary d-none d-sm-inline-block">

                            Repairing Form
                        </a>
                        <a id="accept_btn" href="#" onclick="approve_multiple_order()" class="d-none btn btn-danger" >

                            Approve Orders
                        </a>

                        <a href="#" id="transfer_btn" onclick="transfer_order_open()" class="d-none btn btn-danger">
                            Transfer Orders
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
                <div id="alert-site"></div>
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

                <div class="alert-site">

                </div>
                <div class="table-responsive" style="overflow-y: auto;">
                    <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1"></th>

                                <th>Order Number</th>
                                <th>Customer Name</th>
                                <th>From --> To</th>
                                <th>Item</th>
                                 <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <input type="hidden" name="" id="transfer_order_id_master">
    <div class="modal modal-blur fade" id="transfer_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transfer Order</h5>
                    <button type="button" class="btn-close cancel_transfer_btn" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="transfer-container"></div>
                    <label for="searchableSelectTo" class="form-label">Order To</label>
                    <div class="row">
                        <div class="col-6 select-full">
                            <select id="searchableSelectTo" class="form-select select2">
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <a href="#" id="cancel_btn" class="btn btn-secondary cancel_transfer_btn" data-bs-dismiss="modal">
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

    <div class="modal modal-blur fade" id="transfer_order_modal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Transfer Order</h5>
                    <button type="button" class="btn-close multiple_transfer" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label class="form-label">Order To</label>
                    <div class="row">
                        <div class="col-6 select-full">
                            <select id="TransferOrder" class="form-select select-2  w-100 " type="text">
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary multiple_transfer" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="TransferOrderBtns" onclick="transfer_multiple_order()" href="#" class="btn btn-primary">
                        Transfer This Order
                    </a>
                </div>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.cancel_transfer_btn').on('click', function () {
                // Clear the select2 dropdown
                $('#searchableSelectTo').val(null).trigger('change'); 
                $('#transfer_order').modal('hide'); // Replace 'yourModalId' with your actual modal ID
                document.getElementById('transfer-container').innerHTML = '';
            });
        });


        
        $(document).ready(function () {
            $('.multiple_transfer').on('click', function () {
                // Clear the select2 dropdown
                $('#TransferOrder').val(null).trigger('change'); 
                $('#transfer_order_modal').modal('hide'); 
            });
        });
        
        let orderArray;
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
                responsive: true,
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
                            orderArray = response.data;
                            console.log(response.data);
                            return response.data;
                    //         // return {
                    //         //     draw: response.draw,
                    //         //     recordsTotal: response.recordsTotal,
                    //         //     recordsFiltered: response.recordsFiltered,
                    //         //     data: response.data
                    //         // };

                        }
                    //     return [];
                    }
                },
                order: [[0, 'desc']],
                columns: [
                    {
                        data: 'order_id',
                        name: 'order_id',
                        orderable: false,
                        render: function (data, type, row) {
                            if (row && row.order_id) {
                                return `<input type="checkbox" class="form-check-input" data-order-id="${row.order_id}">`;
                            }
                            return '';
                        }
                    },

                    { data: 'order_qr_code', name: 'order_qr_code', orderable: false,
                        render: function (data, type, row) {
                            if (row && row.order_type) {
                                return `
                                ${row.order_number}
                                <br />
                                ${row.order_date}
                                `;
                            }
                            return '';
                        }


                     },
                     { data: 'cust_name', name: 'cust_name', orderable: false,
                        render: function (data, type, row) {
                            if (row && row.cust_name) {
                                return `${row.cust_name}`;
                            }
                            return '';
                        }


                     },

                    {
                        orderable: false,
                        render: function (data, type, row) {
                            let activeBranchHtml = '';
                            let lastTransaction = row.transactions.length > 0 ? row.transactions[row.transactions.length - 1] : null;

                            if (lastTransaction != null){
                                if (lastTransaction.trans_status == 0){

                                    activeBranchHtml = `

                                        <div style="border: 2px solid rgba(0, 128, 0, 0.5); width: -webkit-max-content; padding: 4px; border-radius: 5px; color: rgba(0, 128, 0, 0.6); font-weight: 500; cursor:pointer" title="Transfer from ${lastTransaction.trans_from.branch_name} and not Accepted by ${lastTransaction.trans_to.branch_name}">
                                            Transfer -${lastTransaction.trans_from.branch_name}
                                        </div>
                                    `;


                                }else{

                                        activeBranchHtml = `

                                            <div style="border: 2px solid rgba(255, 0, 0, 0.5); width: -webkit-max-content; padding: 4px; border-radius: 5px; color: rgba(255, 0, 0, 0.6); font-weight: 500;cursor:pointer"  title="Transfer from ${lastTransaction.trans_from.branch_name} and Accepted by ${lastTransaction.trans_to.branch_name}">
                                                Approve - ${lastTransaction.trans_to.branch_name}
                                            </div>
                                        `;

                                }
                            }
                            return `<div>
                                        <span>${row.order_from_name} ==>${row.order_to_name}</span>
                                        ${activeBranchHtml}
                            </div>`
                        }
                    },
                    {
                        data: 'item',
                        name: 'item',
                        orderable: false,
                        render: function (data, type, row) {
                            if(row.items && row.items.length > 0 && row.items[0]){
                                return `${row.items[0].item_name || ''}--${row.items[0].item_metal || ''}--${row.items[0].item_weight || ''}`;
                            }else{
                                return 'No items available';
                            }
                        }
                    },
                        {
                        data: 'order_id',
                        name: 'operations',
                        orderable: false,
                        render: function (data, type, row) {

                            let dropdown = `
                           <ul class="action-list d-flex list-unstyled">
            <li class="action-item" title="Edit Order" onclick="edit_order(${row.order_id})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.441 9.78804L10.8714 9.22624L10.8714 9.22625L11.441 9.78804ZM16.6693 4.48756L16.0997 3.92577L16.0997 3.92577L16.6693 4.48756ZM19.5785 4.51064L18.9998 5.06299L18.9998 5.06299L19.5785 4.51064ZM19.656 4.59183L20.2347 4.03949L20.2347 4.03948L19.656 4.59183ZM19.6081 7.36308L19.0484 6.79151L19.6081 7.36308ZM14.3024 12.5589L14.8621 13.1305L14.3024 12.5589ZM13.3468 13.082L13.1649 12.3029L13.3468 13.082ZM10.8871 13.194L10.3401 13.7778H10.3401L10.8871 13.194ZM10.9166 10.7596L11.6991 10.926V10.926L10.9166 10.7596ZM10.8687 13.1763L10.3069 13.7458H10.3069L10.8687 13.1763ZM20.6015 5.99343L19.8016 5.9796V5.97961L20.6015 5.99343ZM18.1329 3.4431L18.1392 2.64312H18.1392L18.1329 3.4431ZM11.0742 10.2149L10.3716 9.83235L10.3702 9.8349L11.0742 10.2149ZM11.0708 10.2212L10.3668 9.84121L10.3654 9.84378L11.0708 10.2212ZM13.8821 12.9184L14.2668 13.6198L14.2673 13.6196L13.8821 12.9184ZM13.8803 12.9194L14.2641 13.6213L14.265 13.6208L13.8803 12.9194ZM13.5882 3.8C14.0301 3.8 14.3882 3.44183 14.3882 3C14.3882 2.55817 14.0301 2.2 13.5882 2.2V3.8ZM21.8 11.4706C21.8 11.0288 21.4418 10.6706 21 10.6706C20.5582 10.6706 20.2 11.0288 20.2 11.4706H21.8ZM4.17157 19.8284L4.73726 19.2627H4.73726L4.17157 19.8284ZM19.8284 19.8284L19.2627 19.2627L19.8284 19.8284ZM12.0105 10.3498L17.2388 5.04936L16.0997 3.92577L10.8714 9.22624L12.0105 10.3498ZM18.9998 5.06299L19.0773 5.14418L20.2347 4.03948L20.1572 3.95829L18.9998 5.06299ZM19.0484 6.79151L13.7426 11.9874L14.8621 13.1305L20.1678 7.93466L19.0484 6.79151ZM13.1649 12.3029C12.4515 12.4695 12.0023 12.5723 11.6798 12.6003C11.3673 12.6274 11.383 12.5624 11.4341 12.6103L10.3401 13.7778C10.7861 14.1957 11.3434 14.2354 11.8179 14.1943C12.2824 14.1541 12.8656 14.0158 13.5287 13.861L13.1649 12.3029ZM10.134 10.5932C9.99523 11.2461 9.87001 11.8247 9.84142 12.285C9.81195 12.7595 9.86929 13.3142 10.3069 13.7458L11.4304 12.6067C11.4828 12.6584 11.4197 12.6837 11.4383 12.3842C11.4578 12.0707 11.5491 11.631 11.6991 10.926L10.134 10.5932ZM11.4341 12.6103C11.4329 12.6091 11.4317 12.6079 11.4304 12.6067L10.3069 13.7458C10.3178 13.7566 10.3289 13.7672 10.3401 13.7778L11.4341 12.6103ZM19.0773 5.14418C19.4103 5.49305 19.6037 5.69811 19.7228 5.86171C19.8285 6.00687 19.8009 6.02119 19.8016 5.9796L21.4014 6.00726C21.4091 5.56204 21.2262 5.2082 21.0162 4.9198C20.8196 4.64984 20.5367 4.35592 20.2347 4.03949L19.0773 5.14418ZM20.1678 7.93466C20.4806 7.62832 20.7734 7.34399 20.9791 7.08078C21.1988 6.79971 21.3937 6.45237 21.4014 6.00726L19.8016 5.97961C19.8023 5.93814 19.8293 5.95363 19.7185 6.09546C19.5937 6.25517 19.3932 6.45384 19.0484 6.79151L20.1678 7.93466ZM17.2388 5.04936C17.5995 4.68368 17.8139 4.46885 17.9866 4.33569C18.1406 4.21698 18.162 4.24335 18.1265 4.24307L18.1392 2.64312C17.6738 2.63943 17.3079 2.83874 17.0098 3.06847C16.7305 3.28375 16.4281 3.59286 16.0997 3.92577L17.2388 5.04936ZM20.1572 3.95829C19.8346 3.62025 19.5374 3.3063 19.2617 3.08655C18.9674 2.85198 18.6048 2.64682 18.1392 2.64312L18.1265 4.24307C18.091 4.24279 18.1126 4.21668 18.2644 4.33768C18.4347 4.47349 18.6453 4.6916 18.9998 5.06299L20.1572 3.95829ZM10.8714 9.22625C10.7027 9.39725 10.5048 9.58771 10.3716 9.83236L11.7768 10.5974C11.772 10.6063 11.7729 10.6 11.8072 10.5611C11.8477 10.5153 11.9047 10.4571 12.0105 10.3498L10.8714 9.22625ZM11.6991 10.926C11.7302 10.7794 11.7473 10.7007 11.7631 10.6424C11.7764 10.5933 11.781 10.5896 11.7762 10.5986L10.3654 9.84378C10.2336 10.0901 10.1837 10.3598 10.134 10.5932L11.6991 10.926ZM10.3702 9.8349L10.3668 9.84121L11.7748 10.6012L11.7782 10.5949L10.3702 9.8349ZM13.7426 11.9874C13.6371 12.0907 13.5798 12.1464 13.5347 12.1861C13.4965 12.2197 13.4896 12.2212 13.4969 12.2172L14.2673 13.6196C14.5066 13.4881 14.6931 13.2959 14.8621 13.1305L13.7426 11.9874ZM13.5287 13.861C13.7615 13.8066 14.025 13.752 14.2641 13.6213L13.4965 12.2174C13.5039 12.2134 13.4985 12.2186 13.4482 12.2332C13.3893 12.2502 13.3101 12.269 13.1649 12.3029L13.5287 13.861ZM13.4974 12.217L13.4956 12.218L14.265 13.6208L14.2668 13.6198L13.4974 12.217ZM19.5656 7.43426L16.565 4.43422L15.4337 5.5657L18.4344 8.56574L19.5656 7.43426ZM13 20.2H11V21.8H13V20.2ZM3.8 13V11H2.2V13H3.8ZM11 3.8H13.5882V2.2H11V3.8ZM20.2 11.4706V13H21.8V11.4706H20.2ZM11 20.2C9.09177 20.2 7.74107 20.1983 6.71751 20.0607C5.71697 19.9262 5.14963 19.6751 4.73726 19.2627L3.60589 20.3941C4.36509 21.1533 5.32635 21.488 6.50431 21.6464C7.65927 21.8017 9.137 21.8 11 21.8V20.2ZM2.2 13C2.2 14.863 2.1983 16.3407 2.35358 17.4957C2.51195 18.6737 2.84669 19.6349 3.60589 20.3941L4.73726 19.2627C4.32489 18.8504 4.07383 18.283 3.93931 17.2825C3.8017 16.2589 3.8 14.9082 3.8 13H2.2ZM13 21.8C14.863 21.8 16.3407 21.8017 17.4957 21.6464C18.6737 21.488 19.6349 21.1533 20.3941 20.3941L19.2627 19.2627C18.8504 19.6751 18.283 19.9262 17.2825 20.0607C16.2589 20.1983 14.9082 20.2 13 20.2V21.8ZM20.2 13C20.2 14.9082 20.1983 16.2589 20.0607 17.2825C19.9262 18.283 19.6751 18.8504 19.2627 19.2627L20.3941 20.3941C21.1533 19.6349 21.488 18.6737 21.6464 17.4957C21.8017 16.3407 21.8 14.863 21.8 13H20.2ZM3.8 11C3.8 9.09177 3.8017 7.74107 3.93931 6.71751C4.07383 5.71697 4.32489 5.14963 4.73726 4.73726L3.60589 3.60589C2.84669 4.36509 2.51195 5.32635 2.35358 6.50431C2.1983 7.65927 2.2 9.137 2.2 11H3.8ZM11 2.2C9.137 2.2 7.65927 2.1983 6.50431 2.35358C5.32635 2.51195 4.36509 2.84669 3.60589 3.60589L4.73726 4.73726C5.14963 4.32489 5.71697 4.07383 6.71751 3.93931C7.74107 3.8017 9.09177 3.8 11 3.8V2.2Z" fill="black"/>
</svg>

            </li>
            <li class="action-item" title="View Order" onclick="view_order(${row.order_qr_code})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.45448 13.8458C1.84656 12.7245 1.84656 11.3653 2.45447 10.2441C4.29523 6.84896 7.87965 4.54492 11.9999 4.54492C16.1202 4.54492 19.7046 6.84897 21.5454 10.2441C22.1533 11.3653 22.1533 12.7245 21.5454 13.8458C19.7046 17.2409 16.1202 19.5449 11.9999 19.5449C7.87965 19.5449 4.29523 17.2409 2.45448 13.8458Z" stroke="black" stroke-width="1.6"/>
<path d="M15.0126 12C15.0126 13.6569 13.6695 15 12.0126 15C10.3558 15 9.01263 13.6569 9.01263 12C9.01263 10.3431 10.3558 9 12.0126 9C13.6695 9 15.0126 10.3431 15.0126 12Z" stroke="black" stroke-width="1.6"/>
</svg>

            </li>
            <li class="action-item" title="Order Roadmap" onclick="track_order(${row.order_id})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 21H15.9997M12 3V21M12 8.5H16.3893C16.7851 8.5 16.983 8.5 17.1762 8.4812C17.7008 8.43016 18.2101 8.27595 18.6749 8.02744C18.8461 7.93589 19.0108 7.82612 19.3401 7.60656C19.7054 7.36307 19.888 7.24132 19.9881 7.11197C20.2669 6.75163 20.2669 6.24837 19.9881 5.88803C19.888 5.75867 19.7054 5.63693 19.3401 5.39344C19.0108 5.17388 18.8461 5.06411 18.6749 4.97256C18.2101 4.72405 17.7008 4.56984 17.1762 4.5188C16.983 4.5 16.7851 4.5 16.3893 4.5H14C13.0571 4.5 12.5857 4.5 12.2929 4.79289C12 5.08579 12 5.55719 12 6.5V8.5ZM12 8.5H7.61063C7.21482 8.5 7.01691 8.5 6.82368 8.5188C6.29911 8.56984 5.78979 8.72405 5.32501 8.97256C5.1538 9.06411 4.98913 9.17388 4.6598 9.39344C4.29457 9.63693 4.11195 9.75868 4.01185 9.88803C3.73303 10.2484 3.73303 10.7516 4.01185 11.112C4.11195 11.2413 4.29457 11.3631 4.6598 11.6066C4.98913 11.8261 5.1538 11.9359 5.32501 12.0274C5.78979 12.2759 6.29911 12.4302 6.82368 12.4812C7.01691 12.5 7.21482 12.5 7.61063 12.5H12M12 8.5V12.5M12 12.5H16.3893C16.7851 12.5 16.983 12.5 17.1762 12.5188C17.7008 12.5698 18.2101 12.7241 18.6749 12.9726C18.8461 13.0641 19.0108 13.1739 19.3401 13.3934C19.7054 13.6369 19.888 13.7587 19.9881 13.888C20.2669 14.2484 20.2669 14.7516 19.9881 15.112C19.888 15.2413 19.7054 15.3631 19.3401 15.6066C19.0108 15.8261 18.8461 15.9359 18.6749 16.0274C18.2101 16.2759 17.7008 16.4302 17.1762 16.4812C16.983 16.5 16.7851 16.5 16.3893 16.5H14C13.0571 16.5 12.5857 16.5 12.2929 16.2071C12 15.9142 12 15.4428 12 14.5V12.5Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
</svg>

            </li>
            <li class="action-item" title="Delete Order" onclick="delete_order(${row.order_id})">
               <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.8 6.60007V5.80007H4V6.60007H4.8ZM19.2 6.60007H20V5.80007H19.2V6.60007ZM3 5.80007C2.55817 5.80007 2.2 6.15824 2.2 6.60007C2.2 7.04189 2.55817 7.40007 3 7.40007V5.80007ZM21 6.60007V7.40007C21.4418 7.40007 21.8 7.0419 21.8 6.60007C21.8 6.15825 21.4418 5.80007 21 5.80007L21 6.60007ZM11 11.1C11 10.6582 10.6418 10.3 10.2 10.3C9.75815 10.3 9.39998 10.6582 9.39998 11.1H11ZM9.39998 16.5C9.39998 16.9419 9.75815 17.3 10.2 17.3C10.6418 17.3 11 16.9419 11 16.5H9.39998ZM14.6001 11.1C14.6001 10.6582 14.2419 10.3 13.8001 10.3C13.3582 10.3 13.0001 10.6582 13.0001 11.1H14.6001ZM13.0001 16.5C13.0001 16.9419 13.3582 17.3 13.8001 17.3C14.2419 17.3 14.6001 16.9419 14.6001 16.5H13.0001ZM4.8 7.40007H19.2V5.80007H4.8V7.40007ZM18.4 6.60007V15.0001H20V6.60007H18.4ZM13.2 20.2001H10.8V21.8001H13.2V20.2001ZM5.6 15.0001V6.60007H4V15.0001H5.6ZM10.8 20.2001C9.36317 20.2001 8.36603 20.1984 7.61478 20.0974C6.88655 19.9995 6.51029 19.8216 6.24437 19.5557L5.11299 20.6871C5.72575 21.2998 6.49593 21.5613 7.40159 21.6831C8.28423 21.8018 9.4084 21.8001 10.8 21.8001V20.2001ZM4 15.0001C4 16.3917 3.9983 17.5158 4.11697 18.3985C4.23873 19.3041 4.50024 20.0743 5.11299 20.6871L6.24437 19.5557C5.97844 19.2898 5.80061 18.9135 5.7027 18.1853C5.6017 17.434 5.6 16.4369 5.6 15.0001H4ZM18.4 15.0001C18.4 16.4369 18.3983 17.434 18.2973 18.1853C18.1994 18.9135 18.0216 19.2898 17.7556 19.5557L18.887 20.6871C19.4998 20.0743 19.7613 19.3041 19.883 18.3985C20.0017 17.5158 20 16.3917 20 15.0001H18.4ZM13.2 21.8001C14.5916 21.8001 15.7158 21.8018 16.5984 21.6831C17.5041 21.5613 18.2743 21.2998 18.887 20.6871L17.7556 19.5557C17.4897 19.8216 17.1134 19.9995 16.3852 20.0974C15.634 20.1984 14.6368 20.2001 13.2 20.2001V21.8001ZM3 7.40007H21V5.80007H3V7.40007ZM8.29997 6.6V5H6.69997V6.6H8.29997ZM9.49997 3.8H14.5V2.2H9.49997V3.8ZM15.7 5V6.6H17.3V5H15.7ZM14.5 3.8C15.1627 3.8 15.7 4.33726 15.7 5H17.3C17.3 3.4536 16.0464 2.2 14.5 2.2V3.8ZM8.29997 5C8.29997 4.33726 8.83723 3.8 9.49997 3.8V2.2C7.95357 2.2 6.69997 3.4536 6.69997 5H8.29997ZM3 7.40007C5.62184 7.40005 7.70721 7.40004 9.74999 7.40003C11.8212 7.40002 13.8497 7.40001 16.5 7.4L16.5 5.8C13.8639 5.80001 11.807 5.80002 9.74998 5.80003C7.69301 5.80004 5.63603 5.80005 3 5.80007L3 7.40007ZM16.5 7.4L21 7.40007L21 5.80007L16.5 5.8L16.5 7.4ZM9.39998 11.1V16.5H11V11.1H9.39998ZM13.0001 11.1V16.5H14.6001V11.1H13.0001Z" fill="black"/>
                </svg>

            </li>
        `;

                            let showApprove = false;
                            let transaction_id;
                            let lastTransaction = row.transactions.length > 0 ? row.transactions[row.transactions.length - 1] : null;
                            console.log("Last Transaction",lastTransaction, row.order_id);
                            if (lastTransaction != null){
                                if (lastTransaction.trans_status == 0){
                                    showApprove=true
                                }else{
                                    showApprove=false
                                }
                            }else{
                                if(row.order_status==0){

                                    showApprove=true;
                                }else{
                                    showApprove=false;
                                }
                            }
                            // row.transactions.forEach(transaction => {

                            //     if ( transaction.trans_status === 0) {
                            //         showApprove = true;

                            //         transaction_id = transaction.trans_id;
                            //     }
                            // });

                            if (showApprove) {
                                dropdown += `
                                        <li class="action-item" title="Approve Order" onclick="approve_order_master(${row.order_qr_code})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.6704 9.39887L12.3611 13.7082C11.6945 14.3749 11.3611 14.7082 10.9469 14.7082C10.5327 14.7082 10.1994 14.3749 9.53269 13.7082L8 12.1755M11 21H13C16.7712 21 18.6569 21 19.8284 19.8284C21 18.6569 21 16.7712 21 13V11C21 7.22876 21 5.34315 19.8284 4.17157C18.6569 3 16.7712 3 13 3H11C7.22876 3 5.34315 3 4.17157 4.17157C3 5.34315 3 7.22876 3 11V13C3 16.7712 3 18.6569 4.17157 19.8284C5.34315 21 7.22876 21 11 21Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
</svg>

            </li>`;
                            }else{
                                dropdown += `
                                  <li class="action-item" title="Transfer Order" onclick="transfer_order_master(${row.order_id})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M13.5616 10.4384L9.81389 14.186M10.349 15.1085L10.5514 15.458C12.466 18.7651 13.4233 20.4187 14.7092 20.2877C15.9952 20.1567 16.5994 18.3441 17.8078 14.7188L19.5413 9.51837C20.6451 6.20679 21.1971 4.551 20.323 3.67697C19.449 2.80293 17.7932 3.35487 14.4816 4.45873L9.28119 6.1922C5.65593 7.40063 3.8433 8.00484 3.7123 9.29076C3.5813 10.5767 5.23485 11.534 8.54196 13.4486L8.89146 13.651C9.35038 13.9167 9.57983 14.0495 9.76516 14.2348C9.95048 14.4202 10.0833 14.6496 10.349 15.1085Z" stroke="black" stroke-width="1.6" stroke-linecap="round"/>
</svg>

            </li>
                                `;
                            }
                            dropdown += `</div>`;
                            return dropdown;

                        },
                    }
                ],
                initComplete: function () {

                    $('#branch_table').on('change', '.form-check-input', function () {
                        var orderId = $(this).data('order-id');
                        var isChecked = $(this).prop('checked');
                        // handleCheckboxChange(orderId, isChecked);
                        if (!handleCheckboxChange(orderId, isChecked)) {
                            $(this).prop('checked', false);
                        }
                    });
                },
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "paging": true,
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
                    alert('Please select order to delete.');
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

        function track_order(order_id){
            window.location.href = `/track-order/${order_id}`;
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





        function transfer_order_master(order_id) {

            $('#transfer_order_id_master').val(order_id);
            $('#transfer_order').modal('show');
            document.getElementById('transfer-container').innerHTML = '';
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


            $('#TransferOrderBtn').click(function (e) {
                e.preventDefault();

                var orderId = $('#transfer_order_id_master').val();
                var transferTo = $('#searchableSelectTo').val();
                if (!transferTo || transferTo === '') {
                    showAlertTransfer('warning', 'Please select a branch to transfer to.');
                    return;
                }
                if (orderId) {
                    $('body').addClass('loading');
                    $('#TransferOrderBtn').prop('disabled', true);

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
                                $('body').removeClass('loading');
                                $('#TransferOrderBtn').prop('disabled', false);

                                showAlertTransfer('success', response.message);
                                $('#transfer_order_id_master').val('');
                                $('#searchableSelectTo').val(null).trigger('change');
                                 $('#branch_table').DataTable().ajax.reload();


                                setTimeout(function () {
                                    document.getElementById('transfer-container').innerHTML = '';
                                    $('#transfer_order').modal('hide');
                                }, 2000);
                            } else {
                                $('body').removeClass('loading');
                                $('#searchableSelectTo').val(null).trigger('change');
                                $('#TransferOrderBtn').prop('disabled', false);
                                showAlertTransfer('warning', response.message);
                                
                            }
                        },
                        error: function (xhr, status, error) {
                            $('#searchableSelectTo').val(null).trigger('change');

                            $('body').removeClass('loading');
                            $('#TransferOrderBtn').prop('disabled', false);
                            showAlertTransfer('warning', error);
 

                        }
                    });
                } else {
                    showAlertTransfer('warning', 'Please select at least one order.');
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
        function approve_order_master(transaction_id) {
            if (transaction_id) {
                $('body').addClass('loading');
                $.ajax({
                    url: "{{ route('order_approve') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        trans_id: transaction_id,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('body').removeClass('loading');
                            $('#branch_table').DataTable().ajax.reload();
                            showAlertOrder('success', response.message);
                        } else {
                            $('body').removeClass('loading');
                            showAlertOrder('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        $('body').removeClass('loading');
                        showAlertOrder('warning', error.message);
                    }
                });
            } else {
                showAlertOrder('warning', 'Please select Transaction id');
            }
        }


        function handleCheckboxChange(orderId, isChecked) {
            console.log(orderArray)
            if (isChecked) {
                // CheckType(orderId);
                return CheckType(orderId);
            } else {
                console.log('Checkbox for order ID ' + orderId + ' is unchecked.');
                RemoveFromArray(orderId);
            }

            return true;
        }

        let approve_orders_array  = [];
        let transfer_orders_array = [];
        let scanned_orders        = [];
        let mismatch       = [];
        function CheckType(order_id){

            let order = orderArray.find(order => order.order_id === order_id);
            let lastTransaction = order.transactions.length > 0 ? order.transactions[order.transactions.length - 1] : null;

            let isAnyOrderApproved    = approve_orders_array.length > 0;
            let isAnyOrderTransferred = transfer_orders_array.length > 0;
            console.log("Last Transaction",lastTransaction)
            if (lastTransaction != null){

                if (lastTransaction.trans_status === 1 && isAnyOrderApproved) {
                    mismatch.push(order_id);
                    toggleButtons();
                    alert("Previous order was approved, and the current order is of transfer. Please handle accordingly.");
                    return false;
                }
                if (lastTransaction.trans_status === 0 && isAnyOrderTransferred) {
                    mismatch.push(order_id);
                    toggleButtons();
                    alert("Previous order was transfer, and the current order is of approve. Please handle accordingly.");
                    return false;
                }
                if (lastTransaction.trans_status === 0) {
                    // Add to approve_orders_array
                    approve_orders_array.push(order_id);

                }
                else {

                    transfer_orders_array.push(order_id);


                }
            }else{
                approve_orders_array.push(order_id);
            }
            toggleButtons();
            return true;
        }


        function RemoveFromArray(orderId){

            approve_orders_array  = approve_orders_array.filter(id => id !== orderId);
            transfer_orders_array = transfer_orders_array.filter(id => id !== orderId);
            scanned_orders        = scanned_orders.filter(id => id !==orderId);
            mismatch       = mismatch.filter(id => id !== orderId);
            toggleButtons();
        }


        function toggleButtons(){
            console.log("toggleButtons Approve",approve_orders_array);
            console.log("toggleButtons Transfer",transfer_orders_array);
            console.log("Mismatch Transfer",mismatch);

            // if (mismatch.length > 0) {
            //     $('#accept_btn').prop('disabled', true).addClass('d-none');
            //     $('#transfer_btn').prop('disabled', true).addClass('d-none');
            // }else{

                if (approve_orders_array.length > 0) {
                    $('#accept_btn').prop('disabled', false).removeClass('d-none');
                } else {
                    $('#accept_btn').addClass('d-none');
                }

                // Show "Transfer" button if there are any transferred orders
                if (transfer_orders_array.length > 0) {
                    $('#transfer_btn').prop('disabled', false).removeClass('d-none');
                } else {
                    $('#transfer_btn').addClass('d-none');
                }
            // }

        }


        function transfer_order_open() {
            $('#transfer_order_modal').modal('show');
            document.getElementById('transfer-container').innerHTML = '';
        }



        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#TransferOrder').select2({
            dropdownParent: $('#transfer_order_modal'),
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


        function transfer_multiple_order(){
            console.log("Transfer",transfer_orders_array);
            if (transfer_orders_array.length == 0){
                alert('Cant transfer with empty array');
            }
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var transferTo = $('#TransferOrder').val();
            
            if (!transferTo || transferTo === '') {
                showAlertTransfer('warning', 'Please select a branch to transfer to.');
                return;
            }

            $('body').addClass('loading');
            $('#TransferOrderBtns').prop('disabled', true);

            $.ajax({
                url: "{{ route('multiple_transfer') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    order_id: transfer_orders_array,
                    transfer_to: transferTo

                },
                success: function (response) {
                    if (response.status == 200) {
                        $('body').removeClass('loading');
                        $('#TransferOrderBtns').prop('disabled', false);

                        $('#transfer_order_id').val('');
                        $('#TransferOrder').val(null).trigger('change');
                        $('#transfer_order_modal').modal('hide');

                        alert(response.message);
                        showAlert('success', response.message);

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        $('body').removeClass('loading');
                        $('#TransferOrderBtns').prop('disabled', false);

                        $('#TransferOrder').val(null).trigger('change');
                        $('#transfer_order_modal').modal('hide');

                        alert(response.message);

                        showAlert('warning', response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);


                    }
                },
                error: function (xhr, status, error) {
                    $('body').removeClass('loading');
                    $('#TransferOrder').val('');
                    $('#TransferOrderBtns').prop('disabled', false);

                    showAlert('success', error);


                }
            });
        }

        function approve_multiple_order(){

            if (approve_orders_array.length == 0){
                alert('Cant approve with empty array');
            }
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('body').addClass('loading');
            $('#accept_btn').prop('disabled', true);

            $.ajax({
                url: "{{ route('multiple_approve') }}",
                type: 'POST',
                data: {
                    _token  : csrfToken,
                    order_id: approve_orders_array
                },
                success: function (response) {
                    if (response.status == 200) {

                        $('body').removeClass('loading');
                        $('#accept_btn').prop('disabled', false);
                        showAlert('success', response.message);
                        alert(response.message);

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        $('body').removeClass('loading');
                        $('#accept_btn').prop('disabled', false);
                        alert(response.message);

                        showAlert('warning', response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                    }
                },
                error: function (xhr, status, error) {
                    $('body').removeClass('loading');
                    $('#accept_btn').prop('disabled', false);
                    showAlert('success', error);
                }
            });
        }
    </script>
    @endsection
