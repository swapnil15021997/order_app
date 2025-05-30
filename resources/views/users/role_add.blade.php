@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                <!-- <h2 class="page-title">
                    New Role
                    </h2> -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{route('role-master')}}">Role</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role Add</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-lg-6">

                    <div class="mb-3">

                        <label class="form-label">Role Name</label>
                        <input type="text" id="user_name" class="form-control" placeholder="User Name">
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
                            <div class="card-body ">
                                <table class="table table-bordered table-responsive ">
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
                            Save Role
                        </a>
                    </div>
                </div>

            </div>
        </div>
    <div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>




        // Code for user add

        $(document).ready(function () {
            $('#saveUser').on('click', function (e) {

                e.preventDefault();
                const userName = $('#user_name').val();

                // Validate data
                if (!userName ) {
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
                            location.href = "{{route('role-master')}}";
                        } else {
                            alert('Failed to add user: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        alert('An error occurred: ' + xhr.responseJSON.message);
                    }
                });
            });
        });

    </script>

    @endsection
