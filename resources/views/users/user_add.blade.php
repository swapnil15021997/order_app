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
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{route('user-master')}}">Users & Permissions</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user-master')}}">User Add</a></li>
                            </ol>
                        </nav>
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
                            <input type="text" id="user_name" class="form-control" placeholder="User Name">
                        </div>
                    </div>
                </div>

                <div class="row row-cards">
                <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" id="user_phone_no" class="form-control" placeholder="User Phone Number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">User Role</label>
                            <select id="select_role" class="form-select">
                                @foreach ($roles as $role)
                                    <option value="{{ $role['role_id'] }}">{{ $role['role_name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="row row-cards">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">User Email</label>
                            <input type="email" id="user_email" class="form-control" required="true">

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                                <div class="form-label">Select multiple states</div>
                                <select type="text" class="form-select" id="select-states" multiple>
                                @if(!empty($branch))

                                @foreach($branch as $b)
                                    <option value="{{ $b['branch_id'] }}">{{ $b['branch_name'] }}</option>
                                    @endforeach
                                @endif
                                </select>
                        </div>
                    </div>
                </div>

                <div class="row row-cards">
                <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">User Address</label>
                            <textarea id="user_address" name="user_address" class="form-control" rows="3"></textarea>

                        </div>
                    </div>
                </div>


                <div class="row row-cards custom-table-resposive overflow-x-auto">

                    <div class="col-lg-12">
                        <div class="mb-3">

                            <h3 class="card-title">Modules and Permissions</h3>

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
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-end">
                            <a href="#" onclick="cancel_save()" class="btn btn-secondary ms-auto me-2">
                                
                                Cancel
                            </a>
                            <a href="#" class="btn btn-primary"  id="saveUser">
                                
                                Save User
                            </a>
                        </div>
                    </div>

                </div>
                </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <script src="{{ asset('libs/tom-select/dist/js/tom-select.base.min.js')}}?1692870487" defer></script> -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

        <script>
            function cancel_save(){
                location.href = "{{route('user-master')}}"
            }
            // @formatter:off
            // document.addEventListener("DOMContentLoaded", function () {
            //     var el;
            //     window.TomSelect && (new TomSelect(el = document.getElementById('select-states'), {
            //         copyClassesToDropdown: false,
            //         dropdownParent: 'body',
                    
            //         controlInput: '<input>',
            //         render:{
            //             item: function(data,escape) {
            //                 if( data.customProperties ){
            //                     return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
            //                 }
            //                 return '<div>' + escape(data.text) + '</div>';
            //             },
            //             option: function(data,escape){
            //                 if( data.customProperties ){
            //                     return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
            //                 }
            //                 return '<div>' + escape(data.text) + '</div>';
            //             },
            //         },
            //     }));

                
            // });
            // @formatter:on

            // Tom select working code.
            document.addEventListener("DOMContentLoaded", function () {
            var el;
            const selectInstance = new TomSelect(el = document.getElementById('select-states'), {
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                controlInput: '<input>',
                
                plugins: ['remove_button'],
                
                onDelete: function(values) {

                    values.forEach(value => {
                        // selectInstance.removeItem(value);
                        
                        const optionToRemove = el.querySelector(`option[value="${value}"]`);
                        if (optionToRemove) {
                            optionToRemove.remove();
                        }
                    });
                    return values;
                },
                
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            });
            
            // Add click handler for selected items
            // selectInstance.control.addEventListener('click', function (event) {
            //     const clickedElement = event.target.closest('.item');
            //     if (clickedElement) {
            //         const value = clickedElement.dataset.value;
            //         if (value) {
            //             selectInstance.removeItem(value);

            //             const optionToRemove = el.querySelector(`option[value="${value}"]`);
            //             if (optionToRemove) {
            //                 optionToRemove.remove();
            //             }
            //         }
            //     }
            // });
        });
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



            // Code for user add

            $(document).ready(function () {
                $('#saveUser').on('click', function (e) {

                    e.preventDefault();
                    const userName = $('#user_name').val();
                    const userPhone = $('#user_phone_no').val();
                    const userAddress = $('#user_address').val();
                    const roleId = $('#select_role').val();
                    const user_email = $('#user_email').val();
                    const selected_sites = $('#select-states').val();
                   
                    // Validate data
                    if (!userName || !userPhone || !roleId ) {
                        showAlertUser('warning', 'Please fill all fields and select at least one permission');
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
                        user_name        : userName,
                        user_phone_number: parseInt(userPhone),
                        user_address     : userAddress,
                        user_role        : roleId,
                        user_permission  : permissionIds.join(','),
                        user_module      : moduleIds.join(','),
                        user_email       : user_email ,
                        user_branch      :selected_sites

                    };

                    $.ajax({
                        url: "{{ route('user_add_edit') }}",
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            if (response.status==200) {
                                alert('User added successfully');
                                showAlertUser('success', 'User added successfully');

                                location.href = "{{route('user-master')}}";
                            } else {
                                alert('Failed to add user: ' + response.message);
                                showAlertUser('warning', response.message);

                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle error
                            showAlertUser('warning', error);

                            alert('An error occurred: ' + xhr.responseJSON.message);
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
