@include('head')

<body>
    <div class="layout-wrapper">

        <div class="main-content">
            <div class="d-none d-md-block" id="navbar-wrapper">
                @include('navbar')
            </div>
            <div class="page-wrapper">
                @yield('content')
            </div>
            <div class="d-md-none d-block" id="footer-wrapper">
                @include('footer')
            </div>
        </div>

        <div class="note-sidebar" id="note_sheet">
            <div class="card border-0">
                <div class="card-header p-2 rounded-0 ">
                    <h5 class="card-title">Notes</h5>
                    <button class="btn btn-tabler btn-ghost-secondary note-close-btn ms-auto btn-icon"
                        onclick="toogleNoteSheet()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline x">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="notes-container"></div>
            <div class="space-y-1 scrollable h-100 py-2 px-1" id="notes_body">
            </div>
            <div class="input-group input-group-flat rounded-0 border-top">
                <input type="text" class="form-control rounded-0 border-0" autocomplete="off" placeholder="Type note..."
                    id="TextNotes" />
                <span class="input-group-text rounded-0 border-0">
                    <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(event)"
                        multiple />
                    <a href="#" onclick="open_file_select()" class="link-secondary ms-2" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Please Select file to upload">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5">
                            </path>
                        </svg>
                    </a>
                </span>
            </div>
        </div>

        <div class="note-open-btn">
            <button class="btn btn-tabler btn-ghost-secondary btn-icon" onclick="toogleNoteSheet()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline clipboard">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                    <path d="M9 12h6" />
                    <path d="M9 16h6" />
                </svg>
            </button>
        </div>


        <div id="my-qr-reader"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1000; background: rgba(0, 0, 0, 0.8);">
            <video id="videoElem" style="width: 100%; height: 100%; object-fit: cover;"></video>
            <div style="position:fixed; top: 1rem; right: 1rem; z-index: 1111;">
                <button class="btn btn-secondary btn-icon">
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
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js')}}" defer></script>
    <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js')}}" defer></script>
    <script src="{{ asset('libs/jsvectormap/maps/world.js')}}" defer></script>
    <script src="{{ asset('libs/jsvectormap/maps/world-merc.js')}}" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js')}}" defer></script>
    <script src="{{ asset('js/demo.min.js')}}" defer></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js"></script>
    <!-- <script src="https://unpkg.com/html5-qrcode"></script> -->

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.2/qr-scanner.umd.min.js"></script>
    <style>
        @media (max-width:768px) {
            .page-body {
                margin-bottom: 0 !important;
                margin-top: 1rem !important;
            }
        }
    </style>
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



        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        let page = 1;
        let loadNotes;
        let isLoading = false;

        document.addEventListener("DOMContentLoaded", function () {
            // Function to load notes
            loadNotes = function (isScrollUp = false) {
                if (isLoading) return;

                isLoading = true;
                const notesBody = $('#notes_body');
                notesBody.html('');
                const scrollTopBeforeLoad = notesBody.scrollTop();

                $.ajax({
                    url: "{{ route('notes_list') }}",
                    type: 'POST',
                    data: {
                        search: '',
                        per_page: 8,
                        page: page
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        const notesBody = $('#notes_body');
                        let firstNoteOffset = notesBody[0].scrollHeight;

                        // Add new notes below
                        if (!isScrollUp) {
                            response.data.notes.forEach(function (note) {
                                if (note.notes_type == 1) {
                                    notesBody.append(`
                                    <div class="my-note-box">
                                        <div class="chat-bubble-title"></div>
                                        <div class="chat-bubble-body">
                                            <p>${note.notes_text}.</p>
                                        </div>
                                    </div>`);
                                } else {
                                    if (note.file.file_type == 'pdf') {
                                        notesBody.append(`
                                        <div class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <embed src="${note.file.file_url}" width="100%" height="auto" />
                                        </div>`);
                                    } else {
                                        notesBody.append(`
                                        <div class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <img src="${note.file.file_url}" alt="" class="rounded img-fluid" />
                                        </div>`);
                                    }
                                }
                            });
                        } else {
                            // Add older notes to the top when scrolling up
                            let newNotes = '';
                            response.data.notes.forEach(function (note) {
                                if (note.notes_type == 1) {
                                    newNotes = `
                                    <div class="my-note-box">
                                        <div class="chat-bubble-title"></div>
                                        <div class="chat-bubble-body">
                                            <p>${note.notes_text}.</p>
                                        </div>
                                    </div>` + newNotes;
                                } else {
                                    if (note.file.file_type == 'pdf') {
                                        newNotes = `
                                        <div class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <embed src="${note.file.file_url}" width="100%" height="auto" />
                                        </div>` + newNotes;
                                    } else {
                                        newNotes = `
                                        <div class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <img src="${note.file.file_url}" alt="" class="rounded img-fluid" />
                                        </div>` + newNotes;
                                    }
                                }
                            });
                            notesBody.prepend(newNotes);
                        }

                        page++;

                        // Scroll position handling after load
                        if (isScrollUp) {
                            notesBody.scrollTop(notesBody[0].scrollHeight - firstNoteOffset);
                        } else {
                            notesBody.scrollTop(notesBody[0].scrollHeight);
                        }

                        isLoading = false;
                    }
                });
            }

            // Initial load (start from the bottom)
            loadNotes();

            // Handle scroll event
            function handleScroll() {
                const notesBox = document.getElementById("notes_body");
                if (!notesBox) return;

                const { scrollTop, scrollHeight, clientHeight } = notesBox;

                if (scrollTop + clientHeight >= scrollHeight - 5) {
                    // Load more notes at the bottom
                    loadNotes();
                } else if (scrollTop === 0) {
                    // Load older notes when scrolling up
                    loadNotes(true);
                }
            }

            // Attach scroll event
            setTimeout(function () {
                const notesBox = document.getElementById("notes_body");
                if (notesBox) {
                    notesBox.addEventListener("scroll", handleScroll);
                }
            }, 500);


            $(document).ready(function () {
                // Handle file upload

                // Handle new text note submission
                $("#TextNotes").on("keydown", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        const text = event.target.value.trim();
                        if (text) {
                            $.ajax({
                                url: "{{ route('notes_add') }}",
                                type: 'POST',
                                data: {
                                    'notes_text': text,
                                    'notes_file': null
                                },
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function (response) {
                                    showAlertNotes('success', response.message);
                                    $('#TextNotes').val('');
                                    isLoading = false;
                                    page = 1;
                                    loadNotes();
                                }
                            });
                        } else {
                            alert("Please enter some text.");
                            showAlertNotes('warning', 'Please enter some text');
                        }
                    }
                });
            });
        });

        function open_file_select() {
            $("#fileInput").click();
        }

        function handleFileUpload(event) {
            const file = event.target.files;
            if (file) {
                const formData = new FormData();
                formData.append('notes_text', '');
                for (var i = 0; i < file.length; i++) {
                    formData.append('notes_file[]', file[i]);
                }
                $.ajax({
                    url: "{{ route('notes_add') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        showAlertNotes('success', response.message);
                        isLoading = false;
                        loadNotes();
                    }
                });
            } else {
                console.log("No file selected");
            }
        }

        function showAlertNotes(type, message) {
            const alertContainer = document.getElementById('notes-container');
            const alertHTML = `
                <div class="alert alert-${type} position-fixed  bg-white alert-dismissible" role="alert" style="top:1rem; right:1rem;width:350px;">
                    <div class="d-flex ">
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

</body>

</html>
