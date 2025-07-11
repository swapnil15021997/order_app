<footer class="mt-4 hidden fixed-footer">
    {{-- <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ $activePage === 'dashboard' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <span
                                    class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>
                        @if (in_array(5, $user_permissions))
                        <li class="nav-item {{ $activePage === 'orders' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('order-master') }}">
                                <span
                                    class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-receipt" viewBox="0 0 16 16">
                                        <path
                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                                        <path
                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Orders
                                </span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">


            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('static/sonic-large.svg') }}" width="110" height="35" alt="Tabler"
                        class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-md-none d-flex align-items-center ps-3">
                    <button class="btn btn-ghost-primary btn-icon" id="start-scann" style="max-height:40px;">
                        <svg fill="currentColor" version="1.1" id="Capa_1" width="24" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" xml:space="preserve">
                            <g>
                                <rect x="38" y="23" width="2" height="5" />
                                <rect x="42" y="23" width="2" height="5" />
                                <rect x="38" y="30" width="2" height="2" />
                                <rect x="42" y="30" width="2" height="2" />
                                <rect x="31" y="34" width="2" height="2" />
                                <rect x="26" y="54" width="2" height="2" />
                                <rect x="42" y="34" width="2" height="2" />
                                <rect x="38" y="38" width="2" height="2" />
                                <rect x="42" y="38" width="2" height="2" />
                                <path d="M2,2h3V0H1C0.448,0,0,0.448,0,1v4h2V2z" />
                                <path d="M63,0h-4v2h3v3h2V1C64,0.448,63.552,0,63,0z" />
                                <path d="M2,59H0v4c0,0.552,0.448,1,1,1h4v-2H2V59z" />
                                <path d="M62,62h-3v2h4c0.552,0,1-0.448,1-1v-4h-2V62z" />
                                <path
                                    d="M4,5v12c0,0.552,0.448,1,1,1h12c0.552,0,1-0.448,1-1V5c0-0.552-0.448-1-1-1H5C4.448,4,4,4.448,4,5z M6,6h10v10H6V6z" />
                                <path
                                    d="M13,8H9C8.448,8,8,8.448,8,9v4c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V9C14,8.448,13.552,8,13,8z M12,12h-2v-2h2V12z" />
                                <path
                                    d="M47,18h12c0.552,0,1-0.448,1-1V5c0-0.552-0.448-1-1-1H47c-0.552,0-1,0.448-1,1v12C46,17.552,46.448,18,47,18z M48,6h10v10H48V6z" />
                                <path
                                    d="M55,8h-4c-0.552,0-1,0.448-1,1v4c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V9C56,8.448,55.552,8,55,8z M54,12h-2v-2h2V12z" />
                                <path
                                    d="M17,46H5c-0.552,0-1,0.448-1,1v12c0,0.552,0.448,1,1,1h12c0.552,0,1-0.448,1-1V47C18,46.448,17.552,46,17,46z M16,58H6V48h10V58z" />
                                <path
                                    d="M9,56h4c0.552,0,1-0.448,1-1v-4c0-0.552-0.448-1-1-1H9c-0.552,0-1,0.448-1,1v4C8,55.552,8.448,56,9,56z M10,52h2v2h-2V52z" />
                                <path d="M44,19h-7V7h-2v13c0,0.552,0.448,1,1,1h8V19z" />
                                <rect x="22" y="12" width="7" height="2" />
                                <rect x="26" y="8" width="7" height="2" />
                                <rect x="4" y="19" width="2" height="9" />
                                <path d="M18,25H8v2h9v4h2v-5C19,25.448,18.552,25,18,25z" />
                                <rect x="9" y="20" width="2" height="2" />
                                <rect x="21" y="18" width="2" height="8" />
                                <rect x="21" y="28" width="9" height="2" />
                                <path d="M61,29h-2v10h-3v2h4c0.552,0,1-0.448,1-1V29z" />
                                <rect x="26" y="18" width="2" height="2" />
                                <rect x="4" y="33" width="2" height="8" />
                                <rect x="4" y="42" width="9" height="2" />
                                <path d="M50,28h2v-4c0-0.552-0.448-1-1-1h-5v2h4V28z" />
                                <rect x="9" y="33" width="2" height="2" />
                                <rect x="20" y="32" width="2" height="8" />
                                <rect x="20" y="42" width="9" height="2" />
                                <rect x="8" y="38" width="9" height="2" />
                                <rect x="21" y="52" width="2" height="4" />
                                <rect x="20" y="48" width="9" height="2" />
                                <path d="M36,44v-5c0-0.552-0.448-1-1-1H25v2h9v4H36z" />
                                <rect x="26" y="32" width="2" height="2" />
                                <rect x="15" y="34" width="2" height="2" />
                                <rect x="59" y="53" width="2" height="7" />
                                <rect x="54" y="58" width="3" height="2" />
                                <rect x="54" y="52" width="2" height="4" />
                                <path d="M61,44c0-0.552-0.448-1-1-1H49v2h10v6h2V44z" />
                                <path d="M48,56v-5c0-0.552-0.448-1-1-1H36v2h10v4H48z" />
                                <rect x="50" y="47" width="7" height="2" />
                                <rect x="20" y="58" width="7" height="2" />
                                <rect x="30" y="51" width="2" height="9" />
                                <rect x="32" y="46" width="4" height="2" />
                                <path d="M47,36h5v-2h-4v-6h-2v7C46,35.552,46.448,36,47,36z" />
                                <rect x="50" y="30" width="5" height="2" />
                                <rect x="54" y="20" width="3" height="2" />
                                <rect x="59" y="20" width="2" height="5" />
                                <rect x="54" y="25" width="2" height="2" />
                                <path d="M39,17h4c0.552,0,1-0.448,1-1V3h-2v12h-3V17z" />
                                <path d="M24,5h15V3H23c-0.552,0-1,0.448-1,1v5h2V5z" />
                                <path d="M25,24h7c0.552,0,1-0.448,1-1v-8h-2v7h-6V24z" />
                                <rect x="34" y="23" width="2" height="4" />
                                <rect x="36" y="54" width="7" height="2" />
                                <rect x="36" y="58" width="9" height="2" />
                                <path d="M50,58h-2v2h3c0.552,0,1-0.448,1-1v-8h-2V58z" />
                                <rect x="16" y="42" width="2" height="2" />
                                <rect x="39" y="42" width="4" height="2" />
                                <rect x="46" y="38" width="2" height="3" />
                                <rect x="45" y="43" width="2" height="2" />
                                <rect x="39" y="46" width="3" height="2" />
                                <rect x="50" y="38" width="2" height="2" />
                                <rect x="54" y="34" width="3" height="2" />
                                <rect x="35" y="34" width="5" height="2" />
                                <rect x="34" y="29" width="2" height="3" />
                            </g>
                        </svg>
                    </button>
                </div>
                <!-- <div class="nav-item dropdown dropup ps-3">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">

                        <a href="{{ route('settings') }}" class="dropdown-item">Account & Settings</a>
                        <a href="" onclick="logout()" class="dropdown-item">Logout</a>

                    </div>
                </div> -->
                <!-- <div class="ps-3 nav-item dropdown dropup">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle no-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-building" viewBox="0 0 16 16">
                            <path
                                d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                            <path
                                d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                        </svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach ($user_branch as $branch)
                            <a class="dropdown-item  @if ($branch['branch_id'] == $login['user_active_branch']) active @endif"
                                href="#" onclick="changeBranch('{{ $branch['branch_id'] }}')">
                                {{ $branch['branch_name'] }}
                            </a>
                        @endforeach
                        <div>
                        </div>
                    </div>
                </div> -->
                <!-- <div>

                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                        aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
                </div> -->
                <div class="ps-3 nav-item dropdown dropup ">
                    <a href="#" data-bs-toggle="dropdown" class="navbar-toggler">
                        <span class="navbar-toggler-icon"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </a>
                        @if (in_array(5, $user_permissions))
                            <a class="dropdown-item" href="{{ route('order-master') }}">
                                <span
                                    class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="icon" viewBox="0 0 16 16">
                                        <path
                                            d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                                        <path
                                            d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Orders
                                </span>
                            </a>
                        @endif

                        <a class="dropdown-item" href="{{route('transfer-master')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-receipt-text">
                                <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                                <path d="M14 8H8" />
                                <path d="M16 12H8" />
                                <path d="M13 16H8" />
                            </svg>
                            <span class="nav-link-title">
                                Transfer Receipt
                            </span>
                        </a>
                        <a class="dropdown-item" href="{{route('activity-master')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-activity">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                            </svg>
                            <span class="nav-link-title">
                                Activity Log
                            </span>
                        </a>
                        <div class="dropdown-item">
                            <div class="nav-item  w-100 dropstart">
                                <a href="#" class="nav-link dropdown-toggle justify-content-start w-100 no-arrow" id="branch-dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/>
                                        </svg>
                                     
                                        Branches
                                </a>

                                <div class="dropdown-menu" id="branch-dropdown-menu" style="top:auto;">
                                    @foreach ($user_branch as $branch)
                                        <a class="dropdown-item @if ($branch['branch_id'] == $login['user_active_branch']) active @endif"
                                            href="#" onclick="changeBranch('{{ $branch['branch_id'] }}')">
                                            {{ $branch['branch_name'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{route('settings')}}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                                    <path
                                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Accounts & Settings
                            </span>
                        </a>
                        <a class="dropdown-item" href="#" onclick="click_logout()">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Logout
                            </span>
                        </a>
                    </div>
                </div>
            </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.2/qr-scanner.umd.min.js"></script> -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

<style>
    @media (max-width:768px) {
        .page-body {
            margin-bottom: 5rem !important;
            margin-top: 1rem !important;
        }
    }
</style>
<script>
    document.addEventListener('click', function (event) {
        var parentDropdown = document.querySelector('.dropdown');
        var childDropdown = document.querySelector('#branch-dropdown-menu');

        if (!parentDropdown.contains(event.target) && !childDropdown.contains(event.target)) {
            var dropdownInstance = new bootstrap.Dropdown(parentDropdown);
            dropdownInstance.hide();
        }
    });

    document.querySelector('#branch-dropdown-toggle').addEventListener('click', function (event) {
        event.stopPropagation();
    });

    function domReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1000);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    function toogleNoteSheet() {
        var element = document.getElementById("note_sheet");
        element.classList.toggle("active");
    }

    let qrScanner = null;
    let html5QrCode = null;
    domReady(function () {

        const videoElem = document.getElementById("videoElem");
        const startButton = document.getElementById("start-scann");
        const my_orders = document.getElementById("my_orders");
        const close_qr_code = document.getElementById("close_qr_code");
           

        function startScanner() {
            // Show the video element

            document.getElementById("my-qr-reader").style.display = "block";

            // Initialize QR scanner if not already created
            if (!qrScanner) {
                qrScanner = new QrScanner(
                    videoElem,
                    onScanSuccess, {
                    highlightScanRegion: true,
                    highlightCodeOutline: true,
                }
                );
            }

            // Start scanning
            qrScanner.start().then(() => {
                console.log("QR Scanner started successfully");
                // create_order_array(9,1748973467, 0, 3577306849,6/34/3432)
                // // create_order_array(1748973467); 
                // create_order_array(9332728860);
                // create_order_array(2810638022);

            })
                .catch((err) => {
                    console.error("Error starting QR scanner:", err);
                    stopScanner();
                    alert("An error occurred while starting the QR scanner. Please try again." + err);
                });

        }

        function onScanSuccess(result) {

            const scannedText = result.data || result;
             
            // const [order_id, orderQrCode, orderStatus, orderNumber, orderDate] = scannedText.split('|');
            // create_order_array(order_id, orderQrCode, orderStatus, orderNumber, orderDate);
            const [order_id] = scannedText.split('|');
            create_order_array(order_id);
        }

        function stopScanner() {
            console.log("Stopping here");
            if (qrScanner) {
                qrScanner.stop();
                qrScanner.destroy();
            }
            qrScanner = null;
            document.getElementById("my-qr-reader").style.display = "none";
        }

        startButton.addEventListener("click", function () {

            startScanner();


        });
        close_qr_code.addEventListener("click", function () {
                    stopScanner();
            });


    });

    function stopScanner() {
        console.log("Stopping there");
        if (qrScanner) {
            qrScanner.stop();
        }
        document.getElementById("my-qr-reader").style.display = "none";
        // startButton.textContent = "Start Scanner";
    }







    domReady(function () {
        // Get DOM elements
        // const videoElem = document.getElementById("videoElem");
        // const startButton = document.getElementById("start-scann");

        // let qrScanner = null;

        // function onScanSuccess(result) {
        //     // Display the result
        //     const scannedText = result.data || result;
        //     alert(scannedText);
        //     // If the result is a URL, open it in a new tab
        //     if (scannedText.startsWith('http')) {
        //         window.open(scannedText, '_blank');
        //     }

        //     // Stop scanning
        //     stopScanner();
        // }

        // function startScanner() {
        //     console.log('Starting');
        //     // Show the video element
        //     document.getElementById("my-qr-reader").style.display = "block";
        //     startButton.textContent = "Stop Scanner";

        //     // Initialize QR scanner if not already created
        //     if (!qrScanner) {
        //         qrScanner = new QrScanner(
        //             videoElem,
        //             onScanSuccess,
        //             {
        //                 highlightScanRegion: true,
        //                 highlightCodeOutline: true,
        //             }
        //         );
        //     }

        //     // Start scanning
        //     qrScanner.start();
        // }

        // function stopScanner() {
        //     if (qrScanner) {
        //         qrScanner.stop();
        //     }
        //     document.getElementById("my-qr-reader").style.display = "none";
        //     startButton.textContent = "Start Scanner";
        // }


        // document.getElementById("close_qr_code").addEventListener("click", function () {
        //     stopScanner();
        // });


        // // Toggle scanner on button click
        // startButton.addEventListener("click", function () {
        //     if (qrScanner && qrScanner.isScanning()) {
        //         stopScanner();
        //     } else {
        //         startScanner();
        //     }
        // });

        // Handle errors
        // window.addEventListener('error', function(e) {
        //     resultDiv.innerHTML = `<p style="color: red;">Error: ${e.message}</p>`;
        // });
    });
</script>
<script>
    function logout() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('logout') }}",
            type: 'POST',
            data: {
                _token: csrfToken,

            },
            success: function (response) {
                if (response.status == 200) {
                    console.log(response);
                    location.href = "{{ route('login') }}";
                }
            }
        })
    }

    function changeBranch(branch_id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('branch-active') }}", // Adjust the route as needed
            type: 'POST',
            data: {
                _token: csrfToken,
                branch_id: branch_id,
            },
            success: function (response) {
                // Handle success

                if (response.status == 200) {

                    // alert(response.message);
                    showAlert('success', response.message);
                    location.reload();

                } else {
                    // alert('Error creating branch: ' + response.message);
                    showAlert('warning', response.message);
                }
            },
            error: function (xhr, status, error) {
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
