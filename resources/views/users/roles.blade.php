@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('role-master')}}">Roles</a>
                    </li>
                </ol>
                <br />
                <h2 class="page-title">
                    Roles
                </h2>
                <div class="text-secondary mt-1" id="pagination_code"></div>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <!-- <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/> -->

                    <a href="{{route('role-add')}}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        New Role
                    </a>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-md-6 col-lg-3">

            </div>
        </div>
        <div class="d-flex mt-4">
            <ul class="pagination ms-auto" id="paginationLinks">

            </ul>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    $(document).ready(function () {
        // Fetch users on page load
        fetchRoles();

        // Search event
        $('input[type="search"]').on('input', function () {
            fetchRoles(1, $(this).val());
        });

        // Pagination event
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            const page = $(this).attr('data-page');
            fetchUsers(page);
        });

        function fetchRoles(page = 1, search = '') {
            const perPage = 5;

            $.ajax({
                url: '{{ route("role-list")}}',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: search,
                    per_page: perPage,
                    page: page,
                },
                success: function (response) {
                    // Update user list
                    let usersHtml = '';
                    response.data.roles.forEach(user => {
                        usersHtml += `
                                <div class="col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body p-4 text-center">
                                            <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(/path/to/user/image)"></span>
                                            <h3 class="m-0 mb-1"><a href="#">${user.role_name}</a></h3>


                                        </div>
                                        <div class="d-flex">
                                            <a href="#" class="card-btn" onclick="editUser(${user.role_id})">Edit</a>
                                            <a href="#" class="card-btn" onclick="delete_user(${user.role_id})">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                    });
                    $('.row-cards').html(usersHtml);

                    // Update pagination
                    let paginationHtml = '';
                    for (let i = 1; i <= response.data.total_pages; i++) {
                        paginationHtml += `
                                <li class="page-item ${response.data.current_page == i ? 'active' : ''}">
                                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                                </li>
                            `;
                    }
                    $('#paginationLinks').html(paginationHtml);
                    const userCountText = `${1} - ${response.data.total} of ${response.data.total_pages}`;
                    $('#pagination_code').text(userCountText);

                },
            });
        }

        $('#DeleteUserBtn').click(function (e) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            alert();
            e.preventDefault();

            var userId = $('#delete_user_id').val();
            if (userId) {
                $.ajax({
                    url: "{{ route('user_remove') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        user_id: userId,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('#delete_user_id').val();
                            $('#delete_user').modal('hide');
                            location.reload();
                            alert(response.message);
                        } else {
                            alert('Error deleting order: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
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
        window.location.href = `/edit-role/${userId}`;
    }

    function delete_user(order_id) {
        $('#delete_user_id').val(order_id);
        $('#delete_user').modal('show');

    }

</script>
@endsection
