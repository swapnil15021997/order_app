@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->

                <!-- <h2 class="page-title">
                  Branch
                </h2> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('settings')}}">Settings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">branch</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if(in_array(3, $user_permissions))

                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                           
                            Create new branch
                        </a>
                    @endif
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
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

            
            <div class="row row-deck row-cards custom-table-resposive">

                <div class="table-responsive">
                    <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">
                                    Sr No
                                    <!-- <input class="form-check-input m-0 align-middle" type="checkbox"
                                        aria-label="Select all invoices"> -->
                                    </th>

                                <th>Branch Name</th>
                                <th>Branch Address</th>
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
    <input type="hidden" name="" id="delete_branch_id">

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alert-container"></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="branch_id" value="">
                        <label class="form-label">Branch Name
                            <span style="color: red;">*</span>
                        </label>
                        <input id="branch_name" required type="text" name="branch_name" class="form-control"
                            placeholder="Enter branch Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Address
                            <span style="color: red;">*</span>
                        </label>
                        <textarea id="branch_address" required name="branch_address" class="form-control"
                            rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="saveBranchBtn" href="#" class="btn btn-primary">
                       
                        Create new branch
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="edit_branch" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="alert-container"></div>

                    <div class="mb-3">
                        <input type="hidden" id="edit_branch_id" value="">
                        <label class="form-label">Branch Name
                            <span style="color: red;">*</span>
                        </label>
                        <input id="edit_branch_name" type="text" name="branch_name" class="form-control"
                            placeholder="Add branch Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Address
                            <span style="color: red;">*</span>
                        </label>
                        <textarea id="edit_branch_address" name="branch_address" class="form-control"
                            rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="editBranchBtn" href="#" class="btn btn-primary " data-bs-dismiss="modal">
                        
                        Update branch
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="delete_branch" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Do you want to delete this branch?
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="DeleteBranchBtn" href="#" class="btn btn-primary" data-bs-dismiss="modal">
                        Delete This branch
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('branch_list') }}",
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
                            return response.data;
                        }
                        return [];  // Return an empty array if no data
                    }
                },
                columns: [
                    { data: 'serial_number', name: 'serial_number', orderable: true },
                    { data: 'branch_name', name: 'branch_name', orderable: true },
                    { data: 'branch_address', name: 'branch_address', orderable: false },

                    {
                        data: 'branch_id',
                        name: 'operations',
                        render: function (data, type, row) {
                            return `
                        
                            
                            <ul class="action-list d-flex list-unstyled">
                                <li class="action-item" title="Edit Branch" onclick="edit_branch(${row.branch_id})">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.441 9.78804L10.8714 9.22624L10.8714 9.22625L11.441 9.78804ZM16.6693 4.48756L16.0997 3.92577L16.0997 3.92577L16.6693 4.48756ZM19.5785 4.51064L18.9998 5.06299L18.9998 5.06299L19.5785 4.51064ZM19.656 4.59183L20.2347 4.03949L20.2347 4.03948L19.656 4.59183ZM19.6081 7.36308L19.0484 6.79151L19.6081 7.36308ZM14.3024 12.5589L14.8621 13.1305L14.3024 12.5589ZM13.3468 13.082L13.1649 12.3029L13.3468 13.082ZM10.8871 13.194L10.3401 13.7778H10.3401L10.8871 13.194ZM10.9166 10.7596L11.6991 10.926V10.926L10.9166 10.7596ZM10.8687 13.1763L10.3069 13.7458H10.3069L10.8687 13.1763ZM20.6015 5.99343L19.8016 5.9796V5.97961L20.6015 5.99343ZM18.1329 3.4431L18.1392 2.64312H18.1392L18.1329 3.4431ZM11.0742 10.2149L10.3716 9.83235L10.3702 9.8349L11.0742 10.2149ZM11.0708 10.2212L10.3668 9.84121L10.3654 9.84378L11.0708 10.2212ZM13.8821 12.9184L14.2668 13.6198L14.2673 13.6196L13.8821 12.9184ZM13.8803 12.9194L14.2641 13.6213L14.265 13.6208L13.8803 12.9194ZM13.5882 3.8C14.0301 3.8 14.3882 3.44183 14.3882 3C14.3882 2.55817 14.0301 2.2 13.5882 2.2V3.8ZM21.8 11.4706C21.8 11.0288 21.4418 10.6706 21 10.6706C20.5582 10.6706 20.2 11.0288 20.2 11.4706H21.8ZM4.17157 19.8284L4.73726 19.2627H4.73726L4.17157 19.8284ZM19.8284 19.8284L19.2627 19.2627L19.8284 19.8284ZM12.0105 10.3498L17.2388 5.04936L16.0997 3.92577L10.8714 9.22624L12.0105 10.3498ZM18.9998 5.06299L19.0773 5.14418L20.2347 4.03948L20.1572 3.95829L18.9998 5.06299ZM19.0484 6.79151L13.7426 11.9874L14.8621 13.1305L20.1678 7.93466L19.0484 6.79151ZM13.1649 12.3029C12.4515 12.4695 12.0023 12.5723 11.6798 12.6003C11.3673 12.6274 11.383 12.5624 11.4341 12.6103L10.3401 13.7778C10.7861 14.1957 11.3434 14.2354 11.8179 14.1943C12.2824 14.1541 12.8656 14.0158 13.5287 13.861L13.1649 12.3029ZM10.134 10.5932C9.99523 11.2461 9.87001 11.8247 9.84142 12.285C9.81195 12.7595 9.86929 13.3142 10.3069 13.7458L11.4304 12.6067C11.4828 12.6584 11.4197 12.6837 11.4383 12.3842C11.4578 12.0707 11.5491 11.631 11.6991 10.926L10.134 10.5932ZM11.4341 12.6103C11.4329 12.6091 11.4317 12.6079 11.4304 12.6067L10.3069 13.7458C10.3178 13.7566 10.3289 13.7672 10.3401 13.7778L11.4341 12.6103ZM19.0773 5.14418C19.4103 5.49305 19.6037 5.69811 19.7228 5.86171C19.8285 6.00687 19.8009 6.02119 19.8016 5.9796L21.4014 6.00726C21.4091 5.56204 21.2262 5.2082 21.0162 4.9198C20.8196 4.64984 20.5367 4.35592 20.2347 4.03949L19.0773 5.14418ZM20.1678 7.93466C20.4806 7.62832 20.7734 7.34399 20.9791 7.08078C21.1988 6.79971 21.3937 6.45237 21.4014 6.00726L19.8016 5.97961C19.8023 5.93814 19.8293 5.95363 19.7185 6.09546C19.5937 6.25517 19.3932 6.45384 19.0484 6.79151L20.1678 7.93466ZM17.2388 5.04936C17.5995 4.68368 17.8139 4.46885 17.9866 4.33569C18.1406 4.21698 18.162 4.24335 18.1265 4.24307L18.1392 2.64312C17.6738 2.63943 17.3079 2.83874 17.0098 3.06847C16.7305 3.28375 16.4281 3.59286 16.0997 3.92577L17.2388 5.04936ZM20.1572 3.95829C19.8346 3.62025 19.5374 3.3063 19.2617 3.08655C18.9674 2.85198 18.6048 2.64682 18.1392 2.64312L18.1265 4.24307C18.091 4.24279 18.1126 4.21668 18.2644 4.33768C18.4347 4.47349 18.6453 4.6916 18.9998 5.06299L20.1572 3.95829ZM10.8714 9.22625C10.7027 9.39725 10.5048 9.58771 10.3716 9.83236L11.7768 10.5974C11.772 10.6063 11.7729 10.6 11.8072 10.5611C11.8477 10.5153 11.9047 10.4571 12.0105 10.3498L10.8714 9.22625ZM11.6991 10.926C11.7302 10.7794 11.7473 10.7007 11.7631 10.6424C11.7764 10.5933 11.781 10.5896 11.7762 10.5986L10.3654 9.84378C10.2336 10.0901 10.1837 10.3598 10.134 10.5932L11.6991 10.926ZM10.3702 9.8349L10.3668 9.84121L11.7748 10.6012L11.7782 10.5949L10.3702 9.8349ZM13.7426 11.9874C13.6371 12.0907 13.5798 12.1464 13.5347 12.1861C13.4965 12.2197 13.4896 12.2212 13.4969 12.2172L14.2673 13.6196C14.5066 13.4881 14.6931 13.2959 14.8621 13.1305L13.7426 11.9874ZM13.5287 13.861C13.7615 13.8066 14.025 13.752 14.2641 13.6213L13.4965 12.2174C13.5039 12.2134 13.4985 12.2186 13.4482 12.2332C13.3893 12.2502 13.3101 12.269 13.1649 12.3029L13.5287 13.861ZM13.4974 12.217L13.4956 12.218L14.265 13.6208L14.2668 13.6198L13.4974 12.217ZM19.5656 7.43426L16.565 4.43422L15.4337 5.5657L18.4344 8.56574L19.5656 7.43426ZM13 20.2H11V21.8H13V20.2ZM3.8 13V11H2.2V13H3.8ZM11 3.8H13.5882V2.2H11V3.8ZM20.2 11.4706V13H21.8V11.4706H20.2ZM11 20.2C9.09177 20.2 7.74107 20.1983 6.71751 20.0607C5.71697 19.9262 5.14963 19.6751 4.73726 19.2627L3.60589 20.3941C4.36509 21.1533 5.32635 21.488 6.50431 21.6464C7.65927 21.8017 9.137 21.8 11 21.8V20.2ZM2.2 13C2.2 14.863 2.1983 16.3407 2.35358 17.4957C2.51195 18.6737 2.84669 19.6349 3.60589 20.3941L4.73726 19.2627C4.32489 18.8504 4.07383 18.283 3.93931 17.2825C3.8017 16.2589 3.8 14.9082 3.8 13H2.2ZM13 21.8C14.863 21.8 16.3407 21.8017 17.4957 21.6464C18.6737 21.488 19.6349 21.1533 20.3941 20.3941L19.2627 19.2627C18.8504 19.6751 18.283 19.9262 17.2825 20.0607C16.2589 20.1983 14.9082 20.2 13 20.2V21.8ZM20.2 13C20.2 14.9082 20.1983 16.2589 20.0607 17.2825C19.9262 18.283 19.6751 18.8504 19.2627 19.2627L20.3941 20.3941C21.1533 19.6349 21.488 18.6737 21.6464 17.4957C21.8017 16.3407 21.8 14.863 21.8 13H20.2ZM3.8 11C3.8 9.09177 3.8017 7.74107 3.93931 6.71751C4.07383 5.71697 4.32489 5.14963 4.73726 4.73726L3.60589 3.60589C2.84669 4.36509 2.51195 5.32635 2.35358 6.50431C2.1983 7.65927 2.2 9.137 2.2 11H3.8ZM11 2.2C9.137 2.2 7.65927 2.1983 6.50431 2.35358C5.32635 2.51195 4.36509 2.84669 3.60589 3.60589L4.73726 4.73726C5.14963 4.32489 5.71697 4.07383 6.71751 3.93931C7.74107 3.8017 9.09177 3.8 11 3.8V2.2Z" fill="black"/>
                                    </svg>                            
                                </li>
                                 <li class="action-item" title="Delete Branch" onclick="delete_branch(${row.branch_id})"">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.8 6.60007V5.80007H4V6.60007H4.8ZM19.2 6.60007H20V5.80007H19.2V6.60007ZM3 5.80007C2.55817 5.80007 2.2 6.15824 2.2 6.60007C2.2 7.04189 2.55817 7.40007 3 7.40007V5.80007ZM21 6.60007V7.40007C21.4418 7.40007 21.8 7.0419 21.8 6.60007C21.8 6.15825 21.4418 5.80007 21 5.80007L21 6.60007ZM11 11.1C11 10.6582 10.6418 10.3 10.2 10.3C9.75815 10.3 9.39998 10.6582 9.39998 11.1H11ZM9.39998 16.5C9.39998 16.9419 9.75815 17.3 10.2 17.3C10.6418 17.3 11 16.9419 11 16.5H9.39998ZM14.6001 11.1C14.6001 10.6582 14.2419 10.3 13.8001 10.3C13.3582 10.3 13.0001 10.6582 13.0001 11.1H14.6001ZM13.0001 16.5C13.0001 16.9419 13.3582 17.3 13.8001 17.3C14.2419 17.3 14.6001 16.9419 14.6001 16.5H13.0001ZM4.8 7.40007H19.2V5.80007H4.8V7.40007ZM18.4 6.60007V15.0001H20V6.60007H18.4ZM13.2 20.2001H10.8V21.8001H13.2V20.2001ZM5.6 15.0001V6.60007H4V15.0001H5.6ZM10.8 20.2001C9.36317 20.2001 8.36603 20.1984 7.61478 20.0974C6.88655 19.9995 6.51029 19.8216 6.24437 19.5557L5.11299 20.6871C5.72575 21.2998 6.49593 21.5613 7.40159 21.6831C8.28423 21.8018 9.4084 21.8001 10.8 21.8001V20.2001ZM4 15.0001C4 16.3917 3.9983 17.5158 4.11697 18.3985C4.23873 19.3041 4.50024 20.0743 5.11299 20.6871L6.24437 19.5557C5.97844 19.2898 5.80061 18.9135 5.7027 18.1853C5.6017 17.434 5.6 16.4369 5.6 15.0001H4ZM18.4 15.0001C18.4 16.4369 18.3983 17.434 18.2973 18.1853C18.1994 18.9135 18.0216 19.2898 17.7556 19.5557L18.887 20.6871C19.4998 20.0743 19.7613 19.3041 19.883 18.3985C20.0017 17.5158 20 16.3917 20 15.0001H18.4ZM13.2 21.8001C14.5916 21.8001 15.7158 21.8018 16.5984 21.6831C17.5041 21.5613 18.2743 21.2998 18.887 20.6871L17.7556 19.5557C17.4897 19.8216 17.1134 19.9995 16.3852 20.0974C15.634 20.1984 14.6368 20.2001 13.2 20.2001V21.8001ZM3 7.40007H21V5.80007H3V7.40007ZM8.29997 6.6V5H6.69997V6.6H8.29997ZM9.49997 3.8H14.5V2.2H9.49997V3.8ZM15.7 5V6.6H17.3V5H15.7ZM14.5 3.8C15.1627 3.8 15.7 4.33726 15.7 5H17.3C17.3 3.4536 16.0464 2.2 14.5 2.2V3.8ZM8.29997 5C8.29997 4.33726 8.83723 3.8 9.49997 3.8V2.2C7.95357 2.2 6.69997 3.4536 6.69997 5H8.29997ZM3 7.40007C5.62184 7.40005 7.70721 7.40004 9.74999 7.40003C11.8212 7.40002 13.8497 7.40001 16.5 7.4L16.5 5.8C13.8639 5.80001 11.807 5.80002 9.74998 5.80003C7.69301 5.80004 5.63603 5.80005 3 5.80007L3 7.40007ZM16.5 7.4L21 7.40007L21 5.80007L16.5 5.8L16.5 7.4ZM9.39998 11.1V16.5H11V11.1H9.39998ZM13.0001 11.1V16.5H14.6001V11.1H13.0001Z" fill="black"/>
                                    </svg>
                    
                                </li>
                            </ul>
                            `;
                        },
                    }
                ],
                order: [[0, 'desc']],
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "paging": true,

            });
            $('input[aria-controls="branch_table"]').on('keyup', function () {
                table.search(this.value).draw();
            });




            $('#saveBranchBtn').click(function (e) {
                e.preventDefault();
                var branchName = $('#branch_name').val();
                var branchAddress = $('#branch_address').val();
                var branchId = $('#branch_id').val();

                if (branchName && branchAddress) {
                    $.ajax({
                        url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            branch_name: branchName,
                            branch_address: branchAddress,
                            branch_id: branchId,
                        },
                        success: function (response) {
                            // Handle success

                            if (response.status == 200) {
                                $('#modal-report').modal('hide');  // Hide the modal
                                $('#branch_id').val('');
                                $('#branch_name').val('');
                                $('#branch_address').val('');
                                $('#branch_table').DataTable().ajax.reload();  // Reload the DataTable
                                // alert(response.message);
                                showSuccess('success', response.message);

                            } else {
                                // alert('Error creating branch: ' + response.message);
                                showSuccess('warning', response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            // alert('An error occurred: ' + error);
                            showSuccess('warning', error);
                        }
                    });
                } else {
                    // alert('Please fill in both fields.');
                    showSuccess('warining', 'Please fill in both fields, Name and address');
                }
            });


            $('#editBranchBtn').click(function (e) {
                e.preventDefault();
                var branchName = $('#edit_branch_name').val();
                var branchAddress = $('#edit_branch_address').val();
                var branchId = $('#edit_branch_id').val();

                if (branchName && branchAddress) {
                    $.ajax({
                        url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            branch_name: branchName,
                            branch_address: branchAddress,
                            branch_id: branchId,
                        },
                        success: function (response) {
                            // Handle success

                            if (response.status == 200) {
                                $('#modal-report').modal('hide');  // Hide the modal
                                $('#edit_branch_id').val('');
                                $('#edit_branch_name').val('');
                                $('#edit_branch_address').val('');
                                $('#branch_table').DataTable().ajax.reload();  // Reload the DataTable

                                showSuccess('success', response.message);
                            } else {

                                showSuccess('warining', response.message);
                            }
                        },
                        error: function (xhr, status, error) {

                            showSuccess('error', error);
                        }
                    });
                } else {

                    showSuccess('error', 'Please fill in both fields');

                }
            });

            $('#DeleteBranchBtn').click(function (e) {
                e.preventDefault();

                var branchId = $('#delete_branch_id').val();
                if (branchId) {
                    $.ajax({
                        url: "{{ route('branch_remove') }}",
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            branch_id: branchId,
                        },
                        success: function (response) {
                            if (response.status == 200) {
                                $('#delete_branch_id').val();
                                $('#delete_branch').modal('hide');
                                $('#branch_table').DataTable().ajax.reload();
                                showSuccess('success', response.message);
                            } else {
                                showSuccess('warning', response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            showSuccess('warning', error);

                        }
                    });
                } else {
                    showSuccess('warning', 'Please fill in both fields.');
                    // alert('Please fill in both fields.');
                }
            });
        });
        function delete_branch(branch_id) {
            $('#delete_branch_id').val(branch_id);
            $('#delete_branch').modal('show');

        }




        function edit_branch(branch_id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('branch_details') }}",  // Adjust the route as needed
                type: 'POST',
                data: {
                    _token: csrfToken,

                    branch_id: branch_id,
                },
                success: function (response) {
                    // Handle success
                    console.log("Success", response.data);

                    if (response.status == 200) {

                        $('#edit_branch_id').val(branch_id);
                        var branchName = $('#edit_branch_name').val(response.data.branch_name);
                        var branchAddress = $('#edit_branch_address').val(response.data.branch_address);
                        $('#edit_branch').modal('show');
                    } else {
                        
                        alert('Error fetching branch: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }



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


        function showSuccess(type, message) {
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
