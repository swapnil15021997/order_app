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

                                    <a href="#" onclick="delete_role({{$role['role_id']}})" class="btn btn-primary d-none d-sm-inline-block">
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-role" class="btn btn-primary d-none d-sm-inline-block">

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


    <div class="modal modal-blur fade" id="modal-role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alert-container"></div>
                <div class="model-body">
                     
                      
                </div>
                <div class="modal-body">
                    <div id="save-role-container"></div>
                
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" id="role_name" class="form-control" placeholder="User Name">
                    </div>
                  
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Create</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $module['module_name'] }}</td>

                                    @foreach ($module['permissions'] as $permission)
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                id="save_permission_{{ $permission['permission_id'] }}" 
                                                name="permission_{{ $permission['permission_id'] }}" 
                                                name="permission_{{ $permission['permission_id'] }}" 
                                                data-module-id="{{ $module['module_id'] }}"  
                                                @if (in_array($permission, array_column($module['permissions'], 'permission_name')))  @endif
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>

                    </div>
                </div>
                <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                        </a>
                        <a id="saveRole" href="#" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Create Role
                        </a>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="" id="edit_role_id">
    <div class="modal modal-blur fade" id="update-role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="update-role-container"></div>
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" id="edit_role_name" class="form-control" placeholder="User Name">
                    </div>
                  
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Create</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $module['module_name'] }}</td>

                                    @foreach ($module['permissions'] as $permission)
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                id="role_permission_{{ $permission['permission_id'] }}" 
                                                name="permission_{{ $permission['permission_id'] }}" 
                                                name="permission_{{ $permission['permission_id'] }}" 
                                                data-module-id="{{ $module['module_id'] }}"  
                                                @if (in_array($permission, array_column($module['permissions'], 'permission_name')))  @endif
                                            >
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>

                    </div>
                </div>
                <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                        </a>
                        <a id="UpdateRole" href="#" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        Update Role
                        </a>
                </div>
            </div>
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
                    <h5 class="modal-title">Delete Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Do you want to delete this role?
                        </div>
                </div>
                
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                    </a>
                    <a id="DeleteRoleBtn" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Delete This Role
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
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
            });
            $('#saveRole').on('click', function (e) {

                e.preventDefault();  
                const userName = $('#role_name').val();
             
                // Validate data
                if (!userName ) {
                    alert('Please fill all fields and select at least one permission.');
                    return;
                }
                const permissionIds = [];
                const moduleIds = [];
                $('input[type="checkbox"]:checked').each(function () {
                   
                    const permissionId = $(this).attr('id').replace('save_permission_', '');  // Extract permission_id from id
                    const moduleId = $(this).data('module-id'); 
                    permissionIds.push(permissionId);
                    if (!moduleIds.includes(moduleId)) {
                        moduleIds.push(moduleId);
                    }
                });
                // Prepare data to be sent
                const data = {
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    role_id          :null,
                    role_name        : userName,
                    user_permission  : permissionIds.join(','), 
                    user_module      : moduleIds.join(','),
                    
                };

                $.ajax({
                    url: "{{ route('role_add_and_edit') }}", 
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.status==200) {
                            alert('Role added successfully');
                            location.href = "{{route('user-master')}}";
                            $('#modal-role').modal('hide');
                            showAlertSaveRole('success', response.message);
                        } else {
                            alert('Failed to add user: ' + response.message);
                            showAlertSaveRole('warning', response.message);

                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        showAlertSaveRole('warning', xhr.responseJSON.message);

                        alert('An error occurred: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
        
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
                        d.sort = d.order[0].column === 1 ? 'user_name' : 'id'; 
                        d.sortOrder = d.order[0].dir; 
     
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
                    { data: 'serial_number', name: 'serial_number',orderable: true },  
                    { data: 'user_name', name: 'user_name',orderable: true }, 
                    { data: 'user_phone_number', name: 'user_phone_number',orderable: false }, 
                    { data: 'role_name', name: 'role_name', orderable: false},  
                    { 
                        data: 'user_id', 
                        name: 'operations', 
                        render: function(data, type, row) {
                            console.log(row);
                            return `<button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split"></button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#" onclick="editUser(${row.id})">
                                    Edit
                                  </a>
                                  
                                  <a class="dropdown-item" href="#" onclick="delete_user(${row.id})">
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


            $('#UpdateRole').on('click', function (e) {

                e.preventDefault();  
                const role_id      = $('#edit_role_id').val();
                const role_name    = $('#edit_role_name').val();


                // Validate data
                if (!role_name ) {
                    alert('Please fill all fields and select at least one permission.');
                    return;
                }
                const permissionIds = [];
                const moduleIds = [];
                $('input[type="checkbox"]:checked').each(function () {
                
                    const permissionId = $(this).attr('id').replace('role_permission_', '');  // Extract permission_id from id
                    const moduleId = $(this).data('module-id'); 
                    permissionIds.push(permissionId);
                    if (!moduleIds.includes(moduleId)) {
                        moduleIds.push(moduleId);
                    }
                });
                // Prepare data to be sent
                const data = {
                    _token: $('meta[name="csrf-token"]').attr('content'), 
                    role_id          : role_id,
                    role_name        : role_name,
                    
                    user_permission  : permissionIds.join(','), 
                    user_module      : moduleIds.join(','),
                };

                $.ajax({
                    url: "{{ route('role_add_and_edit') }}", 
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.status==200) {
                            
                            showAlertUpdateRole('success','Role Updated Successfully');
                            $('#update-role').modal('hide');
                            location.href = "{{route('user-master')}}";

                        } else {
                            alert('Failed to add user: ' + response.message);
                            showAlertUpdateRole('warning',response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        alert('An error occurred: ' + xhr.responseJSON.message);
                    }
                });
            });


            $('#DeleteRoleBtn').click(function(e) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                alert();
                e.preventDefault(); 

                var userId = $('#delete_role_id').val();

                if (userId) {
                    $.ajax({
                        url: "{{ route('role_remove') }}",  
                        type: 'POST',
                        data: {
                            _token        : csrfToken,
                            role_id       : userId,
                        },
                        success: function(response) {
                            if (response.status==200) {
                                $('#delete_role_id').val();
                                $('#delete_role').modal('hide');
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
        function edit_role(role_id) {
      
            // window.location.href = `/edit-role/${userId}`;
            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
            });

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('role-details') }}",  
                type: 'POST',
                data: {
                    _token        : csrfToken,
                    role_id     : role_id,
                },
                success: function(response) {
                    // Handle success
                   
                    if (response.status==200) {
                       
                        var role_permission_ids = response.data.role_permission_ids;
                        console.log("role_permission_ids",role_permission_ids);
                        if (role_permission_ids != null){
                            const permissionArray   = role_permission_ids.split(',');
                            document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                                const permissionId = checkbox.id.replace('role_permission_', ''); 
                                if (permissionArray.includes(permissionId)) {
                                    checkbox.checked = true;
                                }
                            });
                        }
                        $('#edit_role_id').val(role_id);
                        $('#edit_role_name').val(response.data.role_name);
                        $('#update-role').modal('show');
                    } else {
                        alert('Error fetching branch: ' + response.message);
                        showAlertUpdateRole('warning',response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                    showAlertUpdateRole('warning',error);
                }
            });

        }

        function delete_role(order_id){
            $('#delete_role_id').val(order_id);
            $('#delete_role').modal('show');      
        }
            
         
        
       
        function editUser(userId) {
            alert(userId);
            // Redirect to the edit page and pass the user ID
            window.location.href = `/edit-user/${userId}`;
        }

        function delete_user(order_id){
            $('#delete_user_id').val(order_id);
            $('#delete_user').modal('show');
    
        }


        function showAlert(type, message) {
            const alertContainer = document.getElementById('role-container');
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


        function showAlertUpdateRole(type, message) {
            const alertContainer = document.getElementById('update-role-container');
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

        function showAlertSaveRole(type, message) {
            const alertContainer = document.getElementById('save-role-container');
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