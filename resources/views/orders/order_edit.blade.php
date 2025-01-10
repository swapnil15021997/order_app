@extends('app')

@section('content')
<!-- Page header -->

<div class="container-xl">
    <div class="order-from-page">
        <div class="w-full">
            <div>
                <div class="page-body">
                    <div class="d-flex flex-column gap-3">
                        <div id="alert-container"></div>
                        <div id="alert-site"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <img src="{{ asset('static/logo_order.png')}}" alt="Tabler" class="img-fluid "
                                    width="80px" height="40px" />
                                    <p class="mb-0 mt-1">{{$login['name']}} <br /> +91 {{$login['user_phone_number']}} </p>
                            </div>
                            <div>
                            @php
                                $lastTransaction = end($order['transactions']); // Get the last transaction
                            @endphp
                            <div class="btn-list">
                                @if ($lastTransaction && $lastTransaction['trans_status'] === 0)
                                    <!-- If both conditions are satisfied, show the "Approve" button -->

                                    <button class="btn"  onclick="approve_order({{ $order['order_qr_code'] }})">
                                        Approve Order
                                    </button>
                                @else
                                    <button class="btn "  onclick="transfer_order({{$order['order_id']}})">
                                        Transfer Order
                                    </button>
                                @endif
                            </div>

                            </div>
                            {{$qr_code}}

                            <!-- <img src="{{ asset('static/qr_code.png')}}" alt="Tabler" class="img-fluid" width="100px"> -->
                        </div>
                        <input type="hidden" name="" id="order_id" value="{{$order['order_id']}}" >
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <h2 class="font-bold">{{$order['order_number']}}</h2>
                                    <div class="col-6">
                                        <div class="col-12">
                                            <label for="order_date" class="form-label">Order Date
                                            <span style="color: red;">*</span>
                                            </label>
                                            <input type="text" id="edit_order_date"
                                                class="form-control" >
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="order_type" class="form-label">Order Type
                                                <span style="color: red;">*</span>
                                            </label>
                                            <select id="order_type" class="form-select" type="text">
                                                <option value="" disabled selected>Select type</option>
                                                <option value="order" {{ $order['order_type'] == 1 ? 'selected' : '' }}>Order</option>
                                                <option value="reparing" {{ $order['order_type'] == 2 ? 'selected' : '' }}>Reparing</option>

                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <input type="hidden" name="" id="customer_new"  value="false">

                                        <div class="col-12">
                                            <label class="form-label">Select Customer</label>
                                            <select id="searchableCust" class="form-select select2">
                                                @foreach ($customer as $branch)
                                                    <option value="{{ $branch['cust_id'] }}" @if ($branch['cust_id'] == $order['order_customer_id'])
                                                    selected @endif>{{ $branch['cust_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-none" id="cust_div">

                                            <div class="mt-4">
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
                                                <textarea type="text" placeholder="Enter Address"
                                                    id="customer_address" class="form-control" form></textarea>
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
                                    <div class="col-6">
                                        <label for="searchableSelectFrom" class="form-label">From
                                        <span style="color: red;">*</span>
                                        </label>

                                        <select id="edit_searchableSelectFrom" class="form-select" type="text">

                                            @foreach ($user_branch as $branch)

                                                <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $login['user_active_branch']) selected @endif>
                                                    {{ $branch['branch_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="edit_searchableSelectTo" class="form-label">To
                                        <span style="color: red;">*</span>
                                        </label>

                                        <select id="edit_searchableSelectTo" class="form-select w-100" type="text">

                                            @foreach ($branchesArray as $branch)
                                                <option value="{{ $branch['branch_id'] }}" @if ($branch['branch_id'] == $order['order_to_branch_id']) selected @endif>{{ $branch['branch_name'] }}
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
                                <div class="row">
                                    <div class="col-6">
                                        <label for="item_name" class="form-label">Name
                                        <span style="color: red;">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="item_name" placeholder="Select Item"
                                            value="{{$order['items'][0]['item_name']}}" />
                                    </div>
                                    <div class="col-6">
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
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
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
                                    <div class="col-4">
                                        <label for="item_weight" class="form-label">Weight
                                        <span style="color: red;">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="item_weight"
                                            name="example-text-input" value="{{$order['items'][0]['item_weight']}}"
                                            placeholder="Weight of item" />
                                    </div>
                                    <div class="col-4">
                                        <label for="item_colors" class="form-label">Colors</label>
                                        <select class="form-select" id="item_colors">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color['color_id'] }}"
                                                @if ($color['color_id'] == $order['items'][0]['item_color']) selected @endif>
                                                {{ $color['color_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <input type="file" class="form-control" id="item_image_id"
                                        onchange="previewSelectedImages()"
                                        multiple
                                        placeholder="Choose Images" />
                                    </div>
                                </div>
                                <div class="row mt-3" id="uploaded-images">
                                    @foreach($order['items'] as $file)
                                    @if(!empty($file['files']))

                                    @foreach($file['files'] as $file)
                                        <div class="col-4" id="file-{{ $file->file_id }}">
                                            <div class="selected-files">
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="{{ asset($file->file_url) }}"
                                                        alt="select image" width="35px" />
                                                    <div>
                                                    <p>{{ strlen($file->file_original_name) > 15 ? substr($file->file_original_name, 0, 15) . '...' : $file->file_original_name }}</p>
                                                    <small>{{ number_format($file->file_size / 1024, 1) }} KB</small>
                                                    </div>
                                                </div>
                                                <button onclick="removeFile({{ $file->file_id }}, {{$order['order_id']}})">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.59 6L10 8.59L7.41 6L6 7.41L8.59 10L6 12.59L7.41 14L10 11.41L12.59 14L14 12.59L11.41 10L14 7.41L12.59 6ZM10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z"
                                                            fill="#858585" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card" id="payment">
                            <div class="card-body">
                                <h4 class="h2">Payment Details</h4>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="payment_advance" class="form-label">Advance cash deposit</label>
                                        <input type="number" placeholder="Enter here" class="form-control"
                                            id="payment_advance"
                                            value="{{ optional($paymentArray)['payment_advance_cash'] }}"
                                            name="example-text-input">
                                    </div>
                                    <div class="col-6">
                                        <label for="payment_booking" class="form-label">Rate</label>
                                        <input type="number" class="form-control" id="payment_booking"
                                            value="{{ optional($paymentArray)['payment_booking_rate'] }}"
                                            placeholder="Enter here">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end align-items-end">
                                <a href="#" onclick="cancel_update()" class="btn btn-secondary me-2 d-flex justify-content-end align-items-end" >

                                    Cancel
                                </a>
                                    <a href="#" class="btn btn-primary d-flex justify-content-end align-items-end" id="updateOrderBtn">

                                        Save
                                    </a>
                                </div>
                            </div>
                        </div>
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
                                <select id="TransfersearchableSelectTo" class="form-select  w-100 " type="text">
                                    </select>
                                </div>
                            </div>
                    </div>


                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <a id="TransferOrderBtn" href="#" class="btn btn-primary">
                            Transfer This Order
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="record_audio" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Record Audio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <audio id="audio-playback"   controls ></audio>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <a id="resetButton" href="#" type="button" class="btn btn-primary">
                            Reset Audio
                        </a>
                        <a href="#" id="cancelButton" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
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

                    <div class="modal-header">
                        <h5 class="modal-title">Click Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="cameraView" style="display: none; text-align: center;">
                            <video id="cameraStream" autoplay playsinline style="width: 100%; max-height: 400px; border: 1px solid #ddd;"></video>
                            <button id="captureButton" class="btn btn-primary mt-3">Capture Image</button>
                            <button id="switchCameraButton" class="btn btn-secondary mt-3">Switch Camera</button>
                        </div>

                        <!-- Preview Area -->
                        <div id="previewContainer" style="display: none; text-align: center;">
                            <img id="previewImage" style="max-width: 100%; height: auto; border: 1px solid #ddd;" />
                            <div class="mt-3">
                                <button id="retakeButton" class="btn btn-secondary">Retake</button>
                                <a id="sendImageButton" onclick="uploadImage()" href="#" type="button" class="btn btn-primary">
                                    Save Image
                                </a>
                            </div>
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
                <input type="text"  autocomplete="off" placeholder="Write your message" id="TextNotes" />
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
                    <input type="file" id="fileInput" style="display: none;" onchange="click_image()"
                        multiple />
                    <a href="#" onclick="click_image()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Images File">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 4V4.75C6.25076 4.75 6.48494 4.62467 6.62404 4.41603L6 4ZM7.40627 1.8906L6.78223 1.47457V1.47457L7.40627 1.8906ZM14.5937 1.8906L15.2178 1.47457L14.5937 1.8906ZM16 4L15.376 4.41603C15.5151 4.62467 15.7492 4.75 16 4.75V4ZM13.25 11.5C13.25 12.7426 12.2426 13.75 11 13.75V15.25C13.0711 15.25 14.75 13.5711 14.75 11.5H13.25ZM11 13.75C9.75736 13.75 8.75 12.7426 8.75 11.5H7.25C7.25 13.5711 8.92893 15.25 11 15.25V13.75ZM8.75 11.5C8.75 10.2574 9.75736 9.25 11 9.25V7.75C8.92893 7.75 7.25 9.42893 7.25 11.5H8.75ZM11 9.25C12.2426 9.25 13.25 10.2574 13.25 11.5H14.75C14.75 9.42893 13.0711 7.75 11 7.75V9.25ZM6.62404 4.41603L8.0303 2.30662L6.78223 1.47457L5.37596 3.58397L6.62404 4.41603ZM9.07037 1.75H12.9296V0.25H9.07037V1.75ZM13.9697 2.30662L15.376 4.41603L16.624 3.58397L15.2178 1.47457L13.9697 2.30662ZM12.9296 1.75C13.3476 1.75 13.7379 1.95888 13.9697 2.30662L15.2178 1.47457C14.7077 0.709528 13.8491 0.25 12.9296 0.25V1.75ZM8.0303 2.30662C8.26214 1.95888 8.65243 1.75 9.07037 1.75V0.25C8.1509 0.25 7.29226 0.709528 6.78223 1.47457L8.0303 2.30662ZM20.25 8V15H21.75V8H20.25ZM17 18.25H5V19.75H17V18.25ZM1.75 15V8H0.25V15H1.75ZM5 18.25C3.20507 18.25 1.75 16.7949 1.75 15H0.25C0.25 17.6234 2.37665 19.75 5 19.75V18.25ZM20.25 15C20.25 16.7949 18.7949 18.25 17 18.25V19.75C19.6234 19.75 21.75 17.6234 21.75 15H20.25ZM17 4.75C18.7949 4.75 20.25 6.20507 20.25 8H21.75C21.75 5.37665 19.6234 3.25 17 3.25V4.75ZM5 3.25C2.37665 3.25 0.25 5.37665 0.25 8H1.75C1.75 6.20507 3.20507 4.75 5 4.75V3.25ZM5 4.75H6V3.25H5V4.75ZM17 3.25H16V4.75H17V3.25Z"
                                fill="#000E08" />
                        </svg>
                    </a>
                </span>
                <span class="custom-btn">
                    <input type="file" id="fileInput" style="display: none;" onchange="record_audio()"
                        multiple />
                    <a href="#" onclick="record_audio()" data-bs-toggle="tooltip"
                        aria-label="Please Select file to upload" data-bs-original-title="Audio File">
                        <svg width="16" height="22" viewBox="0 0 16 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15 10V11C15 14.866 11.866 18 8 18M1 10V11C1 14.866 4.13401 18 8 18M8 18V21M8 21H11M8 21H5M8 15C5.79086 15 4 13.2091 4 11V5C4 2.79086 5.79086 1 8 1C10.2091 1 12 2.79086 12 5V11C12 13.2091 10.2091 15 8 15Z"
                                stroke="#000E08" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </span>
                <button class="note-submit-btn" id="SendNotes" >
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
    function cancel_update(){
        location.href = "{{route('order-master')}}";
    }
    $(document).ready(function () {
        $(function () {
            $("#edit_order_date").
            datepicker({dateFormat: 'dd-mm-yy' });
        });
        var orderDate = "<?php echo \Carbon\Carbon::parse($order['order_date'])->format('d-m-Y'); ?>"; // Assuming $order['order_date'] is in a valid date format
        console.log(orderDate);
        $('#edit_order_date').val(orderDate);
    });
    var userInput = '';
    // Upload Images and show the preview

    function previewSelectedImages() {
        const input          = document.getElementById("item_image_id");
        const uploadedImages = document.getElementById("uploaded-images");
        // uploadedImages.innerHTML = "";

        const files = Array.from(input.files);

        if (files.length === 0) {
            uploadedImages.innerHTML = "<p>No files selected.</p>";
            return;
        }

        files.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imageSrc = e.target.result;
                const col      = document.createElement("div");
                col.classList.add("col-4");
                col.setAttribute("data-file-index", index);
                const maxFileNameLength = 15;
                const trimmedFileName =
                    file.name.length > maxFileNameLength
                        ? file.name.slice(0, maxFileNameLength) + "..."
                        : file.name;

                const selectedFile = `
                    <div class="selected-files">
                        <div class="d-flex align-items-center gap-2">
                            <img src="${imageSrc}" alt="${trimmedFileName}" width="35px" />
                            <div>
                                <p>${trimmedFileName}</p>
                                <small>${(file.size / 1024).toFixed(1)} KB</small>
                            </div>
                        </div>
                        <button onclick="removeImage(this, ${index})">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.59 6L10 8.59L7.41 6L6 7.41L8.59 10L6 12.59L7.41 14L10 11.41L12.59 14L14 12.59L11.41 10L14 7.41L12.59 6ZM10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM10 18C5.59 18 2 14.41 2 10C2 5.59 5.59 2 10 2C14.41 2 18 5.59 18 10C18 14.41 14.41 18 10 18Z"
                                    fill="#858585"
                                />
                            </svg>
                        </button>
                    </div>
                `;

                col.innerHTML = selectedFile;
                uploadedImages.appendChild(col);
            };

            reader.readAsDataURL(file);
        });
    }

    function removeImage(button,index) {
        const col   = button.closest(".col-4");
        col.remove();
        const input = document.getElementById("item_image_id");
        const files = Array.from(input.files);
        const updatedFiles = files.filter((_, i) => i !== index);
        const dataTransfer = new DataTransfer();
        updatedFiles.forEach((file) => dataTransfer.items.add(file));

        input.files = dataTransfer.files;
    }

    $(document).ready(function () {

        const paymentDiv = $('#payment');
        $('#order_type').on('change', function () {
            if (this.value == 'order') {
                paymentDiv.removeClass('d-none');
            } else {
                paymentDiv.addClass('d-none');
            }
        });

        var order_type = {{$order['order_type']}};

        if (order_type == 1) {
            paymentDiv.removeClass('d-none');
        }else{
            paymentDiv.addClass('d-none');
        }

        $('#updateOrderBtn').click(function (e) {
            e.preventDefault();
            var orderId            = $('#order_id').val();
            var orderDate          = $('#edit_order_date').val();
            var orderType          = $('#order_type').val();
            var orderFrom          = $('#edit_searchableSelectFrom').val();
            var orderTo            = $('#edit_searchableSelectTo').val();
            var itemMetal          = $('#item_metal').val();
            var itemName           = $('#item_name').val();
            var itemMelting        = $('#item_melting').val();
            var itemWeight         = $('#item_weight').val();
            var itemImages         = $('#item_image_id')[0].files;
            var payment_advance    = $('#payment_advance').val();
            var payment_booking    = $('#payment_booking').val();
            var item_color         = $('#item_colors').val();
            var cust               = $('#searchableCust').val();

            if (orderType == "reparing"){
                orderType = 2;
            }else{
                orderType = 1;
            }

            if (orderDate && orderType && orderFrom && orderTo) {
                var formData = new FormData();
                formData.append('_token', csrfToken);
                formData.append('order_id', orderId);
                formData.append('order_date', orderDate);
                formData.append('order_type', orderType);
                formData.append('order_from_branch_id', orderFrom);
                formData.append('order_to_branch_id', orderTo);
                formData.append('item_metal', itemMetal);
                formData.append('item_name', itemName);
                formData.append('item_melting', itemMelting);
                formData.append('item_weight', itemWeight);
                formData.append('order_user_id', cust);
                formData.append('item_color',item_color);


                var custName    = userInput;
                var custAddress = $('#customer_address').val();
                var custPhone   = $('#cust_phone_no').val();
                var custNew     = $('#customer_new').val();
                formData.append('customer_name', custName);
                formData.append('customer_address', custAddress);
                formData.append('customer_phone_number', custPhone);
                formData.append('customer_new', custNew);


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
                // Append files to FormData
                for (var i = 0; i < itemImages.length; i++) {
                    formData.append('item_file_images[]', itemImages[i]);
                }

                $.ajax({
                    url: "{{ route('order-update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 200) {

                            showAlert('success', response.message);
                            setTimeout(function () {
                                location.href = "{{ route('order-master') }}";
                            }, 1000);

                        } else {

                            showAlert('warning', response.message);

                        }
                    },
                    error: function (xhr, status, error) {

                        showAlert('warning', error);

                    }
                });
            } else {
                showAlert('warning', 'Please fill in all fields orderDate, orderType and Order To');

            }
        });



        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#edit_searchableSelectTo').select2({

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


    $(document).ready(function () {
        $('#customer_new').val('');

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
            } else {
                $('#cust_div').addClass('d-none');
            }
        });

        $(document).on('mouseup', '.select2-add-new', function (e) {
            console.log("Direct click on add new option");
            $('#cust_div').removeClass('d-none');
            e.preventDefault();
            e.stopPropagation();
        });
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
                    return $('<span><em>Create ": </em>' + data.text + '"</span>');
                }
                return data.text;
            },
            templateSelection: function (data) {
                // Display the selected item properly

                $('#order_customer_name').val(data.text);
                $('#customer_new').val(data.text);

                return data.text;
            }
        })


        $('#searchableCust').on('select2:select', function (e) {
            console.log("Event triggered:", e.params.data);

            // Check if the selected option is a new customer
            if (e.params.data.newOption) {
                console.log("New customer selected",e.params.data.newOption);
                $('#cust_div').removeClass('d-none');
                // $('#order_customer_name').val(e.params.data.newOption);
                // $('#customer_new').val(e.params.data.newOption);

            } else {
                console.log("Existing customer selected");
                $('#customer_new').val('false');

                $('#cust_div').addClass('d-none');
            }
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

                            showAlert('success', response.message);
                            // alert(response.message);

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
            } else {
                // alert('Please fill in both fields.');
                showAlert('warining', 'Please fill in both fields, Name and address');
            }
        });
    });



    var csrfToken = $('meta[name="csrf-token"]').attr('content');

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


    function transfer_order(order_id) {

        $('#transfer_order_id').val(order_id);
        $('#transfer_order').modal('show');
    }

    $('#TransferOrderBtn').click(function (e) {
        e.preventDefault();

        var orderId = $('#transfer_order_id').val();
        var transferTo = $('#TransfersearchableSelectTo').val();

        if (orderId) {
            $.ajax({
                url: "{{ route('order_transfer') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    order_id: orderId,
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
        } else {
            alert('Please fill in both fields.');
        }
    });




    function approve_order(transaction_id) {
        if (transaction_id) {
            $.ajax({
                url: "{{ route('order_approve') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    trans_id: transaction_id,
                },
                success: function (response) {
                    if (response.status == 200) {

                        location.reload();
                        showAlert('success', response.message);
                    } else {
                        showAlert('warning', response.message);
                    }
                },
                error: function (xhr, status, error) {
                    showAlert('warning', error.message);
                }
            });
        } else {
            showAlert('warning', 'Please select Transaction id');
        }
    }



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
    });

    function showAlert(type, message) {
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

    // Remove file from the order
    function removeFile(file_id,order_id){
        $.ajax({
                url: "{{ route('file_remove') }}",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    file_id: file_id,
                    order_id: order_id
                },
                success: function (response) {
                    if (response.status == 200) {
                       showAlert('success', response.message);
                       $('#file-' + file_id).remove();
                        // setTimeout(function () {
                        //     location.reload();
                        // }, 2000);
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

    // Code for notes

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
            const order_id  = $('#order_id').val();
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
                            else if(note.notes_type == 3){
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
                    const order_id = $('#order_id').val();
                    if (text) {
                        $.ajax({
                            url: "{{ route('notes_add') }}",
                            type: 'POST',
                            data: {
                                'notes_text': text,
                                'notes_file': null,
                                'notes_order_id':order_id,
                                'notes_type'    : 1

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

            $("#SendNotes").on("click", function () {
                const text = $("#TextNotes").val().trim();
                const order_id = $('#order_id').val();
                if (text) {
                    $.ajax({
                        url: "{{ route('notes_add') }}",
                        type: 'POST',
                        data: {
                            'notes_text': text,
                            'notes_file': null,
                            'notes_order_id':order_id,
                            'notes_type'    : 1
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

            });
        });
    });

    function open_file_select() {
        $("#fileInput").click();
    }


    let cameraStream = null;
    let capturedImage = null;
    let useFrontCamera = true;
    function click_image(){
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
        stopCamera();
    })

    // Retake image
    $('#retakeButton').on('click', function () {
        $('#cameraView').show();
        $('#previewContainer').hide();
        $('#sendImageButton').hide();
        startCamera(); 
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
        const orderId = $('#order_id').val();
        const formData = new FormData();
        const imageFile = dataURLToFile(capturedImage, 'captured-image.png');


        formData.append('notes_text', '');
        formData.append('notes_file[]', imageFile);
        formData.append('notes_type', 4);
        formData.append('notes_order_id', orderId);

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
                $('#click_image').modal('hide');
                showAlertNotes('success', 'Image file uploaded successfully!');
                isLoading = false;
                page=1;
                loadNotes();
            },
            error: function (error) {
                console.error('Image upload failed:', error);
            }
        });
    }

    // Stop the camera when the modal is closed
    $('[data-bs-dismiss="modal"]').on('click', stopCamera);

    function record_audio(){
        $('#record_audio').modal('show');
        $("#audio-playback").addClass("hidden")

    }

    let recorder, audio_stream, audioBlob;

    const recordButton = $('#recordButton');
    $('#recordButton').on('click', startRecording);

    const stopButton = $('#stopButton');
    $('#stopButton').on('click', stopRecording);

    // set preview
    const preview    = $('#audio-playback');
    const sendButton = $('#sendButton');

    $('#sendButton').on('click', uploadRecording);
    const audioPlaybackContainer =$('#audioPlaybackContainer');

    const resetButton = $('#resetButton');
    $('#resetButton').on('click', resetRecording);

    const cancelButton = $('#cancelButton');
    $('#cancelButton').on('click', cancelRecording);


    function startRecording() {

        // button settings

        $("#recordButton").prop("disabled", true);
        $("#recordButton").text("Recording...");
        $("#recordButton").addClass("button-animate");

        $("#stopButton").removeClass("inactive");
        $("#stopButton").prop("disabled", false);

        $('#sendButton').prop("disabled", true);


        $("#audio-playback").addClass("hidden")

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

                    // Create a URL for the blob and set it as the audio playback source
                    const url = URL.createObjectURL(audioBlob);
                    var preview = document.getElementById('audio-playback');
                    preview.src = url;

                    // Unhide the audio playback element
                    $("#audioPlaybackContainer").removeClass("d-none");

                    preview.load();
                    console.log("Audio recording ready for playback.");
                    sendButton.audioBlob = audioBlob;
                };

                recorder.start();

                timeout_status = setTimeout(function () {
                    console.log("5 min timeout");
                    stopRecording();
                }, 300000);
            });
    }

    function stopRecording() {
        recorder.stop();
        audio_stream.getAudioTracks()[0].stop();

        // buttons reset
        recordButton.disabled = false;
        recordButton.innerText = "Redo Recording"
        $("#recordButton").removeClass("button-animate");

        $("#stopButton").addClass("inactive");
        $('#sendButton').prop("disabled", false);

        stopButton.disabled = true;

        sendButton.audioBlob = audioBlob;

        $("#audio-playback").removeClass("hidden");
        console.log('class remove');


    }

    function resetRecording() {
        // Reset the recorder, audio stream, and UI
        if (recorder) {
            recorder.stop();
            audio_stream.getAudioTracks()[0].stop();
        }

        // Reset audio variables
        audioBlob = null;
        audio_stream = null;
        recorder = null;

        // Hide audio playback and reset the buttons
        audioPlaybackContainer.addClass("d-none");
        preview[0].src = '';
        $("#audio-playback").addClass("hidden");

        recordButton.prop("disabled", false);

        $("#recordButton").text("");
        $("#recordButton").html('<i class="bi bi-mic"></i>');
        recordButton.removeClass("button-animate");

        stopButton.addClass("inactive");
        stopButton.prop("disabled", true);

        sendButton[0].audioBlob = null;
    }

    function cancelRecording() {
        if (recorder) {
            recorder.stop();
            audio_stream.getAudioTracks()[0].stop();
        }

        // Reset audio variables
        audioBlob = null;
        audio_stream = null;
        recorder = null;

        // Hide audio playback and reset the buttons
        audioPlaybackContainer.addClass("d-none");
        preview[0].src = '';
        $("#audio-playback").addClass("hidden");

        recordButton.prop("disabled", false);

        $("#recordButton").text("");
        $("#recordButton").html('<i class="bi bi-mic"></i>');
        recordButton.removeClass("button-animate");

        stopButton.addClass("inactive");
        stopButton.prop("disabled", true);

        sendButton[0].audioBlob = null;
    }

// function downloadRecording(){
//     var name = new Date();
//     var res = name.toISOString().slice(0,10)
//     downloadAudio.download = res + '.wav';
// }

    function uploadRecording() {
        console.log("Audio Blob:", audioBlob);
        console.log("Send Button Blob:", sendButton.audioBlob);
        console.log(audioBlob.type);
        if (!sendButton.audioBlob) {
            alert("No audio file available for upload!");
            return;
        }
        const orderId = $('#order_id').val();
        const audioFile = new File([audioBlob], 'recording.wav', { type: 'audio/wav' });

        const formData = new FormData();
        formData.append('notes_text', '');
        formData.append('notes_file[]', audioFile);
        formData.append('notes_type', 3);
        formData.append('notes_order_id', orderId);
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
                if(response.status==200){

                    showAlertNotes('success', 'Audio file uploaded successfully!');
                }else{
                    showAlertNotes('warning', response.message);
                }
                $('#record_audio').modal('hide');
                isLoading = false;
                page=1;
                loadNotes();
            },
            error: function (error) {
                console.error('Audio upload failed:', error);
            }
        });
    }


        function handleFileUpload(event) {
            const file = event.target.files;
            if (file) {
                const formData = new FormData();
                formData.append('notes_text', '');
                for (var i = 0; i < file.length; i++) {
                    formData.append('notes_file[]', file[i]);
                    formData.append('notes_type', 3);

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
                        page=1;
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
@endsection
