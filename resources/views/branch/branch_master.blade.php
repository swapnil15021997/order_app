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
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                        aria-label="Select all invoices"></th>

                                <th>Branch Name</th>
                                <th>Branch Address</th>
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
                        <label class="form-label">Branch Name</label>
                        <input id="branch_name" required type="text" name="branch_name" class="form-control"
                            placeholder="Add branch Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Address</label>
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
                        <label class="form-label">Branch Name</label>
                        <input id="edit_branch_name" type="text" name="branch_name" class="form-control"
                            placeholder="Add branch Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Address</label>
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
                            return response.data.branches;
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
                            return `<button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split"></button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#" onclick="edit_branch(${row.branch_id})">
                                    Edit
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="delete_branch(${row.branch_id})">
                                    Delete
                                  </a>
                                </div>`;
                        },
                    }
                ],
                order: [[0, 'desc']],
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100]
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
