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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transfers</li>
                    </ol>
                </nav>
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
                                <th class="w-1">Sr No</th>

                                <th class="">Date</th>
                                <th class="">Items</th>
                                
                                <th class="">Total Orders</th>
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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>

$(document).ready(function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('transfer-list') }}",
                    type: 'POST',
                    data: function (d) {
                        d.search = d.search.value;
                        d.per_page = d.length;
                        d.page = d.start / d.length + 1;
                        d.draw = d.draw;
                        d.sort = d.order[0].column === 1 ? 'branch_name' : 'branch_id';
                        d.sortOrder = d.order[0].dir;

                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    dataSrc: function (response) {

                        if (response.status === 200) {
                            console.log(response.data);
                            return response.data;
                        }
                        return [];
                    }
                },
                columns: [
                    { data: 'serial_number', name: 'serial_number', orderable: true },
                    {
                        data: 'date', name: 'date', orderable: false, render: function (data, type, row){
                            console.log(row);
                            return row.trans_at;
                        },
                    },
                    {
                        data: 'items', 
                        name: 'items', 
                        orderable: false, 
                        render: function(data, type, row) {
                            // let itemsHTML = ''; 
                            // row.transactions[0].items.forEach(function(item) {

                            //     itemsHTML += `
                            //         <div>
                            //             <strong>Item Name:</strong> ${item.item_name}<br>
                            //             <strong>Metal:</strong> ${item.item_metal}<br>
                            //             <strong>Weight:</strong> ${item.item_weight}g<br>
                            //             <strong>Melting:</strong> ${item.item_melting}<br><br>
                            //         </div>
                            //     `;
                            // });

                            // return itemsHTML; 
                            let transactionHTML = ''; 
                            if (row.transactions && row.transactions.length > 0) {
        
                                    row.transactions.forEach(function(transaction) {
                                        transactionHTML += `
                                            <div style="margin-bottom: 10px; padding-bottom: 5px;">
                                        `;

                                        
                                        if (transaction.items && transaction.items.length > 0) {
                                            transaction.items.forEach(function(item) {
                                                transactionHTML += `
                                                    - <strong>${item.item_name}</strong> 
                                                    (Metal: ${item.item_metal}, Melting: ${item.item_melting}, 
                                                    Weight: ${item.item_weight}g
                                                    Color: ${item.colors.color_name}
                                                    ) <br>

                                                `;
                                            });
                                        } else {
                                            transactionHTML += `<em>No items available.</em>`;
                                        }

                                        transactionHTML += '</div>';
                                    });
                            } else {
                                transactionHTML = `<em>No transactions available.</em>`;
                            }

                            return transactionHTML;
                        }
                    },
                    {
                        data: 'count', name: 'count', orderable: false, render: function (data, type, row){
                            return row.transactions.length;
                        },
                    },

                    {

                        data: 'branch_id',
                        name: 'operations',
                        render: function (data, type, row) {
                            return `

                                 <ul class="action-list d-flex list-unstyled">

            <li class="action-item" title="View Receipt" onclick="view_receipt(${row.trans_id})">
                <span>            
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.45448 13.8458C1.84656 12.7245 1.84656 11.3653 2.45447 10.2441C4.29523 6.84896 7.87965 4.54492 11.9999 4.54492C16.1202 4.54492 19.7046 6.84897 21.5454 10.2441C22.1533 11.3653 22.1533 12.7245 21.5454 13.8458C19.7046 17.2409 16.1202 19.5449 11.9999 19.5449C7.87965 19.5449 4.29523 17.2409 2.45448 13.8458Z" stroke="black" stroke-width="1.6"/>
<path d="M15.0126 12C15.0126 13.6569 13.6695 15 12.0126 15C10.3558 15 9.01263 13.6569 9.01263 12C9.01263 10.3431 10.3558 9 12.0126 9C13.6695 9 15.0126 10.3431 15.0126 12Z" stroke="black" stroke-width="1.6"/>
</svg>
                            </span>


            </li>
              <li class="action-item" title="Edit Receipt" onclick="edit_receipt(${row.trans_id})">
                <span>            
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.441 9.78804L10.8714 9.22624L10.8714 9.22625L11.441 9.78804ZM16.6693 4.48756L16.0997 3.92577L16.0997 3.92577L16.6693 4.48756ZM19.5785 4.51064L18.9998 5.06299L18.9998 5.06299L19.5785 4.51064ZM19.656 4.59183L20.2347 4.03949L20.2347 4.03948L19.656 4.59183ZM19.6081 7.36308L19.0484 6.79151L19.6081 7.36308ZM14.3024 12.5589L14.8621 13.1305L14.3024 12.5589ZM13.3468 13.082L13.1649 12.3029L13.3468 13.082ZM10.8871 13.194L10.3401 13.7778H10.3401L10.8871 13.194ZM10.9166 10.7596L11.6991 10.926V10.926L10.9166 10.7596ZM10.8687 13.1763L10.3069 13.7458H10.3069L10.8687 13.1763ZM20.6015 5.99343L19.8016 5.9796V5.97961L20.6015 5.99343ZM18.1329 3.4431L18.1392 2.64312H18.1392L18.1329 3.4431ZM11.0742 10.2149L10.3716 9.83235L10.3702 9.8349L11.0742 10.2149ZM11.0708 10.2212L10.3668 9.84121L10.3654 9.84378L11.0708 10.2212ZM13.8821 12.9184L14.2668 13.6198L14.2673 13.6196L13.8821 12.9184ZM13.8803 12.9194L14.2641 13.6213L14.265 13.6208L13.8803 12.9194ZM13.5882 3.8C14.0301 3.8 14.3882 3.44183 14.3882 3C14.3882 2.55817 14.0301 2.2 13.5882 2.2V3.8ZM21.8 11.4706C21.8 11.0288 21.4418 10.6706 21 10.6706C20.5582 10.6706 20.2 11.0288 20.2 11.4706H21.8ZM4.17157 19.8284L4.73726 19.2627H4.73726L4.17157 19.8284ZM19.8284 19.8284L19.2627 19.2627L19.8284 19.8284ZM12.0105 10.3498L17.2388 5.04936L16.0997 3.92577L10.8714 9.22624L12.0105 10.3498ZM18.9998 5.06299L19.0773 5.14418L20.2347 4.03948L20.1572 3.95829L18.9998 5.06299ZM19.0484 6.79151L13.7426 11.9874L14.8621 13.1305L20.1678 7.93466L19.0484 6.79151ZM13.1649 12.3029C12.4515 12.4695 12.0023 12.5723 11.6798 12.6003C11.3673 12.6274 11.383 12.5624 11.4341 12.6103L10.3401 13.7778C10.7861 14.1957 11.3434 14.2354 11.8179 14.1943C12.2824 14.1541 12.8656 14.0158 13.5287 13.861L13.1649 12.3029ZM10.134 10.5932C9.99523 11.2461 9.87001 11.8247 9.84142 12.285C9.81195 12.7595 9.86929 13.3142 10.3069 13.7458L11.4304 12.6067C11.4828 12.6584 11.4197 12.6837 11.4383 12.3842C11.4578 12.0707 11.5491 11.631 11.6991 10.926L10.134 10.5932ZM11.4341 12.6103C11.4329 12.6091 11.4317 12.6079 11.4304 12.6067L10.3069 13.7458C10.3178 13.7566 10.3289 13.7672 10.3401 13.7778L11.4341 12.6103ZM19.0773 5.14418C19.4103 5.49305 19.6037 5.69811 19.7228 5.86171C19.8285 6.00687 19.8009 6.02119 19.8016 5.9796L21.4014 6.00726C21.4091 5.56204 21.2262 5.2082 21.0162 4.9198C20.8196 4.64984 20.5367 4.35592 20.2347 4.03949L19.0773 5.14418ZM20.1678 7.93466C20.4806 7.62832 20.7734 7.34399 20.9791 7.08078C21.1988 6.79971 21.3937 6.45237 21.4014 6.00726L19.8016 5.97961C19.8023 5.93814 19.8293 5.95363 19.7185 6.09546C19.5937 6.25517 19.3932 6.45384 19.0484 6.79151L20.1678 7.93466ZM17.2388 5.04936C17.5995 4.68368 17.8139 4.46885 17.9866 4.33569C18.1406 4.21698 18.162 4.24335 18.1265 4.24307L18.1392 2.64312C17.6738 2.63943 17.3079 2.83874 17.0098 3.06847C16.7305 3.28375 16.4281 3.59286 16.0997 3.92577L17.2388 5.04936ZM20.1572 3.95829C19.8346 3.62025 19.5374 3.3063 19.2617 3.08655C18.9674 2.85198 18.6048 2.64682 18.1392 2.64312L18.1265 4.24307C18.091 4.24279 18.1126 4.21668 18.2644 4.33768C18.4347 4.47349 18.6453 4.6916 18.9998 5.06299L20.1572 3.95829ZM10.8714 9.22625C10.7027 9.39725 10.5048 9.58771 10.3716 9.83236L11.7768 10.5974C11.772 10.6063 11.7729 10.6 11.8072 10.5611C11.8477 10.5153 11.9047 10.4571 12.0105 10.3498L10.8714 9.22625ZM11.6991 10.926C11.7302 10.7794 11.7473 10.7007 11.7631 10.6424C11.7764 10.5933 11.781 10.5896 11.7762 10.5986L10.3654 9.84378C10.2336 10.0901 10.1837 10.3598 10.134 10.5932L11.6991 10.926ZM10.3702 9.8349L10.3668 9.84121L11.7748 10.6012L11.7782 10.5949L10.3702 9.8349ZM13.7426 11.9874C13.6371 12.0907 13.5798 12.1464 13.5347 12.1861C13.4965 12.2197 13.4896 12.2212 13.4969 12.2172L14.2673 13.6196C14.5066 13.4881 14.6931 13.2959 14.8621 13.1305L13.7426 11.9874ZM13.5287 13.861C13.7615 13.8066 14.025 13.752 14.2641 13.6213L13.4965 12.2174C13.5039 12.2134 13.4985 12.2186 13.4482 12.2332C13.3893 12.2502 13.3101 12.269 13.1649 12.3029L13.5287 13.861ZM13.4974 12.217L13.4956 12.218L14.265 13.6208L14.2668 13.6198L13.4974 12.217ZM19.5656 7.43426L16.565 4.43422L15.4337 5.5657L18.4344 8.56574L19.5656 7.43426ZM13 20.2H11V21.8H13V20.2ZM3.8 13V11H2.2V13H3.8ZM11 3.8H13.5882V2.2H11V3.8ZM20.2 11.4706V13H21.8V11.4706H20.2ZM11 20.2C9.09177 20.2 7.74107 20.1983 6.71751 20.0607C5.71697 19.9262 5.14963 19.6751 4.73726 19.2627L3.60589 20.3941C4.36509 21.1533 5.32635 21.488 6.50431 21.6464C7.65927 21.8017 9.137 21.8 11 21.8V20.2ZM2.2 13C2.2 14.863 2.1983 16.3407 2.35358 17.4957C2.51195 18.6737 2.84669 19.6349 3.60589 20.3941L4.73726 19.2627C4.32489 18.8504 4.07383 18.283 3.93931 17.2825C3.8017 16.2589 3.8 14.9082 3.8 13H2.2ZM13 21.8C14.863 21.8 16.3407 21.8017 17.4957 21.6464C18.6737 21.488 19.6349 21.1533 20.3941 20.3941L19.2627 19.2627C18.8504 19.6751 18.283 19.9262 17.2825 20.0607C16.2589 20.1983 14.9082 20.2 13 20.2V21.8ZM20.2 13C20.2 14.9082 20.1983 16.2589 20.0607 17.2825C19.9262 18.283 19.6751 18.8504 19.2627 19.2627L20.3941 20.3941C21.1533 19.6349 21.488 18.6737 21.6464 17.4957C21.8017 16.3407 21.8 14.863 21.8 13H20.2ZM3.8 11C3.8 9.09177 3.8017 7.74107 3.93931 6.71751C4.07383 5.71697 4.32489 5.14963 4.73726 4.73726L3.60589 3.60589C2.84669 4.36509 2.51195 5.32635 2.35358 6.50431C2.1983 7.65927 2.2 9.137 2.2 11H3.8ZM11 2.2C9.137 2.2 7.65927 2.1983 6.50431 2.35358C5.32635 2.51195 4.36509 2.84669 3.60589 3.60589L4.73726 4.73726C5.14963 4.32489 5.71697 4.07383 6.71751 3.93931C7.74107 3.8017 9.09177 3.8 11 3.8V2.2Z" fill="black"/>
</svg>
                            </span>


            </li>

                                `;
                        },
                    }
                ],
                order: [[0, 'desc']],
                "pageLength": 10,
                "lengthMenu": [5,10, 25, 50, 100],
                "paging": true,

            });
        });


        function view_receipt(trans_id) {
            window.location.href = `/transfer-receipt-pdf/${trans_id}`;
        }


        function edit_receipt(trans_id) {
            window.location.href = `/transfer-receipt-edit/${trans_id}`;
        }


    </script>
    @endsection
