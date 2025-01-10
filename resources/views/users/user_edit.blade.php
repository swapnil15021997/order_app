@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- <h2 class="page-title">
                    New Users
                    </h2> -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('user-master')}}">Users & Permission</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
        <div id="alert-site"></div>

        <div class="card">
            <div class="card-body">
            <div class="row row-cards">
                <div class="" id="alert-container"></div>
                <div class="col-lg-6">
                    <div class="mb-3">

                        <label class="form-label">User Name</label>
                        <input type="hidden" name="" id="user_id" value="{{$user['id']}}">
                        <input type="text" id="user_name" value="{{$user['user_name']}}" class="form-control" placeholder="User Name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">User Role {{$user['user_role_id']}}</label>
                        <select id="select_role" class="form-select">
                            @if(!empty($user['user_role_id']))
                            @foreach ($roles as $role)
                                <option value="{{ $role['role_id'] }}"
                                @if($role['role_id'] == $user['user_role_id']) selected @endif
                                >{{ $role['role_name'] }}</option>
                            @endforeach
                            @endif
                        </select>
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
            <div class="col-lg-12">
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
                                @if (in_array($b['branch_id'], array_column($edit_user_branch, 'branch_id'))) selected @endif
                                >{{ $b['branch_name'] }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
            </div>

            <div class="row row-cards">

                <div class="col-lg-12">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Modules and Permissions</h3>
                            </div>
                            <div class="card-body custom-table-resposive overflow-x-auto">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Module Name</th>
                                            <th>Read</th>
                                            <th>Write</th>
                                            <th>Create</th>
                                            <th>Update</th>
                                            <th>Order Transfer</th>
                                            <th>Order Approve</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($modules as $module)
                                        <tr>
                                            @php
                                                $user_permission_ids = explode(',', $user->user_permission_id);
                                            @endphp
                                            <td>{{ $module['module_name'] }}</td>
                                            @foreach (['read', 'update', 'create', 'delete', 'order transfer', 'order approve'] as $permission_name)
                                            @php
                                                $permission = collect($module['permissions'])->firstWhere('permission_name', $permission_name);
                                            @endphp
                                            @if ($permission)
                                                <td>
                                                    <input
                                                        type="checkbox"
                                                        id="permission_{{ $permission['permission_id'] }}"
                                                        name="permission_{{ $permission['permission_id'] }}"
                                                        name="permission_{{ $permission['permission_id'] }}"
                                                        data-module-id="{{ $module['module_id'] }}"
                                                        @if (in_array($permission, array_column($module['permissions'], 'permission_name')))  @endif
                                                        @if (in_array($permission['permission_id'], $user_permission_ids))
                                                            checked
                                                        @endif
                                                    >
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
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
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <a href="#" onclick="cancel_update()" class="btn btn-secondary ms-auto me-2">
                                
                                Cancel
                            </a>
                        <a href="#" class="btn btn-primary"  id="saveUser">
                            
                            Update User
                        </a>
                    </div>
                </div>

            </div>
            </div>
        </div>
        </div>
    <div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js')}}?1692870487" defer></script>

    <script>
        function cancel_update(){
            location.href = "{{route('user-master')}}"
        }
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

            // let preSelectedRoleId = $('#select_role').val();
            // console.log(preSelectedRoleId);
            // fetchRoleDetails(preSelectedRoleId);

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
                    const selected_sites = $('#select-states').val();

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
                        user_email       : user_email,
                        user_branch      :selected_sites


                    };

                    $.ajax({
                        url: "{{ route('user_add_edit') }}",
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.status==200) {
                                alert('User updated successfully');
                                location.href = "{{route('user-master')}}";
                                showAlertUser('success',response.message);

                            } else {
                                alert('Failed to add user: ' + response.message);
                                showAlertUser('warning',response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle error
                            alert('An error occurred: ' + xhr.responseJSON.message);
                            showAlertUser('warning',error);
                        }
                    });
                });
            });

            function showAlertUser(type, message) {
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
