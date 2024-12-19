@include('head')

<body>
    @include('navbar')

    <div class="page-wrapper">
       
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <div class="note-popver position-fixed">
      <div class="dropup">
        <button
          class="btn btn-tabler btn-ghost-secondary btn-icon"
          data-bs-toggle="dropdown"
          data-bs-auto-close="outside"
          role="button"
          aria-expanded="false"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline clipboard"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"
            />
            <path
              d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"
            />
            <path d="M9 12h6" />
            <path d="M9 16h6" />
          </svg>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline x"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M18 6l-12 12" />
            <path d="M6 6l12 12" />
          </svg>
        </button>
        <div class="dropdown-menu p-2 pe-0">
          <div class="dropdown-menu-columns">
            <div class="dropdown-menu-column ">
            
              <div class="d-flex flex-column justify-content-between" >
                <div id="notes-container"></div>
                <div class="space-y-1 scrollable pb-2 pe-1" id="notes_body">
                    <!-- <div class="chat-bubble chat-bubble-me" >
                        <div class="chat-bubble-title"></div>
                        <div class="chat-bubble-body" >
                            <p>Sure Paweł, let me pull the latest updates.</p> 
                        </div>
                    </div>
                    <div class="chat-bubble chat-bubble-me mt-2" id="notes_body">
                        <div class="chat-bubble-title"></div>
                        <div class="chat-bubble-body" >
                            <p>Sure Paweł, let me pull the latest updates.</p> 
                        </div>
                    </div> -->
                </div>
                
                <div class="input-group input-group-flat pe-2">
                  <input
                    type="text"
                    class="form-control"
                    autocomplete="off"
                    placeholder="Type message"
                    id="TextNotes"
                  />
                  <span class="input-group-text">
                  <input
                    type="file"
                    id="fileInput"
                    style="display: none;"
                     
                    onchange="handleFileUpload(event)"
                    multiple
                    />
                    <a
                      href="#"
                      class="link-secondary"
                      data-bs-toggle="tooltip"
                      aria-label="Clear search"
                      data-bs-original-title="Clear search"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path
                          stroke="none"
                          d="M0 0h24v24H0z"
                          fill="none"
                        ></path>
                        <path
                          d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"
                        ></path>
                        <path d="M9 10l.01 0"></path>
                        <path d="M15 10l.01 0"></path>
                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                      </svg>
                    </a>
                    <a
                      href="#"
                      onclick="open_file_select()"
                      class="link-secondary ms-2"
                      data-bs-toggle="tooltip"
                      aria-label="Add notification"
                      data-bs-original-title="Add notification"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="icon"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path
                          stroke="none"
                          d="M0 0h24v24H0z"
                          fill="none"
                        ></path>
                        <path
                          d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5"
                        ></path>
                      </svg>
                    </a>
                  </span>
                </div>
              </div>
            </div>
          </div>
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
<script type="module">


    const serviceWorkerRegistration = await navigator
            .serviceWorker
            .register('./firebase_json.js');

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

    
            messaging.getToken({vapidKey:"BFiOsDvZzhkeHzA5ZnPK8LZ5FtlkbbUnZNsYpoW3jWR5Yd0IMTHLcJY_G9lPUnwu4zhkDM7hbcaxGP4aQ7qhmqI"}).then((currentToken) => {
                if (currentToken) {
                    
                    console.log("your token",currentToken);
                        var currentToken    = currentToken;

                        $.ajax({
                        type: "POST",
                        url: "{{route('update-fcm')}}",
                        dataType: 'json',
                        data: {
                        "fcm_token":currentToken

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


                self.addEventListener('push', function(payload,event) {
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
      //                             <div class="chat-bubble chat-bubble-me" >
      //                                 <div class="chat-bubble-title"></div>
      //                                 <div class="chat-bubble-body" >
      //                                     <p>${note.notes_text}.</p> 
      //                                 </div>
      //                             </div>`); 
      //                         }else{
      //                             if(note.file.file_type == 'pdf'){
      //                                 notesBody.append(`
      //                                 <div class="chat-bubble chat-bubble-me w-75">
      //                                     <p class="small text-decoration-underline">${note.file.file_original_name}</p>
      //                                     <embed src=""${note.file.file_url}" width="100%" height="auto" />
      //                                 </div>`);
      //                             }else{

                                  
      //                                 notesBody.append(`
      //                                 <div class="chat-bubble chat-bubble-me w-75">
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
                                <div class="chat-bubble chat-bubble-me">
                                    <div class="chat-bubble-title"></div>
                                    <div class="chat-bubble-body">
                                        <p>${note.notes_text}.</p>
                                    </div>
                                </div>`);
                        } else {
                            if (note.file.file_type == 'pdf') {
                                notesBody.append(`
                                    <div class="chat-bubble chat-bubble-me w-75">
                                        <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                        <embed src="${note.file.file_url}" width="100%" height="auto" />
                                    </div>`);
                            } else {
                                notesBody.append(`
                                    <div class="chat-bubble chat-bubble-me w-75">
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
                                <div class="chat-bubble chat-bubble-me">
                                    <div class="chat-bubble-title"></div>
                                    <div class="chat-bubble-body">
                                        <p>${note.notes_text}.</p>
                                    </div>
                                </div>` + newNotes;
                        } else {
                            if (note.file.file_type == 'pdf') {
                                newNotes = `
                                    <div class="chat-bubble chat-bubble-me w-75">
                                        <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                        <embed src="${note.file.file_url}" width="100%" height="auto" />
                                    </div>` + newNotes;
                            } else {
                                newNotes = `
                                    <div class="chat-bubble chat-bubble-me w-75">
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

    // Handle file upload
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

    $(document).ready(function () {
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


      function showAlertNotes(type, message) {
            const alertContainer = document.getElementById('notes-container');
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
  </body>
</html>