@extends('app')

@section('content')
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Overview
                </div>
                <h2 class="page-title">
                  Dashboard
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    <a href="#" class="btn">
                      New view
                    </a>
                  </span>
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                    Create new report
                  </a>
                  <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
                <div class="row row-deck row-cards">    

                    <div class="table-responsive">
                        <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                            <tr>
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                                </th>
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


        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" id="branch_id" value="">
                            <label class="form-label">Branch Name</label>
                            <input id="branch_name" type="text" name="branch_name" class="form-control"  placeholder="Add branch Name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Branch Address</label>
                                    <textarea id="branch_address" name="branch_address" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                        </a>
                        <a id="saveBranchBtn" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
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
                        <h5 class="modal-title">New report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" id="edit_branch_id" value="">
                            <label class="form-label">Branch Name</label>
                            <input id="edit_branch_name" type="text" name="branch_name" class="form-control"  placeholder="Add branch Name">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Branch Address</label>
                                    <textarea id="edit_branch_address" name="branch_address" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                        </a>
                        <a id="editBranchBtn" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Create new branch
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('branch_list') }}", 
                    type: 'POST',
                    data: function(d) {
                        d.search = $('#search_input').val(); 
                        d.per_page = d.length;  
                        d.page = d.start / d.length + 1;  
                        d.draw = d.draw;  
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    dataSrc: function(response) {

                        if (response.status === 200) {
                            return response.data.branches; 
                        }
                        return [];  // Return an empty array if no data
                    }
                },
                columns: [
                    { data: 'branch_id', name: 'branch_id' },  
                    { data: 'branch_name', name: 'branch_name' }, 
                    { data: 'branch_address', name: 'branch_address' },  
                    { data: 'branch_added_by', name: 'branch_added_by' }, 
                    { 
                        data: 'branch_id', 
                        name: 'operations', 
                        render: function(data, type, row) {
                            return '<button class="btn btn-warning btn-sm edit-btn"  onclick="edit_branch('+ row.branch_id + ')">Edit</button>' +
                                '<button class="btn btn-warning btn-sm edit-btn"  onclick="delete_branch('+ row.branch_id + ')">Delete</button>';
                        },     
                    }   
                ],
                "pageLength": 10,  
                "lengthMenu": [10, 25, 50, 100]  
            });
       



            $('#saveBranchBtn').click(function(e) {
                e.preventDefault(); 
                var branchName    = $('#branch_name').val();
                var branchAddress = $('#branch_address').val();
                var branchId = $('#branch_id').val();
                alert(branchId);
                if (branchName && branchAddress) {
                    $.ajax({
                        url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                        type: 'POST',
                        data: {
                            _token        : csrfToken,
                            branch_name   : branchName,
                            branch_address: branchAddress,
                            branch_id     : branchId,
                        },
                        success: function(response) {
                            // Handle success

                            if (response.status==200) {
                                $('#modal-report').modal('hide');  // Hide the modal
                                $('#branch_table').DataTable().ajax.reload();  // Reload the DataTable
                                $('#branch_id').val();
                                $('#branch_name').val();
                                $('#branch_address').val();
                                alert(response.message);
                            } else {
                                alert('Error creating branch: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                } else {
                    alert('Please fill in both fields.');
                }
            });


            $('#editBranchBtn').click(function(e) {
                e.preventDefault(); 
                var branchName    = $('#edit_branch_name').val();
                var branchAddress = $('#edit_branch_address').val();
                var branchId = $('#edit_branch_id').val();
                alert(branchId);
                if (branchName && branchAddress) {
                    $.ajax({
                        url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                        type: 'POST',
                        data: {
                            _token        : csrfToken,
                            branch_name   : branchName,
                            branch_address: branchAddress,
                            branch_id     : branchId,
                        },
                        success: function(response) {
                            // Handle success

                            if (response.status==200) {
                                $('#modal-report').modal('hide');  // Hide the modal
                                $('#branch_table').DataTable().ajax.reload();  // Reload the DataTable
                                $('#edit_branch_id').val();
                                $('#edit_branch_name').val();
                                $('#edit_branch_address').val();
                                alert(response.message);
                            } else {
                                alert('Error creating branch: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                } else {
                    alert('Please fill in both fields.');
                }
            });

            
           

            function delete_branch(branch_id){

            }


        });

        function edit_branch(branch_id){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('branch_details') }}",  // Adjust the route as needed
                type: 'POST',
                data: {
                    _token        : csrfToken,

                    branch_id     : branch_id,
                },
                success: function(response) {
                    // Handle success
                    console.log("Success",response.data);
                   
                    if (response.status==200) {
                        
                        $('#edit_branch_id').val(branch_id);
                        var branchName = $('#edit_branch_name').val(response.data.branch_name);
                        var branchAddress = $('#edit_branch_address').val(response.data.branch_address);
                        $('#edit_branch').modal('show');
                    } else {
                        alert('Error fetching branch: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }




    </script>
@endsection