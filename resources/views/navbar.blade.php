<header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="{{ asset('static/logo.svg')}}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
           
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <div class="d-none d-xl-block ps-2">
                  <div>{{$login['name']}}</div>
                  <div class="mt-1 small text-secondary"></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <!-- <a href="{{route('profile.edit')}}" class="dropdown-item">Profile</a> -->
                <a href="{{route('settings')}}" class="dropdown-item">Settings</a>
                <a href="" onclick="logout()" class="dropdown-item">Logout</a>
                
              </div>
            </div>
            <div class="ps-2 nav-item dropdown">
              <button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split"></button>
              <div class="dropdown-menu dropdown-menu-end">
              @foreach($user_branch as $branch)
                <a 
                  class="dropdown-item  @if($branch['branch_id'] == $login['user_active_branch']) active @endif" 
                  href="#" 
                  onclick="changeBranch('{{ $branch['branch_id'] }}')">
                  {{ $branch['branch_name'] }}
                </a>
              @endforeach
              <div>
            </div>
          </div>
        </div>
      </header>
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item {{ $activePage === 'dashboard' ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('dashboard')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ $activePage === 'branch' ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('branch-master')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Branch
                    </span>
                  </a>
                
                </li>
                <li class="nav-item {{ $activePage === 'orders' ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('order-master')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l3 3l8 -8" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Orders
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ $activePage === 'users' ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('user-master')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg> -->
                      <svg width="24" height="24"><path d="M12 24a12 12 0 1 1 0-24 12 12 0 0 1 0 24Zm-8.7-5.3a11 11 0 0 0 17.4 0C19.4 16.3 14.6 15 12 15c-2.6 0-7.4 1.3-8.7 3.7ZM12 13c2.2 0 4-2 4-4.5S14.2 4 12 4 8 6 8 8.5 9.8 13 12 13Z" fill-rule="nonzero"/></svg>
                    </span>
                    <span class="nav-link-title">
                      Users
                    </span>
                  </a>
                </li>
                <li class="nav-item {{ $activePage === 'roles' ? 'active' : '' }}">
                  <a class="nav-link" href="{{route('role-master')}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg> -->
                      <svg width="24" height="24"><path d="M12 24a12 12 0 1 1 0-24 12 12 0 0 1 0 24Zm-8.7-5.3a11 11 0 0 0 17.4 0C19.4 16.3 14.6 15 12 15c-2.6 0-7.4 1.3-8.7 3.7ZM12 13c2.2 0 4-2 4-4.5S14.2 4 12 4 8 6 8 8.5 9.8 13 12 13Z" fill-rule="nonzero"/></svg>
                    </span>
                    <span class="nav-link-title">
                      Roles
                    </span>
                  </a>
                </li>
              </ul>
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                <form action="./" method="get" autocomplete="off" novalidate>
                  <div class="input-icon">
                    <!-- <span class="input-icon-addon">

                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                    </span>
                    <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website"> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        function logout(){
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
            url: "{{ route('logout') }}",  
            type: 'POST',
            data: {
                _token        : csrfToken,
              
            },
            success: function(response) {
              if(response.success){
                location.href = "{{ route('login') }}";
              }
            }
          })  
        }

        function changeBranch(branch_id){
          var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $.ajax({
              url: "{{ route('branch-active') }}",  // Adjust the route as needed
              type: 'POST',
              data: {
                  _token        : csrfToken,
                  branch_id     : branch_id,
              },
              success: function(response) {
                  // Handle success

                  if (response.status==200) {
                     
                      // alert(response.message);
                      showAlert('success', response.message);

                  } else {
                      // alert('Error creating branch: ' + response.message);
                      showAlert('warning', response.message);
                  }
              },
              error: function(xhr, status, error) {
                  // alert('An error occurred: ' + error);
                  showAlert('warning', error);
              }
          });
        }

         
        function showAlert(type, message) {
            const alertContainer = document.getElementById('alert-site');
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