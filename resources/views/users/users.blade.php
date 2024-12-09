@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    Users
                    </h2>
                    <div class="text-secondary mt-1">1-18 of 413 people</div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                    <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…"/>
                    <a href="#" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        New user
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

    




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        
        $(document).ready(function () {
            // Fetch users on page load
            fetchUsers();

            // Search event
            $('input[type="search"]').on('input', function () {
                fetchUsers(1, $(this).val());
            });

            // Pagination event
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                const page = $(this).attr('data-page');
                fetchUsers(page);
            });

            function fetchUsers(page = 1, search = '') {
                const perPage = 1; 

                $.ajax({
                    url: '{{ route("user-list")}}', 
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
                        response.data.users.forEach(user => {
                            usersHtml += `
                                <div class="col-md-6 col-lg-3">
                                    <div class="card">
                                        <div class="card-body p-4 text-center">
                                            <span class="avatar avatar-xl mb-3 rounded" style="background-image: url(/path/to/user/image)"></span>
                                            <h3 class="m-0 mb-1"><a href="#">${user.user_name}</a></h3>
                                            <div class="text-secondary">${user.role_name}</div>
                                             
                                        </div>
                                        <div class="d-flex">
                                            <a href="#" class="card-btn">Email</a>
                                            <a href="#" class="card-btn">Call</a>
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
                        $('.text-secondary.mt-1').text(userCountText);

                    },
                });
            }
        });

    </script>
@endsection