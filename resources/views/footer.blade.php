<footer class="mt-4">
    <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ $activePage === 'dashboard' ? 'active' : '' }}">
                            <a class="nav-link" href="{{route('dashboard')}}">
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-expand-md d-print-none">
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
                <div class="d-md-none d-flex align-items-center ps-3">
                    <button class="btn btn-ghost-primary btn-icon" onclick="startScanner()" id="start-scann" style="max-height:40px;">
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
                                <path d="M47,18h12c0.552,0,1-0.448,1-1V5c0-0.552-0.448-1-1-1H47c-0.552,0-1,0.448-1,1v12C46,17.552,46.448,18,47,18z M48,6h10v10
		H48V6z" />
                                <path d="M55,8h-4c-0.552,0-1,0.448-1,1v4c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V9C56,8.448,55.552,8,55,8z M54,12h-2v-2h2V12z
		" />
                                <path d="M17,46H5c-0.552,0-1,0.448-1,1v12c0,0.552,0.448,1,1,1h12c0.552,0,1-0.448,1-1V47C18,46.448,17.552,46,17,46z M16,58H6V48
		h10V58z" />
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
                <div class="nav-item dropdown dropup ps-3">
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
                        <!-- <a href="{{route('profile.edit')}}" class="dropdown-item">Profile</a> -->
                        <a href="{{route('settings')}}" class="dropdown-item">Settings</a>
                        <a href="" onclick="logout()" class="dropdown-item">Logout</a>

                    </div>
                </div>
                <div class="ps-3 nav-item dropdown dropup">
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
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.2/qr-scanner.umd.min.js"></script>
<style>
    @media (max-width:768px) {
        .page-body {
            margin-bottom: 0 !important;
            margin-top: 1rem !important;
        }
    }
</style>
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

    let qrScanner = null;
    domReady(function () {

        const videoElem   = document.getElementById("videoElem");
        const startButton = document.getElementById("start-scann");
        const my_orders   = document.getElementById("my_orders");


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
            create_order_array(1,7656545, 1, 5765654,6/34/3432)
   
        }

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
            // stopScanner();
        }

        function stopScanner() {
            if (qrScanner) {
                qrScanner.stop();
            }
            // document.getElementById("my-qr-reader").style.display = "none";
            // startButton.textContent = "Start Scanner";
        }

        startButton.addEventListener("click", function () {
            if (qrScanner && qrScanner.isScanning()) {
                stopScanner();
            } else {
                startScanner();
            }
        });


    });
    function stopScanner() {
        if (qrScanner) {
            qrScanner.stop();
        }
        document.getElementById("my-qr-reader").style.display = "none";
        startButton.textContent = "Start Scanner";
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
