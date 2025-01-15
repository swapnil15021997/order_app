@include('head')

<body class="layout-fluid">
    <div id="layout">

        <div class="main-content">
            <div class="d-none d-md-block" id="navbar-wrapper">
                @include('navbar')
            </div>
            <div class="page-wrapper">
                <div id="alert_container"></div>
                @yield('content')
            </div>
            <div class="d-md-none d-block" id="footer-wrapper">
                @include('footer')
            </div>
        </div>


 
<!-- 
        <div id="my-qr-reader"
           
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1000; background: rgba(0, 0, 0, 0.8);">
    
            <video id="videoElem" style="width: 100%; height: 100%; object-fit: cover;"></video>
            <div style="position:fixed; top: 1rem; right: 1rem; z-index: 1111;">
                <button class="btn btn-secondary btn-icon" id="close_qr_code">
                    <svg fill="currentColor" height="24px" width="24px" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <polygon points="512,59.076 452.922,0 256,196.922 59.076,0 0,59.076 196.922,256 0,452.922 59.076,512 256,315.076 452.922,512
			512,452.922 315.076,256 		" />
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            
        </div> -->

        <!-- <div id="my-qr-reader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1000; background: rgba(0, 0, 0, 0.8);">
    
            
            <div style="display: flex; flex-direction: column; height: 100%;">

                <div id="scanner-container" style="flex: 1; position: relative; background: black; color: white; overflow: hidden;">
                    <video id="videoElem" style="width: 100%; height: 100%; object-fit: cover;"></video>
                    <button class="btn btn-secondary btn-icon" id="close_qr_code"
                        style="position: absolute; top: 1rem; right: 1rem; z-index: 1111; background: rgba(255, 255, 255, 0.8); border: none; padding: 0.5rem;">
                        <svg fill="currentColor" height="24px" width="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <polygon points="512,59.076 452.922,0 256,196.922 59.076,0 0,59.076 196.922,256 0,452.922 59.076,512 256,315.076 452.922,512 512,452.922 315.076,256" />
                        </svg>
                    </button>
                </div>

            </div>
        </div> -->


    </div>

    <!-- Libs JS -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js')}}" defer></script>
    <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js')}}" defer></script>
    <script src="{{ asset('libs/jsvectormap/maps/world.js')}}" defer></script>
    <script src="{{ asset('libs/jsvectormap/maps/world-merc.js')}}" defer></script>

    <!-- <script src="{{ asset('libs/dropzone/dist/dropzone-min.js')}}" defer></script> -->
    
    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js')}}" defer></script>
    <script src="{{ asset('js/demo.min.js')}}" defer></script>
    <script src="{{ asset('js/manage-audio.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.2/qr-scanner.umd.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    

        <!-- new qr  -->

        <div id="my-qr-reader" class="qr-scanner-position">
            <div class="qr-scan-screen">
                <div class="qr-code">
                    <button class="btn btn-secondary btn-icon" id="close_qr_code" onclick="stopScanner()">
                        <svg fill="currentColor" height="24px" width="24px" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512 512" xml:space="preserve">
                            <g>
                                <g>
                                    <polygon points="512,59.076 452.922,0 256,196.922 59.076,0 0,59.076 196.922,256 0,452.922 59.076,512 256,315.076 452.922,512
			512,452.922 315.076,256 		" />
                                </g>
                            </g>
                        </svg>
                    </button>
                    <video id="videoElem" style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>
                <div class="qr-list">
                    <ul id="my_orders">
                        <!-- <li class="card">
                            <div class="card-body">
                                <div>
                                    <h4>#9276293</h4>
                                    <h4>12 Jan 2025</h4>
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
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>

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

        <!-- new qr finish  -->


        <!-- Libs JS -->
        <script src="{{ asset('libs/apexcharts/apexcharts.min.js')}}" defer></script>
        <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js')}}" defer></script>
        <script src="{{ asset('libs/jsvectormap/maps/world.js')}}" defer></script>
        <script src="{{ asset('libs/jsvectormap/maps/world-merc.js')}}" defer></script>

        <!-- <script src="{{ asset('libs/dropzone/dist/dropzone-min.js')}}" defer></script> -->

        <!-- Tabler Core -->
        <script src="{{ asset('js/tabler.min.js')}}" defer></script>
        <script src="{{ asset('js/demo.min.js')}}" defer></script>
        <script src="{{ asset('js/manage-audio.js')}}" defer></script>

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js"></script>
        <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->

        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.2/qr-scanner.umd.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <style>
            @media (max-width:768px) {
                .page-body {
                    margin-bottom: 0 !important;
                    margin-top: 1rem !important;
                }
            }
        </style>
        <script>
            
        
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
                // document.getElementById("my-qr-reader").style.display = "none";
                // startButton.textContent = "Start Scanner";
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
        let scanned = [];
        let isScanning = false;
        function create_order_array(order_id,orderQrCode, orderStatus, orderNumber,orderDate){
            const my_orders   = document.getElementById("my_orders");
            const qr_list = document.querySelector(".qr-list");
            let my_ord;
            let buttonHtml = '';
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            if (isScanning) {
                alert("Please wait until the current scan is complete.");
                return; // Stop further execution
            } 
            isScanning = true;
            
            if (scanned.includes(order_id)) {
                isScanning = false;
                alert("This order is already approved.");
                return; // Stop further execution
            }

            
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
                        if (!qr_list.querySelector(".btn-list")) {
                            qr_list.insertAdjacentHTML("beforeend", buttonHtml);
                        }
                        scanned.push(order_id);
                    }
                    isScanning = false;
                }
            
            });
    
        }


        function transfer_order() {

            $('#transfer_order').modal('show');
        }

        

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
                
                if (approve_array.length == 0){
                    alert('Cant approve with empty array');
                }
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
                $.ajax({
                    url: "{{ route('multiple_approve') }}",
                    type: 'POST',
                    data: {
                        _token  : csrfToken,
                        order_id: approve_array
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            $('#transfer_order_id').val('');
                            $('#TransfersearchableSelectTo').val('');
                             
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
        <!-- <script>
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
            const startButton = document.getElementById("start-scanner");
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
    </script> -->
        <script type="module">


            const serviceWorkerRegistration = await navigator
                .serviceWorker
                .register('/firebase_json.js', { scope: '/' });

            var firebaseConfig = {
                apiKey: "AIzaSyDGtmMCnDlvMJZ3G3LG4KPDaDaxEZceJ_Y",
                authDomain: "orderapp-bc2f6.firebaseapp.com",
                projectId: "orderapp-bc2f6",
                storageBucket: "orderapp-bc2f6.firebasestorage.app",
                messagingSenderId: "524963568172",
                appId: "1:524963568172:web:529f3ceebf7708a17b8f89",
                measurementId: "G-VRNHVWS31N"
            };



            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();
            messaging.useServiceWorker(serviceWorkerRegistration);

            messaging.requestPermission().then(() => {
                console.log('Notification permission granted.');
                // Token retrieval and handling logic goes here
            }).catch((err) => {
                console.log('Unable to get permission for notifications.', err);
            });


            messaging.getToken({ vapidKey: "BFiOsDvZzhkeHzA5ZnPK8LZ5FtlkbbUnZNsYpoW3jWR5Yd0IMTHLcJY_G9lPUnwu4zhkDM7hbcaxGP4aQ7qhmqI" }).then((currentToken) => {
                if (currentToken) {

                    console.log("your token", currentToken);
                    var currentToken = currentToken;

                    $.ajax({
                        type: "POST",
                        url: "{{route('update-fcm')}}",
                        dataType: 'json',
                        data: {
                            "fcm_token": currentToken

                        },

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function (data) {
                            if (data.status == "200") {


                            }
                            if (data.status == '500') {

                            }
                        },

                    });


                } else {
                    // Show permission request UI
                    console.log('No registration token available. Request permission to generate one.');
                    // ...
                }
            }).catch((err) => {
                console.log('An error occurred while retrieving token. ', err);

            });

            messaging.onMessage(function (payload) {
                const title = payload.notification.title;
                const options = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(title, options);
            });


            self.addEventListener('push', function (payload, event) {
                event.waitUntil(
                    self.registration.showNotification('Title', {
                        body: payload.notification.body,
                        icon: payload.notification.icon // replace with actual icon URL



                    })
                );
            });




        </script>

        <script>

            // var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // let page = 1;
            // let loadNotes;
            // let isLoading = false;
            // document.addEventListener("DOMContentLoaded", function () {
            //     // Function to load notes
            //     loadNotes = function () {
            //         console.log('Loading notes I am here...',isLoading);
            //         if (isLoading) return;

            //         isLoading = true;
            //         const notesBody = $('#notes_body');
            //         const scrollTopBeforeLoad = notesBody.scrollTop();
            //         console.log("Loading notes",isLoading);
            //         $.ajax({
            //             url: "{{ route('notes_list') }}",
            //             type: 'POST',
            //             data:  {
            //                 search   : '',
            //                 per_page : 8,
            //                 page     : page
            //             },
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken
            //             },
            //             success: function(response) {
            //                 const notesBody = $('#notes_body');
            //                 let firstNoteOffset = notesBody[0].scrollHeight;

            //                       response.data.notes.forEach(function(note) {

            //                         if (note.notes_type == 1){
            //                             notesBody.append(`
            //                             <div class="my-note-box chat-bubble-me" >
            //                                 <div class="chat-bubble-title"></div>
            //                                 <div class="chat-bubble-body" >
            //                                     <p>${note.notes_text}.</p>
            //                                 </div>
            //                             </div>`);
            //                         }else{
            //                             if(note.file.file_type == 'pdf'){
            //                                 notesBody.append(`
            //                                 <div class="my-note-box chat-bubble-me w-75">
            //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
            //                                     <embed src=""${note.file.file_url}" width="100%" height="auto" />
            //                                 </div>`);
            //                             }else{


            //                                 notesBody.append(`
            //                                 <div class="my-note-box chat-bubble-me w-75">
            //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
            //                                     <img
            //                                     src="${note.file.file_url}"
            //                                     alt=""
            //                                     class="rounded img-fluid"
            //                                     />
            //                                 </div>  `);
            //                             }

            //                         }
            //                     });

            //                     page++;
            //             }
            //         });

            //     }


            //     function handleScroll() {
            //         const notesBox = document.getElementById("notes_body");
            //         console.log("HandleScroll",notesBox);
            //         if (!notesBox) return;

            //         const { scrollTop, scrollHeight, clientHeight } = notesBox;
            //         console.log(scrollTop, scrollHeight,clientHeight);

            //         if (scrollTop + clientHeight >= scrollHeight - 5) {

            //             isLoading = false;
            //             loadNotes();
            //         }
            //     }

            //     // Initial load
            //     loadNotes();


            //     setTimeout(function() {
            //         const notesBox = document.getElementById("notes_body");
            //         if (notesBox) {

            //             notesBox.addEventListener("scroll", handleScroll);

            //             // notesBox.scrollTop(notesBox[0].scrollHeight);
            //         }
            //     }, 500);


            // });
            // function open_file_select() {
            //     $("#fileInput").click();
            // }

            // function handleFileUpload(event) {
            //     const file = event.target.files; // Get the selected file
            //     if (file) {

            //         const formData = new FormData();
            //         formData.append('notes_text', '');
            //         for (var i = 0; i < file.length; i++) {
            //                 formData.append('notes_file[]', file[i]);
            //             }
            //         $.ajax({
            //             url: "{{ route('notes_add') }}",
            //             type: 'POST',
            //             data: formData,
            //             contentType: false, // Disable automatic content-type header
            //             processData: false,
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken
            //             },
            //             success: function (response) {
            //                 showAlertNotes('success',response.message);
            //                 isLoading=false;
            //                 loadNotes();
            //             }
            //         });

            //     } else {
            //         console.log("No file selected");
            //     }
            // }

            // $(document).ready(function () {


            //     $("#TextNotes").on("keydown", function (event) {
            //         if (event.key === "Enter") {
            //             event.preventDefault();
            //             const text = event.target.value.trim();
            //             if (text) {
            //                 var csrfToken = $('meta[name="csrf-token"]').attr('content');

            //                 console.log("Entered text:", text);
            //                 $.ajax({
            //                     url: "{{ route('notes_add') }}",
            //                     type: 'POST',
            //                     data: {
            //                         'notes_text' : text,
            //                         'notes_file' : null
            //                     },
            //                     headers: {
            //                         'X-CSRF-TOKEN': csrfToken
            //                     },
            //                     success: function (response) {
            //                         showAlertNotes('success',response.message);
            //                         $('#TextNotes').val('');
            //                         isLoading=false;
            //                         page = 1;
            //                         loadNotes();
            //                         console.log("Success Add");
            //                     }
            //                 });

            //             } else {
            //                 alert("Please enter some text.");
            //                 showAlertNotes('warning','Please enter some text');
            //             }
            //         }
            //     });
            // });


            // old code

            // var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // let page = 1;
            // let loadNotes;
            // let isLoading = false;

            // document.addEventListener("DOMContentLoaded", function () {
            //     // Function to load notes
            //     loadNotes = function (isScrollUp = false) {
            //         if (isLoading) return;

            //         isLoading = true;
            //         const notesBody = $('#notes_body');
            //         notesBody.html('');
            //         const scrollTopBeforeLoad = notesBody.scrollTop();

            //         $.ajax({
            //             url: "{{ route('notes_list') }}",
            //             type: 'POST',
            //             data: {
            //                 search: '',
            //                 per_page: 8,
            //                 page: page
            //             },
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken
            //             },
            //             success: function (response) {
            //                 const notesBody = $('#notes_body');
            //                 let firstNoteOffset = notesBody[0].scrollHeight;

            //                 // Add new notes below
            //                 if (!isScrollUp) {
            //                     response.data.notes.forEach(function (note) {
            //                         if (note.notes_type == 1) {
            //                             notesBody.append(`
            //                             <div class="my-note-box">
            //                                 <div class="chat-bubble-title"></div>
            //                                 <div class="chat-bubble-body">
            //                                     <p>${note.notes_text}.</p>
            //                                 </div>
            //                             </div>`);
            //                         } else {
            //                             if (note.file.file_type == 'pdf') {
            //                                 notesBody.append(`
            //                                 <div class="my-note-box w-75">
            //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
            //                                     <embed src="${note.file.file_url}" width="100%" height="auto" />
            //                                 </div>`);
            //                             } else {
            //                                 notesBody.append(`
            //                                 <div class="my-note-box w-75">
            //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
            //                                     <img src="${note.file.file_url}" alt="" class="rounded img-fluid" />
            //                                 </div>`);
            //                             }
            //                         }
            //                     });
            //                 } else {
            //                     // Add older notes to the top when scrolling up
            //                     let newNotes = '';
            //                     response.data.notes.forEach(function (note) {
            //                         if (note.notes_type == 1) {
            //                             newNotes = `
            //                             <div class="my-note-box">
            //                                 <div class="chat-bubble-title"></div>
            //                                 <div class="chat-bubble-body">
            //                                     <p>${note.notes_text}.</p>
            //                                 </div>
            //                             </div>` + newNotes;
            //                         } else {
            //                             if (note.file.file_type == 'pdf') {
            //                                 newNotes = `
            //                                 <div class="my-note-box w-75">
            //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
            //                                     <embed src="${note.file.file_url}" width="100%" height="auto" />
            //                                 </div>` + newNotes;
            //                             } else {
            //                                 newNotes = `
            //                                 <div class="my-note-box w-75">
            //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
            //                                     <img src="${note.file.file_url}" alt="" class="rounded img-fluid" />
            //                                 </div>` + newNotes;
            //                             }
            //                         }
            //                     });
            //                     notesBody.prepend(newNotes);
            //                 }

            //                 page++;

            //                 // Scroll position handling after load
            //                 if (isScrollUp) {
            //                     notesBody.scrollTop(notesBody[0].scrollHeight - firstNoteOffset);
            //                 } else {
            //                     notesBody.scrollTop(notesBody[0].scrollHeight);
            //                 }

            //                 isLoading = false;
            //             }
            //         });
            //     }

            //     // Initial load (start from the bottom)
            //     loadNotes();

            //     // Handle scroll event
            //     function handleScroll() {
            //         const notesBox = document.getElementById("notes_body");
            //         if (!notesBox) return;

            //         const { scrollTop, scrollHeight, clientHeight } = notesBox;

            //         if (scrollTop + clientHeight >= scrollHeight - 5) {
            //             // Load more notes at the bottom
            //             loadNotes();
            //         } else if (scrollTop === 0) {
            //             // Load older notes when scrolling up
            //             loadNotes(true);
            //         }
            //     }

            //     // Attach scroll event
            //     setTimeout(function () {
            //         const notesBox = document.getElementById("notes_body");
            //         if (notesBox) {
            //             notesBox.addEventListener("scroll", handleScroll);
            //         }
            //     }, 500);


            //     $(document).ready(function () {
            //         // Handle file upload

            //         // Handle new text note submission
            //         $("#TextNotes").on("keydown", function (event) {
            //             if (event.key === "Enter") {
            //                 event.preventDefault();
            //                 const text = event.target.value.trim();
            //                 if (text) {
            //                     $.ajax({
            //                         url: "{{ route('notes_add') }}",
            //                         type: 'POST',
            //                         data: {
            //                             'notes_text': text,
            //                             'notes_file': null
            //                         },
            //                         headers: {
            //                             'X-CSRF-TOKEN': csrfToken
            //                         },
            //                         success: function (response) {
            //                             showAlertNotes('success', response.message);
            //                             $('#TextNotes').val('');
            //                             isLoading = false;
            //                             page = 1;
            //                             loadNotes();
            //                         }
            //                     });
            //                 } else {
            //                     alert("Please enter some text.");
            //                     showAlertNotes('warning', 'Please enter some text');
            //                 }
            //             }
            //         });
            //     });
            // });

            // function open_file_select() {
            //     $("#fileInput").click();
            // }

            // function handleFileUpload(event) {
            //     const file = event.target.files;
            //     if (file) {
            //         const formData = new FormData();
            //         formData.append('notes_text', '');
            //         for (var i = 0; i < file.length; i++) {
            //             formData.append('notes_file[]', file[i]);
            //         }
            //         $.ajax({
            //             url: "{{ route('notes_add') }}",
            //             type: 'POST',
            //             data: formData,
            //             contentType: false,
            //             processData: false,
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken
            //             },
            //             success: function (response) {
            //                 showAlertNotes('success', response.message);
            //                 isLoading = false;
            //                 loadNotes();
            //             }
            //         });
            //     } else {
            //         console.log("No file selected");
            //     }
            // }

            // function showAlertNotes(type, message) {
            //     const alertContainer = document.getElementById('notes-container');
            //     const alertHTML = `
            //         <div class="alert alert-${type} position-fixed  bg-white alert-dismissible" role="alert" style="top:1rem; right:1rem;width:350px;">
            //             <div class="d-flex ">
            //                 <div>
            //                     ${type === 'success' ? `
            //                     <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            //                         <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            //                         <path d="M5 12l5 5l10 -10" />
            //                     </svg>` : `
            //                     <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            //                         <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            //                         <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
            //                         <path d="M12 9v4" />
            //                         <path d="M12 17h.01" />
            //                     </svg>`}
            //                 </div>
            //                 <div>${message}</div>
            //             </div>
            //             <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            //         </div>
            //     `;
            //     alertContainer.innerHTML = alertHTML;
            //     console.log("here");
            // }

        </script>

</body>

</html>
