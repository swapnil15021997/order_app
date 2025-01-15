@extends('app')

@section('content')

<!-- Page header -->

<div class="container-xl">
    <div class="order-from-page">
        <div class="w-full">
            <div>
                <div class="page-body">
                    <div class="d-flex flex-column gap-3">
                        <div id="alert-site"></div>
                        <div id="alert-container"></div>
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <div>
                                <img src="{{ asset('static/logo_order.png')}}" alt="Tabler" class="img-fluid "
                                    width="80px" height="40px" />
                                <p class="mb-0 mt-1">{{$login['name']}} <br /> +91 {{$login['user_phone_number']}} </p>
                            </div>
                            {{$qr_code}}
                            <input type="hidden" name="qr_code_number" value="{{$qr_code_number}}" id="qr_code_number">


                            <!-- <img src="{{ asset('static/qr_code.png')}}" alt="Tabler" class="img-fluid" width="100px"> -->
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h2 class="font-bold">
                                    <span id="form_title">{{ $type == 'order' ? 'Order Form' : ($type == 'repairing' ? 'Repairing Form' : '') }}</span> 
                                                                            #{{$order_number}}</h2>
                                    <div class="col-sm-6">
                                        <input type="hidden" id="order_number" name="order_number"
                                            value="{{$order_number}}">

                                        <div class="col-12">
                                            <label for="order_date" class="form-label" required>Order Date
                                                <span style="color: red;">*</span>
                                            </label>
                                            <input type="text" id="order_date" required class="form-control">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="order_type" class="form-label">Order Type</label>
                                            <select id="order_type" class="form-select" type="text">

                                                <option value="order" {{ $type == 'order' ? 'selected' : '' }}>Order</option>
                                                <option value="reparing" {{ $type == 'repairing' ? 'selected' : '' }}>Reparing</option>
                                            </select>
                                            <!-- <div class="d-flex align-items-center">
                                                <label class="form-check-label ms-2">Order</label>
                                                <label class="form-check form-switch m-0 ms-2">
                                                    <input class="form-check-input" id="order_type" type="checkbox" checked>
                                                </label>
                                                <label class="form-check-label me-2 ms-2">Reparing</label>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mt-sm-0 mt-3">
                                        <input type="hidden" name="" id="customer_new">
                                        <div class="col-12">
                                            <label class="form-label">Select Customer
                                                <span style="color: red;">*</span>
                                            </label>

                                            <select id="searchableCust" class="form-select select2">

                                            </select>
                                        </div>
                                        <div class="d-none" id="cust_div">

                                            <div class="col-12 mt-4">
                                                <label for="order_customer_name" class="form-label">Customer name
                                                    <span style="color: red;">*</span>
                                                </label>
                                                <input type="text" placeholder="Enter name" id="order_customer_name"
                                                    class="form-control" form>
                                            </div>
                                            <div class="mt-3">
                                                <label for="cust_phone_no" class="form-label">Phone number
                                                    <span style="color: red;">*</span>
                                                </label>
                                                <input type="text" placeholder="Enter number" id="cust_phone_no"
                                                    class="form-control" form>
                                            </div>
                                            <div class="mt-3">
                                                <label for="customer_address" class="form-label">Address
                                                    <span style="color: red;">*</span>
                                                </label>
                                                <textarea type="text" placeholder="Enter Address" id="customer_address"
                                                    class="form-control" form></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="h2">Branch & Transfer</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="searchableSelectFrom" class="form-label">From
                                            <span style="color: red;">*</span>
                                        </label>

                                        <select id="searchableSelectFrom" class="form-select" type="text">

                                            @foreach ($user_branch as $branch)

                                                <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $login['user_active_branch']) selected @endif>
                                                    {{ $branch['branch_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-sm-0">
                                        <label for="searchableSelectTo" class="form-label">To
                                            <span style="color: red;">*</span>
                                        </label>

                                        <select id="searchableSelectTo" class="form-select w-100" type="text">

                                            @foreach ($branchesArray as $branch)
                                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="h2">Item Details</h4>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <label for="item_name" class="form-label">Name
                                            <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="item_name" placeholder="Select Item" />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <label for="item_metal" class="form-label">Metal
                                            <span style="color: red;">*</span>
                                        </label>
                                        <select class="form-select" id="item_metal">
                                            <option value="" disabled selected>Select a metal</option>
                                            @foreach ($metals as $metal)
                                                <option value="{{ $metal->metal_name }}" selected>
                                                    {{ $metal->metal_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <label for="item_melting" class="form-label">Melting
                                            <span style="color: red;">*</span>
                                        </label>
                                        <select class="form-select" id="item_melting">
                                            <option value="" disabled selected>Select a melting</option>
                                            @foreach ($melting as $melt)
                                                <option value="{{ $melt->melting_name }}" selected>
                                                    {{ $melt->melting_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <label for="item_weight" class="form-label">Weight
                                            <span style="color: red;">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="item_weight" placeholder="Weight of item" />
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <label for="item_colors" class="form-label">Colors</label>
                                        <select class="form-select" id="item_colors">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color['color_id'] }}">{{ $color['color_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <!-- <div class="col-12">
                                        <input type="file" class="form-control" id="item_image_id" multiple
                                            onchange="previewSelectedImages()" placeholder="Choose Images" />
                                    </div> -->
                                    <form class="dropzone" id="dropzone-multiple" autocomplete="off" novalidate>
                                        <div class="fallback">
                                            <div class="dz-default dz-message">

                                                <p class="dz-button">Drop files here to upload</p>
                                            </div>
                                            <input name="file" class="d-none" type="file" id="item_image_id" multiple />
                                        </div>
                                    </form>
                                </div>
                                <div class="row mt-3" id="uploaded-images">

                                <!-- <div class="col-4">
                                        <div class="selected-files">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://images.unsplash.com/photo-1736148912326-aeeda15df88f?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                    alt="select image" width="35px" />
                                                <div>
                                                    <p>Image potrait.jpg</p>
                                                    <small>500kb</small>
                                                </div>
                                            </div>
                                            <button>
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.59 6L10 8.59L7.41 6L6 7.41L8.59 10L6 12.59L7.41 14L10 11.41L12.59 14L14 12.59L11.41 10L14 7.41L12.59 6ZM10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z"
                                                        fill="#858585" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row mt-3">
                                    <label for="customer_address" class="form-label">Notes
                                         
                                    </label>
                                    <textarea type="text" placeholder="Enter Notes" id="order_remarks"
                                        class="form-control" form></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card d-none" id="payment">
                            <div class="card-body row ">

                                <h4 class="h2">Payment Details</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="payment_advance" class="form-label">Advance cash deposit</label>
                                        <input type="number" placeholder="Enter here" class="form-control"
                                            id="payment_advance" name="example-text-input">
                                    </div>
                                    <div class="col-sm-6 mt-3 mt-sm-0">
                                        <label for="payment_booking" class="form-label">Rate</label>
                                        <input type="number" class="form-control" id="payment_booking"
                                            placeholder="Enter here">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="#" onclick="cancel_save()"
                                        class="btn btn-secondary me-2 d-flex justify-content-end align-items-end">

                                        Cancel
                                    </a>
                                    <a href="#" class="btn btn-primary  d-flex justify-content-end align-items-end"
                                        id="saveBranchBtn">

                                        Save
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <input type="hidden" name="" id="temp_order_id" value="{{session('temp_order_id')}}">

        <div class="modal modal-blur fade" id="record_audio" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Record Audio</h5>
                        <button type="button" id="cancelButton" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <!-- Audio Control Buttons -->

                            <button id="recordButton" class="btn btn-success">
                                <i class="bi bi-mic"></i>
                            </button>
                            <!-- <button id="pauseRecording" class="btn btn-warning" disabled>
                            <i class="bi bi-pause-circle"></i>
                            </button>
                            <button id="resumeRecording" class="btn btn-info" disabled>
                            <i class="bi bi-play-circle"></i>
                            </button> -->
                            <button id="stopButton" class="btn btn-danger" disabled>
                                <i class="bi bi-stop-circle"></i>
                            </button>
                        </div>


                        <div class="mt-4 text-center d-none" id="audioPlaybackContainer">
                            <!-- Audio Player -->
                            <audio id="audio-playback" controls></audio>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <a id="resetButton" href="#" type="button" class="btn btn-primary">
                            Reset Audio
                        </a>

                        <button id="sendButton" href="#" type="button" class="btn btn-primary">
                            Send Audio
                        </button>
                    </div>

                </div>
            </div>
        </div>



        <div class="modal modal-blur fade" id="click_image" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="camera_header">
                        <div class="d-flex align-items-end justify-content-end">
                            <button type="button" class="btn btn-ghost-secondary btn-icon" data-bs-dismiss="modal"
                                aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m6.4 18.308l-.708-.708l5.6-5.6l-5.6-5.6l.708-.708l5.6 5.6l5.6-5.6l.708.708l-5.6 5.6l5.6 5.6l-.708.708l-5.6-5.6z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="camera_content" id="cameraView">
                        <div class="camera_body">
                            <video id="cameraStream" autoplay playsinline></video>
                        </div>
                        <div class="camera_footer">
                            <div class="btn btn-ghost-secondary btn-icon"></div>
                            <button id="captureButton" class="btn btn-ghost-primary btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                    <circle cx="16" cy="16" r="10" fill="currentColor" />
                                    <path fill="currentColor"
                                        d="M16 30a14 14 0 1 1 14-14a14.016 14.016 0 0 1-14 14m0-26a12 12 0 1 0 12 12A12.014 12.014 0 0 0 16 4" />
                                </svg>
                            </button>
                            <button id="switchCameraButton" class="btn  btn-ghost-secondary btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M13.685 5.25h.03a.75.75 0 0 1 0 1.5c-1.292 0-2.275 0-3.058.063c-.785.063-1.283.183-1.636.371a3.94 3.94 0 0 0-1.677 1.764c-.19.394-.304.88-.363 1.638c-.06.764-.06 1.738-.06 3.094v.11l1.12-1.12a.75.75 0 0 1 1.06 1.06l-2.4 2.4a.75.75 0 0 1-1.086-.027l-2.171-2.4a.75.75 0 0 1 1.112-1.006l.865.956v-.005c0-1.317 0-2.35.065-3.179c.066-.844.202-1.542.509-2.176a5.44 5.44 0 0 1 2.319-2.431c.625-.335 1.37-.476 2.224-.544c.85-.068 1.891-.068 3.147-.068m4.162 2.4a.75.75 0 0 1 .538.247l2.171 2.4a.75.75 0 0 1-1.112 1.006l-.865-.956v.005c0 1.317 0 2.35-.065 3.179c-.066.844-.201 1.542-.509 2.176a5.44 5.44 0 0 1-2.319 2.431c-.625.335-1.37.476-2.224.544c-.85.068-1.891.068-3.146.068h-.03a.75.75 0 0 1 0-1.5c1.291 0 2.274 0 3.057-.063c.785-.063 1.283-.183 1.636-.372a3.94 3.94 0 0 0 1.677-1.763c.19-.394.304-.88.363-1.638c.06-.764.06-1.738.06-3.094v-.11l-1.12 1.12a.75.75 0 0 1-1.06-1.06l2.4-2.4a.75.75 0 0 1 .548-.22" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="camera_content" id="previewContainer">
                        <div class="camera_body">
                            <img id="previewImage" style="width: 100%;  object-fit:cover;" />
                        </div>
                        <div class="camera_footer">
                            <button id="retakeButton" class="btn  btn-ghost-secondary btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
                                    <path fill="currentColor"
                                        d="M13.5 6.5V7h5v-.5a2.5 2.5 0 0 0-5 0m-2 .5v-.5a4.5 4.5 0 1 1 9 0V7H28a1 1 0 1 1 0 2h-1.508L24.6 25.568A5 5 0 0 1 19.63 30h-7.26a5 5 0 0 1-4.97-4.432L5.508 9H4a1 1 0 0 1 0-2zM9.388 25.34a3 3 0 0 0 2.98 2.66h7.263a3 3 0 0 0 2.98-2.66L24.48 9H7.521zM13 12.5a1 1 0 0 1 1 1v10a1 1 0 1 1-2 0v-10a1 1 0 0 1 1-1m7 1a1 1 0 1 0-2 0v10a1 1 0 1 0 2 0z" />
                                </svg>
                            </button>
                            <button id="sendImageButton" onclick="uploadImage()"
                                class="btn  btn-ghost-primary btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5" color="currentColor">
                                        <circle cx="7.5" cy="7.5" r="1.5" />
                                        <path
                                            d="M2.5 12c0-4.478 0-6.718 1.391-8.109S7.521 2.5 12 2.5c4.478 0 6.718 0 8.109 1.391S21.5 7.521 21.5 12c0 4.478 0 6.718-1.391 8.109S16.479 21.5 12 21.5c-4.478 0-6.718 0-8.109-1.391S2.5 16.479 2.5 12" />
                                        <path d="M5 21c4.372-5.225 9.274-12.116 16.498-7.458" />
                                    </g>
                                </svg>
                            </button>
                            <div class="btn btn-ghost-secondary btn-icon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="note-sidebar" id="note_sheet">

            <div class="note-header">
                <h5 class="mb-0">Notes</h5>
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
            <div id="notes-container"></div>
            <div class="space-y-2 scrollable h-100 py-2 px-1" id="notes_body"></div>
            <div class="note-footer">
            <div class="audio-box" id="audio_box">
                    <div class="visualizer">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <button id="audio_send" class="stop">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round">
                                    <path d="M14.5 8a6.5 6.5 0 1 1-13 0a6.5 6.5 0 0 1 13 0Z" />
                                    <path d="M6 6h4v4H6z" />
                                </g>
                            </svg>
                        </button>
                        <button id="audio_stop" class="send">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20.33 3.67a1.45 1.45 0 0 0-1.47-.35L4.23 8.2A1.44 1.44 0 0 0 4 10.85l6.07 3l3 6.09a1.44 1.44 0 0 0 1.29.79h.1a1.43 1.43 0 0 0 1.26-1l4.95-14.59a1.41 1.41 0 0 0-.34-1.47M4.85 9.58l12.77-4.26l-7.09 7.09Zm9.58 9.57l-2.84-5.68l7.09-7.09Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <input type="text" autocomplete="off" placeholder="Write your message" id="TextNotes" />
                <span class="custom-btn">
                    <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(event)"
                        multiple />
                    <a href="#" onclick="open_file_select()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Please Select file to upload">
                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.879 6.37503L5.39297 11.861C4.56697 12.687 4.56697 14.027 5.39297 14.853V14.853C6.21897 15.679 7.55897 15.679 8.38497 14.853L15.617 7.62103C17.132 6.10603 17.132 3.65003 15.617 2.13503V2.13503C14.102 0.620029 11.646 0.620029 10.131 2.13503L2.89897 9.36703C0.694972 11.571 0.694972 15.143 2.89897 17.347V17.347C5.10297 19.551 8.67497 19.551 10.879 17.347L15.268 12.958"
                                stroke="#000E08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </span>
                <span class="custom-btn">
                    <input type="file" id="fileInput" style="display: none;" onchange="click_image(event)" multiple />
                    <a href="#" onclick="click_image()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Capture Photo">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 4V4.75C6.25076 4.75 6.48494 4.62467 6.62404 4.41603L6 4ZM7.40627 1.8906L6.78223 1.47457V1.47457L7.40627 1.8906ZM14.5937 1.8906L15.2178 1.47457L14.5937 1.8906ZM16 4L15.376 4.41603C15.5151 4.62467 15.7492 4.75 16 4.75V4ZM13.25 11.5C13.25 12.7426 12.2426 13.75 11 13.75V15.25C13.0711 15.25 14.75 13.5711 14.75 11.5H13.25ZM11 13.75C9.75736 13.75 8.75 12.7426 8.75 11.5H7.25C7.25 13.5711 8.92893 15.25 11 15.25V13.75ZM8.75 11.5C8.75 10.2574 9.75736 9.25 11 9.25V7.75C8.92893 7.75 7.25 9.42893 7.25 11.5H8.75ZM11 9.25C12.2426 9.25 13.25 10.2574 13.25 11.5H14.75C14.75 9.42893 13.0711 7.75 11 7.75V9.25ZM6.62404 4.41603L8.0303 2.30662L6.78223 1.47457L5.37596 3.58397L6.62404 4.41603ZM9.07037 1.75H12.9296V0.25H9.07037V1.75ZM13.9697 2.30662L15.376 4.41603L16.624 3.58397L15.2178 1.47457L13.9697 2.30662ZM12.9296 1.75C13.3476 1.75 13.7379 1.95888 13.9697 2.30662L15.2178 1.47457C14.7077 0.709528 13.8491 0.25 12.9296 0.25V1.75ZM8.0303 2.30662C8.26214 1.95888 8.65243 1.75 9.07037 1.75V0.25C8.1509 0.25 7.29226 0.709528 6.78223 1.47457L8.0303 2.30662ZM20.25 8V15H21.75V8H20.25ZM17 18.25H5V19.75H17V18.25ZM1.75 15V8H0.25V15H1.75ZM5 18.25C3.20507 18.25 1.75 16.7949 1.75 15H0.25C0.25 17.6234 2.37665 19.75 5 19.75V18.25ZM20.25 15C20.25 16.7949 18.7949 18.25 17 18.25V19.75C19.6234 19.75 21.75 17.6234 21.75 15H20.25ZM17 4.75C18.7949 4.75 20.25 6.20507 20.25 8H21.75C21.75 5.37665 19.6234 3.25 17 3.25V4.75ZM5 3.25C2.37665 3.25 0.25 5.37665 0.25 8H1.75C1.75 6.20507 3.20507 4.75 5 4.75V3.25ZM5 4.75H6V3.25H5V4.75ZM17 3.25H16V4.75H17V3.25Z"
                                fill="#000E08" />
                        </svg>
                    </a>
                </span>
                <span class="custom-btn position-relative">
                    <input type="file" id="fileInput" style="display: none;" onchange="record_audio()" multiple />
                    <!-- onclick="record_audio()" -->
                    <div id="startRec" data-bs-toggle="tooltip" aria-label="Please Select file to upload"
                        data-bs-original-title="Record Audio">
                        <svg width="16" height="22" viewBox="0 0 16 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 10V11C15 14.866 11.866 18 8 18M1 10V11C1 14.866 4.13401 18 8 18M8 18V21M8 21H11M8 21H5M8 15C5.79086 15 4 13.2091 4 11V5C4 2.79086 5.79086 1 8 1C10.2091 1 12 2.79086 12 5V11C12 13.2091 10.2091 15 8 15Z"
                                stroke="#000E08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </span>
                <button class="note-submit-btn" id="SendNotes">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4.43013 2.72003L15.3787 8.19293C15.6845 8.34573 15.8777 8.65821 15.8777 9.00004C15.8777 9.34187 15.6845 9.65435 15.3787 9.80715L4.43013 15.28C4.11287 15.4387 3.73208 15.3968 3.4569 15.173C3.18171 14.9492 3.06316 14.5849 3.15391 14.2419L4.54235 9.00004L3.15391 3.75813C3.06316 3.41521 3.18171 3.05093 3.4569 2.82709C3.73208 2.60325 4.11287 2.56136 4.43013 2.72003Z"
                            fill="white" />
                        <path d="M8.66223 9.0001H4.54236" stroke="#842b25" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Drop zone code -->
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {

        const dropzone = $("#dropzone-multiple");
        const inputFile = $("#item_image_id");

        dropzone[0].addEventListener("dragover", function (e) {
            e.preventDefault();
            dropzone[0].classList.add("dragover");
        });

        dropzone[0].addEventListener("dragleave", function () {
            dropzone[0].classList.remove("dragover");
        });

        dropzone[0].addEventListener("drop", function (e) {
            e.preventDefault();
            dropzone[0].classList.remove("dragover");
            handleFiles(e.dataTransfer.files);
            addFilesToInput(e.dataTransfer.files);
        });

        inputFile[0].addEventListener("change", function () {
            handleFiles(inputFile[0].files);
        });

        function handleFiles(files) {
            $('.dz-default').hide();
            const fileArray = Array.from(files);

            fileArray.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imageSrc = e.target.result;
                    const col = document.createElement("div");
                    col.classList.add("dz-preview", "dz-processing", "dz-error", "dz-complete", "dz-image-preview");
                    const fileName = file.name.length > 15 ? file.name.slice(0, 15) + "..." : file.name;

                    const selectedFile = `

                        <div class="dz-image">
                            <img data-dz-thumbnail src="${imageSrc}" alt="${fileName}" />
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="removeImage(this,${index})"><i class="bi bi-x"></i></button>
                        </div>

                        `;

                    col.innerHTML = selectedFile;
                    dropzone[0].appendChild(col);
                };

                reader.readAsDataURL(file);
            });
        }

        function addFilesToInput(droppedFiles) {
            const input = document.getElementById("item_image_id");
            const currentFiles = Array.from(input.files);
            const dataTransfer = new DataTransfer();

            currentFiles.forEach(file => dataTransfer.items.add(file));
            Array.from(droppedFiles).forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

    });


    function removeImage(button, index) {
        const dropzone = document.getElementById("dropzone-multiple");
        const fileElement = button.closest(".dz-preview");
        dropzone.removeChild(fileElement);

        const input = document.getElementById("item_image_id");
        const files = Array.from(input.files);
        const updatedFiles = files.filter((_, i) => i !== index);
        const dataTransfer = new DataTransfer();
        updatedFiles.forEach((file) => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
        if (input.files.length === 0) {
            $('.dz-default').show();
        }
    }
</script>
<script>


    $(document).ready(function () {
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });
    });

    let notesList = [];

    function cancel_save() {
        location.href = "{{route('order-master')}}";
    }
    $(document).ready(function () {
        // default selected date
        // const today = new Date();
        // const day = String(today.getDate()).padStart(2, '0');
        // const month = String(today.getMonth() + 1).padStart(2, '0'); // getMonth() is zero-based
        // const year = today.getFullYear();
        // const formattedDate = `${day}-${month}-${year}`;
        // console.log(formattedDate);
        // document.getElementById('order_date').value = formattedDate;

        $(function () {
            $("#order_date").
                datepicker({
                    dateFormat: 'dd-mm-yy'
                });

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();

            today = dd + '-' + mm + '-' + yyyy;
            $("#order_date").datepicker("setDate", today);
        });

        const orderType = "{{ $type  ?: 'order' }}"; 
        const paymentDiv = $('#payment');

        if (orderType === 'order') {
            paymentDiv.removeClass('d-none');
        } else {
            paymentDiv.addClass('d-none');
        }

        $('#order_type').on('change', function () {
            console.log(this.value);
            const paymentDiv = $('#payment');
            const formTitle = $('#form_title'); 
            if (this.value == 'order') {
                formTitle.text('Order Form');
                paymentDiv.removeClass('d-none');
            } else {
                formTitle.text('Repairing Form');
                paymentDiv.addClass('d-none');
            }
        });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#saveBranchBtn').click(function (e) {

            e.preventDefault();
            var orderDate = $('#order_date').val();
            var orderNumber = $('#order_number').val();
            var orderQRCode = $('#qr_code_number').val();
            var orderType = $('#order_type').val();
            var orderFrom = $('#searchableSelectFrom').val();
            var orderTo = $('#searchableSelectTo').val();
            var cust = $('#searchableCust').val();
            var item_color = $('#item_colors').val();
            var item_metal = $('#item_metal').val();
            var item_name = $('#item_name').val();
            var item_melting = $('#item_melting').val();
            var item_weight = $('#item_weight').val();
            var payment_advance = $('#payment_advance').val();
            var payment_booking = $('#payment_booking').val();
            var temp_order_id   = $('#temp_order_id').val();
            var itemImages = $('#item_image_id')[0].files;
            console.log("ItemImages: " + itemImages, itemImages.length)
            var formattedOrderDate = formatDate(orderDate);
            if (orderType == "reparing") {
                orderType = 2;
            } else {
                orderType = 1;
            }
            if (orderDate && orderType && orderFrom && orderTo) {
                var formData = new FormData();
                formData.append('_token', csrfToken);  // Add CSRF token
                formData.append('order_date', orderDate);
                formData.append('order_type', orderType);
                formData.append('order_from_branch_id', orderFrom);
                formData.append('order_to_branch_id', orderTo);
                formData.append('order_user_id', cust);
                formData.append('item_metal', item_metal);
                formData.append('item_name', item_name);
                formData.append('order_number', orderNumber);
                formData.append('qr_code_number', orderQRCode);
                formData.append('order_notes', notesList);
                formData.append('item_color', item_color);
                formData.append('temp_order_id',temp_order_id);

                if (payment_advance) {

                    formData.append('payment_advance', payment_advance);
                } else {
                    formData.append('payment_advance', '');
                }
                if (payment_booking) {

                    formData.append('payment_booking', payment_booking);
                } else {
                    formData.append('payment_booking', '');
                }

                formData.append('item_melting', item_melting);
                formData.append('item_weight', item_weight);

                var custName = userInput;
                var custAddress = $('#customer_address').val();
                var remarks = $('#order_remarks').val();
                var custPhone = $('#cust_phone_no').val();
                var custNew = $('#customer_new').val();
                formData.append('customer_name', custName);
                formData.append('customer_address', custAddress);
                formData.append('customer_phone_number', custPhone);
                formData.append('customer_new', custNew);
                formData.append('order_remark', remarks);

                // Append files to FormData
                for (var i = 0; i < itemImages.length; i++) {
                    console.log("Looping", itemImages[i]);
                    formData.append('item_file_images[]', itemImages[i]);
                }
                $.ajax({
                    url: "{{ route('order-add') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 200) {
                            $('#branch_table').DataTable().ajax.reload();  // Reload table

                            showOrderAlert('success', response.message);

                            $('#order_date').val('');
                            $('#order_type').val('');
                            $('#searchableSelectFrom').val('');
                            $('#searchableSelectTo').val('');
                            $('#item_metal').val('');
                            $('#item_name').val('');
                            $('#item_melting').val('');
                            $('#item_weight').val('');
                            $('#item_image_id').val('');
                            $('#order_number').val('');
                            $('#qr_code_number').val('');
                            $('#customer_new').val('');
                            setTimeout(function () {
                                location.href = "{{ route('order-master') }}";
                            }, 1000);
                        } else {

                            showOrderAlert('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // alert('An error occurred: ' + error);
                        showOrderAlert('warning', error);
                    }
                });
            } else {


                showOrderAlert('warning', 'Please fill in all fields orderDate, orderType and Order To');
            }
        });



    });


    // Upload Images and show the preview

    // function previewSelectedImages() {
    //     const input = document.getElementById("item_image_id");
    //     const uploadedImages = document.getElementById("dropzone-multiple");
    //     // uploadedImages.innerHTML = "";

    //     const files = Array.from(input.files);

    //     if (files.length === 0) {
    //         uploadedImages.innerHTML = "<p>No files selected.</p>";
    //         return;
    //     }

    //     files.forEach((file, index) => {
    //         const reader = new FileReader();

    //         reader.onload = function (e) {
    //             const imageSrc = e.target.result;
    //             const col = document.createElement("div");
    //             col.classList.add("col-sm-4");
    //             col.setAttribute("data-file-index", index);
    //             const maxFileNameLength = 15;
    //             const trimmedFileName =
    //                 file.name.length > maxFileNameLength
    //                     ? file.name.slice(0, maxFileNameLength) + "..."
    //                     : file.name;
    //             `<div class="dz-preview dz-image-preview">
    //                 <div class="dz-image">

    //                      <img data-dz-thumbnail src="${imageSrc}" alt="${trimmedFileName}"  />
    //                 </div>
    //             </div>
    //                 `
    //         //     const selectedFile = `
    //         //         <div class="selected-files">
    //         //             <div class="d-flex align-items-center gap-2">
    //         //                 <img src="${imageSrc}" alt="${trimmedFileName}" width="35px" />
    //         //                 <div>
    //         //                     <p>${trimmedFileName}</p>
    //         //                     <small>${(file.size / 1024).toFixed(1)} KB</small>
    //         //                 </div>
    //         //             </div>
    //         //             <button onclick="removeImage(this, ${index})">
    //         //                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    //         //                     <path
    //         //                         d="M12.59 6L10 8.59L7.41 6L6 7.41L8.59 10L6 12.59L7.41 14L10 11.41L12.59 14L14 12.59L11.41 10L14 7.41L12.59 6ZM10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z"
    //         //                         fill="#858585"
    //         //                     />
    //         //                 </svg>
    //         //             </button>
    //         //         </div>
    //         //     `;

    //         //     col.innerHTML = selectedFile;
    //         //     uploadedImages.appendChild(col);
    //         };

    //         reader.readAsDataURL(file);
    //     });
    // }




    var userInput = '';
    // $('#searchableSelectTo').on('select2:selecting', function (e) {

    //     userInput = e.params.args.data.text;

    //     console.log("New/custom input: " + userInput);
    // });

    $(document).ready(function () {

        $('#searchableSelectTo').on('select2:open', function () {
            $('.select2-search__field').on('input', function () {
                userInput = $(this).val();
            });
        });
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#searchableSelectTo').select2({

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



        // $('#searchableCust').on('select2:open', function() {
        //         $('.select2-search__field').on('input', function() {
        //             userInput = $(this).val();
        //         });
        //     });
        //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
        //     $('#searchableCust').select2({

        //         placeholder: "Select an option",

        //         allowClear: true,
        //         ajax: {
        //             url: "{{route('customer_list')}}",
        //         dataType: 'json',
        //         type: 'POST',
        //         headers: {
        //                 'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
        //         },
        //         delay: 250,
        //         data: function (params) {
        //             return {

        //                 search: params.term,
        //                 per_page: 10,
        //                 page: params.page || 1
        //             };
        //         },
        //         processResults: function (data) {

        //             return {
        //                 results: data.data.cust.map(function (item) {
        //                     return {
        //                         id: item.cust_id,
        //                         text: item.cust_name
        //                     };
        //                 }),
        //                 pagination: {
        //                     more: data.data.length >= 10 // Check if there are more results
        //                 }
        //             };
        //         },
        //         cache: true
        //     },

        // });

        // $('#searchableCust').on('select2:open', function() {
        //     $('.select2-search__field').on('input', function() {
        //         userInput = $(this).val();
        //     });
        // });
        $(document).ready(function () {

            $('#searchableCust').on('select2:open', function () {
                $('.select2-search__field').on('input', function () {
                    userInput = $(this).val();
                });
            });

            $('#searchableCust').on('select2:select', function (e) {
                console.log("Event triggered", e.params.data);
                if (e.params.data.newOption) {
                    console.log("New customer added");
                    $('#cust_div').removeClass('d-none');
                    $('#order_customer_name').val(e.params.data.newOption);

                } else {
                    $('#cust_div').addClass('d-none');
                }


            });

            $(document).on('mouseup', '.select2-add-new', function (e) {
                console.log("Direct click on add new option");
                $('#cust_div').removeClass('d-none');
                e.preventDefault();
                e.stopPropagation();
            })
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#searchableCust').select2({
                placeholder: "Search or add a customer",
                allowClear: true,
                tags: true, // Enable adding new tags
                ajax: {
                    url: "{{route('customer_list')}}", // Backend route for fetching customers
                    dataType: 'json',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // CSRF token for security
                    },
                    delay: 250, // Debounce for better performance
                    data: function (params) {
                        return {
                            search: params.term, // User input for search
                            per_page: 10, // Number of results per page
                            page: params.page || 1 // Current page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.data.cust.map(function (item) {
                                return {
                                    id: item.cust_id,
                                    text: item.cust_name
                                };
                            }),
                            pagination: {
                                more: data.data.length >= 10 // Check if there are more results
                            }
                        };
                    },
                    cache: true
                },
                createTag: function (params) {
                    // Allow adding new customer only if input is non-empty
                    if ($.trim(params.term) === '') {
                        return null;
                    }
                    return {
                        id: 'new:' + params.term, // Mark it as a new option
                        text: params.term,
                        newOption: true
                    };
                },
                templateResult: function (data) {
                    // Highlight the "Add new customer" option
                    if (data.newOption) {
                        // return $('<span><em>Click Here to Create New": ' + data.text + '"</em></span>');
                        return $('<div class="select2-add-new">' +
                            '<span class="add-new-text">Click Here to Create New: "' + data.text + '"</span>' +
                            '</div>');
                    }
                    return data.text;
                },
                templateSelection: function (data) {
                    // Display the selected item properly

                    // if (data.newOption) {
                    //     $('#cust_div').removeClass('d-none');
                    // }else{
                    //     $('#cust_div').addClass('d-none');
                    // }
                    $('#customer_new').val('true');
                    $('#order_customer_name').val(data.text);

                    return data.text;
                }
            })
            // $('#searchableCust').on('select2:select', function (e) {
            //     console.log("Event triggered:", e.params.data);

            //     // Check if the selected option is a new customer
            //     if (e.params.data.newOption) {
            //         console.log("New customer selected");
            //         $('#cust_div').removeClass('d-none'); // Remove the 'd-none' class
            //     } else {
            //         console.log("Existing customer selected");
            //         $('#cust_div').addClass('d-none'); // Add the 'd-none' class
            //     }
            // });
        });



        $('#saveCustBtn').click(function (e) {
            e.preventDefault();
            var custName = userInput;
            var custAddress = $('#customer_address').val();
            var custPhone = $('#cust_phone_no').val();

            // var branchId = $('#branch_id').val();
            console.log("Customer Info", custAddress, custName);
            if (custName && custPhone) {
                $.ajax({
                    url: "{{ route('add_edit_cust') }}",  // Adjust the route as needed
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        customer_name: custName,
                        customer_address: custAddress,
                        customer_phone_no: custPhone,
                        customer_id: null,
                    },
                    success: function (response) {
                        // Handle success

                        if (response.status == 200) {
                            console.log("Resposne of cust", response.data);
                            UserInput = '';
                            $('#customer_address').val();
                            $('#cust_phone_no').val();

                            var newOption = new Option(response.data.cust_name, response.data.cust_id, true, true);
                            $('#searchableCust').append(newOption).trigger('change');
                            $('#searchableCust').val(response.data.cust_id).trigger('change');

                            showOrderAlert('success', response.message);
                            // alert(response.message);

                        } else {
                            // alert('Error creating branch: ' + response.message);
                            showOrderAlert('warning', response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // alert('An error occurred: ' + error);
                        showOrderAlert('warning', error);
                    }
                });
            } else {
                // alert('Please fill in both fields.');
                showOrderAlert('warining', 'Please fill in both fields, Name and address');
            }
        });
    });

    function formatDate(date) {
        var d = new Date(date);
        var year = d.getFullYear();
        var month = ('0' + (d.getMonth() + 1)).slice(-2);
        var day = ('0' + d.getDate()).slice(-2);
        return year + '-' + month + '-' + day;
    }


    function create_new_branch() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        console.log("Creating new branch", userInput);


        if (userInput) {
            $.ajax({
                url: "{{ route('add_edit_branch') }}",  // Adjust the route as needed
                type: 'POST',
                data: {
                    _token: csrfToken,
                    branch_name: userInput,
                    branch_id: '',
                    branch_address: userInput,
                },
                success: function (response) {
                    // Handle success

                    if (response.status == 200) {
                        alert(response.message);
                    } else {
                        alert('Error creating branch: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        } else {
            alert("Please enter a branch name")
        }
    }


    function showOrderAlert(type, message) {
        const alertContainer = document.getElementById('alert-container');
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

    function showAlertCust(type, message) {
        const alertContainer = document.getElementById('alert-container-cust');
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




    // Code for Notes

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
            const order_id = $('#order_id').val();
            const temp_order_id = $('#temp_order_id').val();
            
            console.log("Order ID: " + order_id);
            notesBody.html('');
            const scrollTopBeforeLoad = notesBody.scrollTop();

            $.ajax({
                url: "{{ route('notes_list') }}",
                type: 'POST',
                data: {
                    search: '',
                    per_page: 8,
                    page: page,
                    order_id: order_id,
                    temp_order_id: temp_order_id
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
                            console.log(note);
                            if (note.notes_type == 1) {
                                notesBody.append(`
                                    <div class="my-note-box">
                                        <div class="chat-bubble-title"></div>
                                        <div class="chat-bubble-body">
                                            <p>${note.notes_text}.</p>
                                        </div>
                                    </div>`);
                            }
                            else if (note.notes_type == 3) {
                                notesBody.append(`
                                        <div class="my-note-box">
                                            <div class="chat-bubble-title">Audio Note</div>
                                            <div class="chat-bubble-body">
                                                <audio controls>
                                                    <source src="${note.file.file_url}" type="audio/webm">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        </div>
                                    `);
                            }
                            else {
                                if (note.file.file_type == 'pdf') {
                                    notesBody.append(`
                                        <div class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <embed src="${note.file.file_url}" width="100%" height="auto" />
                                        </div>`);
                                } else {
                                    notesBody.append(`
                                       <a href="${note.file.file_url}" data-title="${note.file.file_original_name}" data-lightbox="gallery" class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <img src="${note.file.file_url}" alt="" class="rounded img-fluid" />
                                        </a>`);
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
                                        <a href="${note.file.file_url}" data-title="${note.file.file_original_name}" data-lightbox="gallery" class="my-note-box w-75">
                                            <p class="small text-decoration-underline">${note.file.file_original_name}</p>
                                            <img src="${note.file.file_url}" alt="" class="rounded img-fluid" />
                                        </a>` + newNotes;
                                }
                            }
                        });
                        notesBody.prepend(newNotes);
                    }

                    // page++;

                    // Scroll position handling after load
                    // if (isScrollUp) {
                    //     notesBody.scrollTop(notesBody[0].scrollHeight - firstNoteOffset);
                    // } else {
                    //     notesBody.scrollTop(notesBody[0].scrollHeight);
                    // }

                    isLoading = false;
                }
            });
        }

        // Initial load (start from the bottom)
        loadNotes();

        // Handle scroll event
        // function handleScroll() {
        //     const notesBox = document.getElementById("notes_body");
        //     if (!notesBox) return;

        //     const { scrollTop, scrollHeight, clientHeight } = notesBox;

        //     if (scrollTop + clientHeight >= scrollHeight - 5) {
        //         // Load more notes at the bottom
        //         loadNotes();
        //     } else if (scrollTop === 0) {
        //         // Load older notes when scrolling up
        //         loadNotes(true);
        //     }
        // }

        // // Attach scroll event
        // setTimeout(function () {
        //     const notesBox = document.getElementById("notes_body");
        //     if (notesBox) {
        //         notesBox.addEventListener("scroll", handleScroll);
        //     }
        // }, 500);


        $(document).ready(function () {
            // Handle file upload

            // Handle new text note submission
            $("#TextNotes").on("keydown", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    const text = event.target.value.trim();
                    const order_id = $('#temp_order_id').val();
                    if (text) {
                        $.ajax({
                            url: "{{ route('notes_add') }}",
                            type: 'POST',
                            data: {
                                'notes_text': text,
                                'notes_file': null,
                                'temp_order_id': order_id,
                                'notes_type': 1

                            },
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            success: function (response) {
                                showAlertNotes('success', response.message);
                                notesList.push(response.data);
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

            $("#SendNotes").on("click", function () {
                const text = $("#TextNotes").val().trim();
                const order_id = $('#temp_order_id').val();
                if (text) {
                    $.ajax({
                        url: "{{ route('notes_add') }}",
                        type: 'POST',
                        data: {
                            'notes_text': text,
                            'notes_file': null,
                            'temp_order_id': order_id,
                            'notes_type': 1
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function (response) {
                            showAlertNotes('success', response.message);
                            notesList.push(response.data);
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

            });
        });
    });

    function open_file_select() {
        $("#fileInput").click();
    }


    let cameraStream = null;
    let capturedImage = null;
    let useFrontCamera = true;
    function click_image() {
        startCamera();
        $('#click_image').modal('show');
        $('#cameraView').show();
        $('#previewContainer').hide();
        $('#sendImageButton').hide();

    }

    function startCamera() {
        const constraints = {
            video: {
                facingMode: useFrontCamera ? 'user' : 'environment',
            },
        };

        navigator.mediaDevices
            .getUserMedia(constraints)
            .then((stream) => {
                cameraStream = stream;
                const videoElement = $('#cameraStream')[0];
                videoElement.srcObject = stream;
            })
            .catch((error) => {
                alert('Unable to access the camera. Please check permissions.');
                console.error(error);
            });
    }


    function stopCamera() {
        if (cameraStream) {
            cameraStream.getTracks().forEach((track) => track.stop());
            cameraStream = null;
        }
    }

    $('#captureButton').on('click', function () {
        const videoElement = $('#cameraStream')[0];
        const canvas = document.createElement('canvas');
        canvas.width = videoElement.videoWidth;
        canvas.height = videoElement.videoHeight;

        const context = canvas.getContext('2d');
        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

        capturedImage = canvas.toDataURL('image/png');

        $('#previewImage').attr('src', capturedImage);
        $('#cameraView').hide();
        $('#previewContainer').show();
        $('#sendImageButton').show();

        stopCamera(); // Stop the camera to save resources
    })

    // Retake image
    $('#retakeButton').on('click', function () {
        $('#cameraView').show();
        $('#previewContainer').hide();
        $('#sendImageButton').hide();
        startCamera(); // Restart the camera
    });

    // Switch camera
    $('#switchCameraButton').on('click', function () {
        useFrontCamera = !useFrontCamera; // Toggle between front and rear camera
        stopCamera();
        startCamera();
    });

    function dataURLToFile(dataUrl, filename) {
        const arr = dataUrl.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, { type: mime });
    }

    // Upload image
    function uploadImage() {
        if (!capturedImage) {
            alert('No image captured!');
            return;
        }
        const orderId = $('#temp_order_id').val();
        const formData = new FormData();
        const imageFile = dataURLToFile(capturedImage, 'captured-image.png');


        formData.append('notes_text', '');
        formData.append('notes_file[]', imageFile);
        formData.append('notes_type', 4);
        formData.append('temp_order_id', orderId);

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
                console.log('Audio uploaded successfully:', response);
                notesList.push(response.data);
                $('#click_image').modal('hide');
                showAlertNotes('success', 'Image file uploaded successfully!');
                isLoading = false;
                loadNotes();
            },
            error: function (error) {
                console.error('Image upload failed:', error);
            }
        });
    }

    // Stop the camera when the modal is closed
    $('[data-bs-dismiss="modal"]').on('click', stopCamera);

    const recordButton = document.getElementById("startRec");
    const recordStopButton = document.getElementById("audio_stop");
    const recordSendutton = document.getElementById("audio_send");
    let isRecording = false;
    let recorder, audio_stream, audioBlob;



    // Start recording
    const startRecord = () => {
        if (!isRecording) {
            isRecording = true;
            console.log("Recording started...");
            $('#audio_box').css("display", "flex");
            // Add logic to start recording audio here
            startRecording()
        }
    };

    // Stop recording and send
    const stopRecord = () => {
        if (isRecording) {
            isRecording = false;
            console.log("Recording stopped. Sending audio...");
            // Add logic to stop recording and send audio here
            $('#audio_box').css("display", "none");
            stopRecording();
        }
    };



    // Add event listeners
    recordButton.addEventListener("mousedown", startRecord);
    recordStopButton.addEventListener("mousedown", stopRecord);
    // recordStopButton.addEventListener("mousedown", uploadRecording);
    recordSendButton.addEventListener("click", stopRecord);

    // For touch devices
    recordButton.addEventListener("touchstart", (e) => {
        e.preventDefault();
        startRecording();
    });
    recordStopButton.addEventListener("touchend", (e) => {
        e.preventDefault();
        stopRecording();
    });

    // Audio recording
   
    const sendButton = $('#audio_stop');
    $('#audio_stop').on('click', uploadRecording);
   

    function startRecording() {
      

        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(function (stream) {
                audio_stream = stream;
                recorder = new MediaRecorder(stream);
                let audioChunks = [];
                // when there is data, compile into object for preview src
                recorder.ondataavailable = function (e) {
                    audioChunks.push(e.data);

                };

                recorder.onstop = function () {
                    // Create an audio blob
                    audioBlob = new Blob(audioChunks, { type: "audio/wav" });
                    console.log("Audio Blob Created:", audioBlob);
                    console.log("Audio Blob Size:", audioBlob.size);


                    if (audioBlob.size === 0) {
                        alert("Audio blob is empty! Recording may have failed.");
                        return;
                    }
                    // Create a URL for the blob and set it as the audio playback source
                    const url = URL.createObjectURL(audioBlob);
                    var preview = document.getElementById('audio-playback');
                    preview.src = url;

                    // Unhide the audio playback element
                    $("#audioPlaybackContainer").removeClass("d-none");

                    preview.load();
                    console.log("Audio recording ready for playback.");
                    if (audioBlob.size > 0) {
                        sendButton.audioBlob = audioBlob; 
                        uploadRecording();
                        console.log("Audio Blob assigned to sendButton:", sendButton.audioBlob);
                    } else {
                        console.error("Audio Blob is empty. Recording may have failed.");
                    }
                };

                recorder.start();

                timeout_status = setTimeout(function () {
                    console.log("5 min timeout");
                    stopRecording();
                }, 300000);
            });
    }

    function stopRecording() {
        audioBlob = null;
        audio_stream = null;
        if (recorder) {
            recorder.stop();
            audio_stream.getAudioTracks()[0].stop();
        }
        recorder = null;
        $('#audio_box').css("display", "none");

    //     // Reset audio variables
    }

  

    function uploadRecording() {
      
       console.log("Send Button Blob:", sendButton.audioBlob);

        if (!sendButton.audioBlob) {
            alert("No audio file available for upload!");
            return;
        }
        const orderId = $('#temp_order_id').val();
        const audioFile = new File([sendButton.audioBlob], 'recording.wav', { type: 'audio/wav' });

        const formData = new FormData();
        formData.append('notes_text', '');
        formData.append('notes_file[]', audioFile);
        formData.append('notes_type', 3);
        formData.append('temp_order_id', orderId);
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
                console.log('Audio uploaded successfully:', response);
                notesList.push(response.data);
                if (response.status == 200) {

                    showAlertNotes('success', 'Audio file uploaded successfully!');
                } else {
                    showAlertNotes('warning', response.message);
                }
                $('#audio_box').css("display", "none");
                if (recorder) {
                    recorder.stop();
                    audio_stream.getAudioTracks()[0].stop();
                }
                $('#audio_box').css("display", "none");

                // Reset audio variables
                audioBlob = null;
                audio_stream = null;
                recorder = null;

                $('#record_audio').modal('hide');
                isLoading = false;
                page = 1;
                loadNotes();
            },
            error: function (error) {
                console.error('Audio upload failed:', error);
            }
        });
    }



    function handleFileUpload(event) {
        const orderId = $('#temp_order_id').val();
     
        const file = event.target.files;
        if (file) {
            const formData = new FormData();
            formData.append('notes_text', '');
            for (var i = 0; i < file.length; i++) {
                formData.append('notes_file[]', file[i]);
                formData.append('notes_type', 2);
                
            }
            formData.append('notes_order_id', '');
            formData.append('temp_order_id',orderId);
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
                    notesList.push(response.data);
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
@endsection
