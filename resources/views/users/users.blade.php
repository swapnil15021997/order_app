@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('user-master')}}">Users & Permissions</a></li>
                            <li class="breadcrumb-item" aria-current="page">User List</li>
                        </ol>
                    </nav>
                    <br/>

                    <h2 class="page-title">
                        User Roles
                    </h2>
                    <div class="text-secondary mt-1" id="pagination_code"></div>
                </div>
                <!-- Page title actions -->
               
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
                <!-- <div class="col-md-6 col-lg-3">
                   
                </div> -->
                @if(in_array(13, $user_permissions))

                <div class="row row-deck row-cards mb-3">
                    @foreach ($roles as $role)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                <div class="subheader">Total Users {{ $role['users_count'] }}</div>
                                    
                                </div>
                                <div class="h1 mb-3">Role Name: {{$role['role_name']}}</div>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="#" onclick="edit_role({{$role['role_id']}})" class="btn btn-primary d-none d-sm-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                        </svg>
                                        Edit Role
                                    </a>

                                    <a href="#" onclick="delete_user({{$role['role_id']}})" class="btn btn-primary d-none d-sm-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                        Delete Role
                                    </a>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="row mb-3">
                <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Create New Role</div>                                    
                                </div>
                                <div>
                                <a href="{{route('role-add')}}" class="btn btn-primary d-none d-sm-inline-block">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                        New Role
                                    </a>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                        <!-- <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/> -->
                        
                        <a href="{{route('user-add')}}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            New user
                        </a>
    
                    
                        </div>
                    </div>
                </div>
                <div class="row row-deck row-cards">    
                    <div class="table-responsive">
                        <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                            <tr>
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                
                                <th>User Name</th>
                                <th>Phone No</th>
                                <th>Role</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
<!--             
            <div class="d-flex mt-4">
              <ul class="pagination ms-auto" id="paginationLinks">
               
              </ul>
            </div> -->
        </div>
    </div>


    <div class="modal modal-blur fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">
    
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                        
                            <div class="mb-3">

                                <label class="form-label">User Name</label>
                                <input type="text" id="user_name" class="form-control" placeholder="User Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" id="user_phone_no" class="form-control" placeholder="User Phone Number">
                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                    
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">User Role</label>

                            </div>
                            
                        </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">User Address</label>
                            <textarea id="user_address" name="user_address" class="form-control" rows="3"></textarea>

                        </div>
                    </div>
                    </div>            
                </div>
           
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="updateOrderBtn">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Save User
                    </a>
            
                </div>
            </div>
        </div>
    </div>
    

    <input type="hidden" name="" id="delete_user_id">
    <div class="modal modal-blur fade" id="delete_user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Do you want to delete this user?
                        </div>
                </div>
                
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                    </a>
                    <a id="DeleteUserBtn" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Delete This User
                    </a>
                </div>
            </div>
        </div>
    </div>

    
    <input type="hidden" name="" id="delete_role_id">
    <div class="modal modal-blur fade" id="delete_role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Do you want to delete this user?
                        </div>
                </div>
                
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                    </a>
                    <a id="DeleteUserBtn" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Delete This User
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        
        $(document).ready(function () {
            // Fetch users on page load
            // fetchUsers();

            // Search event
            // $('input[type="search"]').on('input', function () {
            //     fetchUsers(1, $(this).val());
            // });

            // Pagination event
            // $(document).on('click', '.pagination a', function (e) {
            //     e.preventDefault();
            //     const page = $(this).attr('data-page');
            //     fetchUsers(page);
            // });

            // function fetchUsers(page = 1, search = '') {
            //     const perPage = 5; 

            //     $.ajax({
            //         url: '{{ route("user-list")}}', 
            //         type: 'POST',
            //         data: {
            //             _token: $('meta[name="csrf-token"]').attr('content'), 
            //             search: search,
            //             per_page: perPage,
            //             page: page,
            //         },
            //         success: function (response) {
            //             // Update user list
            //             let usersHtml = '';
            //             response.data.users.forEach(user => {
            //                 usersHtml += `
            //                     <div class="col-md-6 col-lg-3">
            //                         <div class="card">
            //                             <div class="card-body p-4 text-center">
            //                                 <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(/path/to/user/image)"></span>
            //                                 <h3 class="m-0 mb-1"><a href="#">${user.user_name}</a></h3>
            //                                 <div class="text-secondary">${user.role_name}</div>
                                             
            //                             </div>
            //                             <div class="d-flex">
            //                                 <a href="#" class="card-btn" onclick="editUser(${user.id})">Edit</a>
            //                                 <a href="#" class="card-btn" onclick="delete_user(${user.id})">Delete</a>
            //                             </div>
            //                         </div>
            //                     </div>
            //                 `;
            //             });
            //             $('.row-cards').html(usersHtml);

            //             // Update pagination
            //             let paginationHtml = '';
            //             for (let i = 1; i <= response.data.total_pages; i++) {
            //                 paginationHtml += `
            //                     <li class="page-item ${response.data.current_page == i ? 'active' : ''}">
            //                         <a class="page-link" href="#" data-page="${i}">${i}</a>
            //                     </li>
            //                 `;
            //             }
            //             $('#paginationLinks').html(paginationHtml);
            //             const userCountText = `${1} - ${response.data.total} of ${response.data.total_pages}`;
            //             $('#pagination_code').text(userCountText);

            //         },
            //     });
            // }

           
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user-list') }}", 
                    type: 'POST',
                    data: function(d) {
                        d.search   = d.search.value; 
                        d.per_page = d.length;  
                        d.page     = d.start / d.length + 1;  
                        d.draw     = d.draw;  
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    dataSrc: function(response) {
                        console.log(response.data);
                        if (response.status === 200) {
                            return response.data.users; 
                        }
                        return [];  // Return an empty array if no data
                    }
                },
                columns: [
                    { data: 'serial_number', name: 'serial_number' },  
                    { data: 'user_name', name: 'user_name' }, 
                    { data: 'user_phone_number', name: 'user_phone_number' }, 
                    { data: 'role_name', name: 'role_name' },  
                    { 
                        data: 'user_id', 
                        name: 'operations', 
                        render: function(data, type, row) {
                            return `<button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split"></button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#" onclick="edit_order(${row.user_id})">
                                    Edit
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="view_order(${row.user_id})">
                                    View
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="view_qr_code(${row.user_id})">
                                    Show QR 
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="delete_order(${row.order_id})">
                                    Delete
                                  </a>
                                </div>`;
                                
                        },     
                    }   
                ],
                "pageLength": 10,  
                "lengthMenu": [10, 25, 50, 100]  
            });
            $('input[aria-controls="branch_table"]').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#DeleteUserBtn').click(function(e) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                alert();
                e.preventDefault(); 

                var userId = $('#delete_user_id').val();
                if (userId) {
                    $.ajax({
                        url: "{{ route('user_remove') }}",  
                        type: 'POST',
                        data: {
                            _token        : csrfToken,
                            user_id       : userId,
                        },
                        success: function(response) {
                            if (response.status==200) {
                                $('#delete_user_id').val();
                                $('#delete_user').modal('hide');
                                location.reload();
                                alert(response.message);
                            } else {
                                alert('Error deleting order: ' + response.message);
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

        });
        function editUser(userId) {
            // Redirect to the edit page and pass the user ID
            window.location.href = `/edit-user/${userId}`;
        }

        function delete_user(order_id){
            $('#delete_user_id').val(order_id);
            $('#delete_user').modal('show');
      
        }

        function edit_role(userId) {
            // Redirect to the edit page and pass the user ID
            window.location.href = `/edit-role/${userId}`;
        }

        function delete_role(order_id){
            $('#delete_role_id').val(order_id);
            $('#delete_role').modal('show');
      
        }

    </script>
@endsection