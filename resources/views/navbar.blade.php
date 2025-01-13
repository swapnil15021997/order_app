<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{route('dashboard')}}">
                <img src="{{ asset('static/sonic-large.svg')}}" width="110" height="35" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <!-- <div class="d-none d-md-flex">
              <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">

             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">

             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>

            </div> -->
            <div class="nav-item dropdown d-none d-xl-flex me-4">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{$login['name']}}</div>

                        <div class="mt-1 small text-secondary">{{session('role_name', '')}}</div>
                    </div>
                </a>




                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <!-- <a href="{{route('profile.edit')}}" class="dropdown-item">Profile</a> -->
                    <a href="{{route('settings')}}" class="dropdown-item">Settings</a>
                    <a href="" onclick="logout()" class="dropdown-item">Logout</a>

                </div>
            </div>
            <div class="ps-2 nav-item dropdown">
                <div class="btn-list">
                    <a href="#" data-bs-toggle="dropdown" class=" btn  dropdown-toggle no-arrow">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        <span class="me-2">{{ session('active_branch', '') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach($user_branch as $branch)
                            <a class="dropdown-item  @if($branch['branch_id'] == $login['user_active_branch']) active @endif"
                                href="#" onclick="changeBranch('{{ $branch['branch_id'] }}')">
                                {{ $branch['branch_name'] }}
                            </a>
                        @endforeach
                    <div>
                        </div>
                    </div>
                </div>
            </div>
</header>
<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item {{ $activePage === 'dashboard' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block">
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
                    </li> -->
                    @if(in_array(1, $user_permissions))
                        <!-- <li class="nav-item {{ $activePage === 'branch' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('branch-master')}}">
                                <span
                                    class="nav-link-icon d-md-none d-lg-inline-block">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-buildings" viewBox="0 0 16 16">
                                        <path
                                            d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                                        <path
                                            d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Branch
                                </span>
                            </a>

                        </li> -->
                    @endif
                    @if(in_array(5, $user_permissions))

                        <li class="nav-item {{ $activePage === 'orders' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('order-master')}}">
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
                    @if(in_array(9, $user_permissions))

                        <!-- <li class="nav-item {{ $activePage === 'users' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('user-master')}}">
                                <span
                                    class="nav-link-icon d-md-none d-lg-inline-block">

                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-people" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Users & Roles
                                </span>
                            </a>
                        </li> -->
                    @endif


                </ul>
                <div class="my-2 btn-list my-md-0 flex-grow-1 flex-md-grow-0 d-md-flex d-none">
                    <button class="btn" id="start-scan">
                        <span class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
                                <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
                                <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
                                <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
                                <path d="M12 9h2V8h-2z"/>
                            </svg>
                        </span>
                        Scan</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="" id="transfer_order_id">

    <div class="modal modal-blur fade" id="transfer_order" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Transfer Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label class="form-label">Order To</label>
                    <div class="row">
                        <div class="col-6 select-full">
                            <select id="TransfersearchableSelectTo" class="form-select select-2  w-100 " type="text">
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a id="TransferOrderBtn" onclick="transfer_this()" href="#" class="btn btn-primary">
                        Transfer This Order
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.2/qr-scanner.umd.min.js"></script>
    <style>
        @media (max-width:768px) {
            .page-body {
                margin-bottom: 0 !important;
                margin-top: 1rem !important;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
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

        domReady(function () {
            // Get DOM elements
            const videoElem = document.getElementById("videoElem");
            const startButton = document.getElementById("start-scan");
            const resultDiv = document.getElementById("result");
            let qrScanner = null;

            function onScanSuccess(result) {
                // Display the result
                const scannedText = result.data || result;
                // If the result is a URL, open it in a new tab
                if (scannedText.startsWith('http')) {
                    window.open(scannedText, '_blank');
                    
                }

                // Stop scanning
                stopScanner();
            }

            function startScanner() {
                // Show the video element
                
                // create_order_array(1,'orderQrCode', 1, 2463257358,2020-2-12);
                
                document.getElementById("my-qr-reader").style.display = "block";
                startButton.textContent = "Stop Scanner";

                // Initialize QR scanner if not already created
                if (!qrScanner) {
                    qrScanner = new QrScanner(
                        videoElem,
                        onScanSuccess,
                        {
                            highlightScanRegion: true,
                            highlightCodeOutline: true,
                        }
                    );
                }

                // Start scanning
                qrScanner.start();
            }

            function stopScanner() {
                if (qrScanner) {
                    qrScanner.stop();
                }
                document.getElementById("my-qr-reader").style.display = "none";
                startButton.textContent = "Start Scanner";
            }

            // Toggle scanner on button click
            startButton.addEventListener("click", function () {
                if (qrScanner && qrScanner.isScanning()) {
                    stopScanner();
                } else {
                    startScanner();
                }
            });

            // Handle errors
            // window.addEventListener('error', function(e) {
            //     resultDiv.innerHTML = `<p style="color: red;">Error: ${e.message}</p>`;
            // });
        });




        domReady(function () {
            // Get DOM elements
            const videoElem   = document.getElementById("videoElem");
            const startButton = document.getElementById("start-scan");
            const resultDiv   = document.getElementById("result");
            const my_orders   = document.getElementById("my_orders");
            let qrScanner = null;

            function onScanSuccess(result) {
                // Display the result
                const scannedText = result.data || result;
                // If the result is a URL, open it in a new tab
                // if (scannedText.startsWith('http')) {
                //     window.open(scannedText, '_blank');
                    
                // }

                const [order_id,orderQrCode, orderStatus, orderNumber, orderDate] = scannedText.split('|');
                create_order_array(order_id,orderQrCode, orderStatus, orderNumber,orderDate);
                // Stop scanning
                stopScanner();
            }

            function startScanner() {
                // Show the video element

                document.getElementById("my-qr-reader").style.display = "block";
                startButton.textContent = "Stop Scanner";

                // Initialize QR scanner if not already created
                if (!qrScanner) {
                    qrScanner = new QrScanner(
                        videoElem,
                        onScanSuccess,
                        {
                            highlightScanRegion: true,
                            highlightCodeOutline: true,
                        }
                    );
                }

                // Start scanning
                qrScanner.start();
            }

            function stopScanner() {
                if (qrScanner) {
                    qrScanner.stop();
                }
                document.getElementById("my-qr-reader").style.display = "none";
                startButton.textContent = "Start Scanner";
            }

            // Toggle scanner on button click
            startButton.addEventListener("click", function () {
                if (qrScanner && qrScanner.isScanning()) {
                    stopScanner();
                } else {
                    startScanner();
                }
            });

           

            // Handle errors
            // window.addEventListener('error', function(e) {
            //     resultDiv.innerHTML = `<p style="color: red;">Error: ${e.message}</p>`;
            // });
        });

        let approve_array  = [];
        let transfer_array = [];
        function create_order_array(order_id,orderQrCode, orderStatus, orderNumber,orderDate){
            const my_orders   = document.getElementById("my_orders");
            
            let my_ord;
            let buttonHtml = '';
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('order_details') }}",  // Adjust the route as needed
                type: 'POST',
                data: {
                    _token: csrfToken,

                    order_id: order_id,
                },
                success: function (response) {
                    console.log(response);
                        
                    if (response.data.transactions && response.data.transactions.length > 0) {

                        let lastTransaction = response.data.transactions[response.data.transactions.length - 1];
                        

                        let isAnyOrderApproved = approve_array.length > 0;
                        let isAnyOrderTransferred = transfer_array.length > 0;  
                        
                        if (lastTransaction.trans_status === 1 && isAnyOrderApproved) {
                            alert("Previous order was transferred, and the current order is approved. Please handle accordingly.");
                        }
                        if (lastTransaction.trans_status === 0 && isAnyOrderTransferred) { alert
                            alert("Previous order was aprove, and the current order is of transfer. Please handle accordingly.");
                        }

                        if (lastTransaction.trans_status === 0) {
                            // Add to approve_array
                            approve_array.push(order_id);

                            my_ord = `
                            
                               <li class="card">
                                    <div class="card-body">
                                        <div>
                                            <h4>${orderNumber}</h4>
                                            <h4>${orderDate}</h4>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <p>G - brckle</p>
                                                <p>p - 91.6</p>
                                                <p>w - 22.5</p>
                                            </div>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                                                alt="qr-code" />
                                        </div>
                                    </div>
                                </li>
                                
                            `;
                        } else {
                            // If any previous order was approved, do not allow transfer
                            if (isAnyOrderApproved) {
                                approve_array.push(order_id);

                                my_ord = `
                                   <li class="card">
                                    <div class="card-body">
                                        <div>
                                            <h4>${orderNumber}</h4>
                                            <h4>${orderDate}</h4>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <p>G - brckle</p>
                                                <p>p - 91.6</p>
                                                <p>w - 22.5</p>
                                            </div>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                                                alt="qr-code" />
                                        </div>
                                    </div>
                                </li>
                                
                                    
                                `;
                            } else {
                                
                                transfer_array.push(order_id); 
                                my_ord = `
                                     <li class="card">
                                    <div class="card-body">
                                        <div>
                                            <h4>${orderNumber}</h4>
                                            <h4>${orderDate}</h4>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <p>G - brckle</p>
                                                <p>p - 91.6</p>
                                                <p>w - 22.5</p>
                                            </div>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                                                alt="qr-code" />
                                        </div>
                                    </div>
                                </li>
                                
                                    
                                `;
                            }
                        }

                        if(approve_array.length >= 1){
                            buttonHtml = `
                                <div class="btn-list">
                                    <button class="btn" onclick="approve_order()">
                                        Approve Order
                                    </button>
                                   
                                </div>
                            `;
                        }else{
                            buttonHtml = `
                                <div class="btn-list">
                                    
                                    <button class="btn" onclick="transfer_order()">
                                        Transfer Order
                                    </button>
                                </div>
                            `;
                        }
                       

                        my_orders.innerHTML += my_ord;

                        // Only add the button once (based on approval or transfer status)
                        if (buttonHtml) {
                            console.log(buttonHtml);
                            my_orders.innerHTML += buttonHtml;
                        }else{
                            console.log("No transactions found");
                        }
                    }
                }
            
            });
    
        }


        function transfer_order() {

            $('#transfer_order').modal('show');
        }

        $(document).ready(function () {


            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#TransfersearchableSelectTo').select2({
                dropdownParent: $('#transfer_order'),
                placeholder: "Select an option",
                allowClear: true,
                ajax: {
                    url: "{{route('branch_list')}}",
                    dataType: 'json',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    delay: 250,
                    data: function (params) {
                        return {

                            search: params.term,
                            per_page: 10,
                            page: params.page || 1
                        };
                    },
                    processResults: function (data) {

                        return {
                            results: data.data.branches.map(function (item) {
                                return {
                                    id: item.branch_id,
                                    text: item.branch_name
                                };
                            }),
                            pagination: {
                                more: data.data.length >= 10 // Check if there are more results
                            }
                        };
                    },
                    cache: true
                }
            });
        });


        function transfer_this(){
            if (transfer_array.length == 0){
                alert('Cant transfer with empty array');
            }
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var transferTo = $('#TransfersearchableSelectTo').val();

            $.ajax({
                url: "{{ route('multiple_transfer') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    order_id: transfer_array,
                    transfer_to: transferTo

                },
                success: function (response) {
                    if (response.status == 200) {
                        $('#transfer_order_id').val('');
                        $('#TransfersearchableSelectTo').val('');
                        $('#transfer_order').modal('hide');
                        showAlert('success', response.message);

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {

                        showAlert('success', response.message);
                        $('#TransfersearchableSelectTo').val('');


                    }
                },
                error: function (xhr, status, error) {
                    showAlert('success', error);

                    $('#TransfersearchableSelectTo').val('');

                }
            });
        }

            function approve_order(){
                alert("Approve Order");
                if (approve_array.length == 0){
                    alert('Cant approve with empty array');
                }
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                    url: "{{ route('multiple_approve') }}",
                    type: 'POST',
                    data: {
                        _token  : csrfToken,
                        order_id: approve_array,
                        transfer_to: transferTo

                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('#transfer_order_id').val('');
                            $('#TransfersearchableSelectTo').val('');
                            $('#transfer_order').modal('hide');
                            showAlert('success', response.message);

                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {

                            showAlert('success', response.message);
                            $('#TransfersearchableSelectTo').val('');


                        }
                    },
                    error: function (xhr, status, error) {
                        showAlert('success', error);

                        $('#TransfersearchableSelectTo').val('');

                    }
                });
            }
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
                if (response.success) {
                    console.log(response);
                    location.href = "{{ route('login') }}";
                }
            }
        })
    }

    function changeBranch(branch_id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('branch-active') }}",  // Adjust the route as needed
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
