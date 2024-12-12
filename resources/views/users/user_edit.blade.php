@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    New Users
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="" id="alert-container"></div>
                <div class="col-lg-6">
                
                    <div class="mb-3">
                      
                        <label class="form-label">User Name</label>
                        <input type="hidden" name="" id="user_id" value="{{$user['id']}}">
                        <input type="text" id="user_name" value="{{$user['user_name']}}" class="form-control" placeholder="User Name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" id="user_phone_no" value="{{$user['user_phone_number']}}" class="form-control" placeholder="User Phone Number">
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">User Role</label>
                        <select id="select_role" class="form-select">
                            @foreach ($roles as $role)
                                <option value="{{ $role['role_id'] }}"
                                @if($role['role_id'] == $user['user_role_id']) selected @endif
                                >{{ $role['role_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">User Address</label>
                        <textarea id="user_address" name="user_address" class="form-control" rows="3">{{$user['user_address']}}</textarea>

                    </div>
                </div>
            </div>  

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">User Email</label>
                        <input type="email" id="user_email" value="{{$user['email']}}" class="form-control" required="true">

                    </div>
                </div>
                <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="form-label">Select multiple states</div>
                            <select type="text" class="form-select" id="select-states" multiple>
                            @if(!empty($branch))
                            
                            @foreach($branch as $b)
                                <option value="{{ $b['branch_id'] }}"
                                @if (in_array($b['branch_id'], array_column($user_branch, 'branch_id'))) selected @endif
                                >{{ $b['branch_name'] }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
            </div>


            <div class="row">

                <div class="col-lg-12">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Modules and Permissions</h3>
                            </div>
                            <div class="card-body">
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
                                                            id="permission_{{ $permission['permission_id'] }}" 
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
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <a href="#" class="btn btn-primary ms-auto"  id="saveUser">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                            Update User
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js')}}?1692870487" defer></script>
  
    <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function () {
                var el;
                window.TomSelect && (new TomSelect(el = document.getElementById('select-states'), {
                    copyClassesToDropdown: false,
                    dropdownParent: 'body',
                    controlInput: '<input>',
                    render:{
                        item: function(data,escape) {
                            if( data.customProperties ){
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data,escape){
                            if( data.customProperties ){
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                }));
            });
            // @formatter:on
        </script>
    <script>
         function fetchRoleDetails(roleId) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (roleId) {
                    $.ajax({
                        url: "{{ route('role-details') }}", 
                        type: 'POST',
                        data: {
                            'role_id' : roleId
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken 
                        },
                        success: function (response) {
                            console.log(response);
                            if (response.data.role_permission_ids != null){
                                const rolePermissionIds = response.data.role_permission_ids.split(',').map(Number);
                                
                                $('input[type="checkbox"]').prop('checked', false);
                                console.log(rolePermissionIds);
                                rolePermissionIds.forEach(permissionId => {
                                    $(`#permission_${permissionId}`).prop('checked', true);
                                });

                            }
                        },
                        error: function (xhr) {
                            alert(xhr.responseJSON.message || 'An error occurred');
                        }
                    });
                }
            }
 
            let preSelectedRoleId = $('#select_role').val();
            fetchRoleDetails(preSelectedRoleId);
 
            $('#select_role').on('change', function () {
                let roleId = $(this).val();
                fetchRoleDetails(roleId);
                $('input[type="checkbox"]').prop('checked', false);
            });



            $(document).ready(function () {
                $('#saveUser').on('click', function (e) {

                    e.preventDefault();  
                    const userId      = $('#user_id').val();
                    const userName    = $('#user_name').val();
                    const userPhone   = $('#user_phone_no').val();
                    const userAddress = $('#user_address').val();
                    const roleId      = $('#select_role').val();
                    const user_email  = $('#user_email').val();
                   

                    // Validate data
                    if (!userName || !userPhone || !roleId ) {
                        alert('Please fill all fields and select at least one permission.');
                        return;
                    }
                    const permissionIds = [];
                    const moduleIds = [];
                    $('input[type="checkbox"]:checked').each(function () {
                       
                        const permissionId = $(this).attr('id').replace('permission_', '');  // Extract permission_id from id
                        const moduleId = $(this).data('module-id'); 
                        permissionIds.push(permissionId);
                        if (!moduleIds.includes(moduleId)) {
                            moduleIds.push(moduleId);
                        }
                    });
                    // Prepare data to be sent
                    const data = {
                        _token: $('meta[name="csrf-token"]').attr('content'), 
                        user_id          : userId,
                        user_name        : userName,
                        user_phone_number: userPhone,
                        user_address     : userAddress,
                        user_role        : roleId,
                        user_permission  : permissionIds.join(','), 
                        user_module      : moduleIds.join(','),
                        user_email       : user_email 

                    };

                    $.ajax({
                        url: "{{ route('user_add_edit') }}", 
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.status==200) {
                                alert('User updated successfully');
                                location.href = "{{route('user-master')}}";
                                showAlert('success',response.message);

                            } else {
                                alert('Failed to add user: ' + response.message);
                                showAlert('warning',response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle error
                            alert('An error occurred: ' + xhr.responseJSON.message);
                            showAlert('warning',error);
                        }
                    });
                });
            });

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

    </script>
@endsection