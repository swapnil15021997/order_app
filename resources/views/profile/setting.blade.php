@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- <h2 class="page-title">
                    Settings
                    </h2> -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{route('role-master')}}">Settings</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div id="alert-profile"></div>
        <div id="alert-site"></div>
       
        <div class="row">
            <div class="card">
                @if ($errors->any())
                    <div class=" p-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @endif
                    <script>
                        window.onload = function() {
                            var errors = @json($errors->all());
                            console.log(errors);
                            if (errors.length>0){

                                showAlert('warining',errors);
                            }
                            var successMessage = @json(session('status'));
                            console.log("Success:", successMessage);
                            if (successMessage.length>0) {
                                showAlert('success', [successMessage]);
                            }
                        }
                    </script>

                <div class="row g-0">

                    <div class="col-12 col-md-3 border-end">
                        <div class="card-body">
                            <h4 class="subheader">Profile settings</h4>
                            <div class="list-group list-group-transparent">
                                <a href="#myAccount"
                                    class="list-group-item list-group-item-action d-flex align-items-center active"
                                    data-bs-toggle="tab" role="tab" aria-controls="myAccount" aria-selected="true">My
                                    Account</a>
                                <a href="#password"
                                    class="list-group-item list-group-item-action d-flex align-items-center"
                                    data-bs-toggle="tab" role="tab" aria-controls="password" aria-selected="false">
                                    Password
                                </a>
                                <!-- <a href="#general_settings" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="password" aria-selected="false">
                                        General Settings
                                    </a> -->
                                <a href="{{route('branch-master')}}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    Branch
                                </a>
                                <a href="{{route('user-master')}}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    User & Roles
                                </a>

                                <a href="#Custom"
                                    class="list-group-item list-group-item-action d-flex align-items-center"
                                    data-bs-toggle="tab" role="tab" aria-controls="Custom" aria-selected="true">
                                    Melting, Color, Metals
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9 d-flex flex-column">
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="myAccount" role="tabpanel">
                                <form method="post" action="{{ route('profile.update') }}" class="">
                                    <div class="card-body">
                                        <h2 class="mb-4">My Profile</h2>
                                        <h3 class="">Profile Details</h3>

                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-xl"
                                                    style="background-image: url('{{ asset('storage/' . session('profile_path', ''))}}')">

                                                </span>
                                            </div>
                                            <input type="file" id="fileInput" style="display: none;"
                                                onchange="handleFileUpload(event)">
                                            <div onclick="file_select()" class="col-auto"><a href="#" class="btn">
                                                    Change avatar
                                                </a>
                                            </div>
                                            <!-- <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                                                    Delete avatar
                                                    </a>
                                                </div> -->
                                        </div>
                                        @csrf
                                        @method('patch')

                                        <div class="row mt-4 align-items-center">

                                            <div class="col-md mb-3">
                                                <div class="form-label">Name</div>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{$login['name']}}">
                                            </div>

                                            <div class="col-md mb-3">
                                                <div class="form-label">Phone No</div>
                                                <input type="text" class="form-control" name="user_phone_number"
                                                    value="{{$login['user_phone_number']}}">
                                            </div> 
                                        </div>
                                        <h3 class="card-title mt-4">Email</h3>
                                        <div>
                                            <div class="row g-2">
                                                <div class="col-auto">
                                                    <input type="email" class="form-control w-auto" name="email"
                                                        value="{{$login['email']}}">
                                                </div>

                                            </div>
                                        </div>



                                        <div class="row mt-3">
                                            <div class="col-md-3 mb-3">

                                                <h3 class="card-title mt-4">Active Branch</h3>
                                                <select class="form-select" onchange="changeBranch(this.value)">
                                                    @foreach($user_branch as $branch)
                                                        <option value="{{ $branch['branch_id'] }}"
                                                            @if($branch['branch_id'] == $login['user_active_branch']) selected
                                                            @endif>
                                                            {{ $branch['branch_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent mt-auto">
                                        <div class="btn-list justify-content-end">
                                            <a href="#" class="btn">
                                                Cancel
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="password" role="tabpanel">
                                <div class="card-body">
                                    <h2 class="mb-4">My Account</h2>
                                    <h3 class="card-title">Change Password</h3>

                                    <p class="card-subtitle">You can set a permanent password if you don't want to use
                                        temporary login codes.</p>
                                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('post')

                                        <div>
                                            <div class="row g-3 mb-3">

                                                <div class="col-md">
                                                    <div class="form-label">Current Password</div>
                                                    <input type="password" name="current_password" class="form-control"
                                                        name="name">
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-label">New Password</div>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-label">Confirm Password</div>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation">
                                                </div>


                                            </div>
                                        </div>

                                        <div class="card-footer bg-transparent mt-auto">
                                            <div class="btn-list justify-content-end">
                                                <!-- <a href="#" class="btn">
                                                            Cancel
                                                        </a> -->
                                                <button type="submit" class="btn  btn-primary">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="general_settings" role="tabpanel">
                                <div class="card-body">
                                    <h2 class="mb-4">Portal Settings</h2>
                                    <h3 class="card-title">Update Settings</h3>

                                    <p class="card-subtitle">You can set a permanent password if you don't want to use
                                        temporary login codes.</p>


                                    <div>
                                        <div class="row g-3 mb-3">
                                            @foreach($settings as $set)
                                                <div class="col-md">
                                                    <div class="form-label">{{$set['setting_name']}}</div>
                                                    @if($set['setting_name'] == "email")
                                                        <input type="email" name="{{$set['setting_name']}}"
                                                            value="{{$set['setting_value']}}" class="form-control">
                                                    @endif

                                                    @if($set['setting_name'] == "logo")
                                                        <input type="file" name="{{$set['setting_name']}}" class="form-control">
                                                    @endif
                                                    @if($set['setting_name'] == "notification_icon")
                                                        <input type="file" name="{{$set['setting_name']}}" class="form-control">
                                                    @endif
                                                    @if($set['setting_name'] == "fcm_token")
                                                        <input type="text" name="{{$set['setting_name']}}" class="form-control">
                                                    @endif
                                                </div>
                                            @endforeach
                                            <!-- <div class="col-md">
                                                            <div class="form-label">New Password</div>
                                                            <input type="password" class="form-control" name="password">
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="form-label">Confirm Password</div>
                                                            <input type="password" class="form-control" name="password_confirmation">
                                                        </div> -->

                                        </div>
                                    </div>

                                    <div class="card-footer bg-transparent mt-auto">
                                        <div class="btn-list justify-content-end">
                                            <!-- <a href="#" class="btn">
                                                            Cancel
                                                        </a> -->
                                            <button type="submit" class="btn  btn-primary">
                                                Submit
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="Custom" role="tabpanel">
                                <div class="card-body">
                                    <h2 class="mb-4">Portal Customization</h2>
                                    <h3 class="card-title">Dynamic Entries</h3> 
                                    <p class="card-subtitle">You can add values to Colors,Melting and Metal .</p> 
                                    <div>
                                        <div class="row g-3 mb-3"> 
                                            <div class="col-md"> 
                                                <h3 class="mb-2 d-flex justify-content-between">
                                                    Metals
                                                    <svg onclick="resetItem('metals')" style="cursor:pointer"  width="20px" height="20px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" transform="matrix(0 1 1 0 2.5 2.5)">
                                                        <path d="m3.98652376 1.07807068c-2.38377179 1.38514556-3.98652376 3.96636605-3.98652376 6.92192932 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8"/>
                                                        <path d="m4 1v4h-4" transform="matrix(1 0 0 -1 0 6)"/>
                                                        </g>
                                                    </svg> 
                                                </h3> 
                                                <small class="" id="metals_item_type"></small>  
                                                <!-- <form method="post" class="mb-3" id="metal_form"> -->
                                                    <div class="d-flex gap-2 mb-3 ">
                                                        <input type="hidden" id="metals_item" name="item" value="metals">
                                                        <input type="hidden" id="metals_item_id" name="item_id" value="">
                                                        <input name="item_value" id="metals_itemInput" type="text" placeholder="Add new metal..." 
                                                            class="form-control shadow-sm" style="flex: 1;">
                                                        <button onclick="submitForm('metals');"  class="btn btn-primary  shadow-sm">Save</button>
                                                    </div> 
                                                <!-- </form> -->

                                                <!-- Items List -->
                                                <ul id="metal-list" class="list-group">                                      
                                                    @foreach($metal_list as $k=>$v)
                                                    <li id="metals_{{$v->metal_id}}" class="item_list list-group-item d-flex justify-content-between align-items-center">
                                                        <span class="fw-bold">{{$v->metal_name}}</span>
                                                        <div>
                                                            <button type="button" onclick="editItem('metals','{{$v->metal_id}}','{{$v->metal_name}}')" class="btn btn-warning btn-sm me-2">Edit</button>
                                                            <button type="button" onclick="deleteItem('metals','{{$v->metal_id}}','{{$v->metal_name}}')" class="btn btn-danger btn-sm">Delete</button>
                                                        </div>
                                                    </li> 
                                                    @endforeach 
                                                </ul>  
                                            </div>

                                            <div class="col-md"> 
                                                <h3 class="mb-2 d-flex justify-content-between">
                                                    Colors
                                                    <svg onclick="resetItem('colors')" style="cursor:pointer"  width="20px" height="20px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" transform="matrix(0 1 1 0 2.5 2.5)">
                                                        <path d="m3.98652376 1.07807068c-2.38377179 1.38514556-3.98652376 3.96636605-3.98652376 6.92192932 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8"/>
                                                        <path d="m4 1v4h-4" transform="matrix(1 0 0 -1 0 6)"/>
                                                        </g>
                                                    </svg> 
                                                </h3> 
                                                <small class="" id="colors_item_type"></small>  
                                                <!-- <form method="post" class="mb-3" id="metal_form"> -->
                                                    <div class="d-flex gap-2 mb-3 ">
                                                        <input type="hidden" id="colors_item" name="item" value="colors">
                                                        <input type="hidden" id="colors_item_id" name="item_id" value="">
                                                        <input name="item_value" id="colors_itemInput" type="text" placeholder="Add new color..." 
                                                            class="form-control shadow-sm" style="flex: 1;">
                                                        <button onclick="submitForm('colors');"  class="btn btn-primary  shadow-sm">Save</button>
                                                    </div> 
                                                <!-- </form> -->

                                                <!-- Items List -->
                                                <ul id="color-list" class="list-group">                                      
                                                    @foreach($color_list as $k=>$v)
                                                    <li id="colors_{{$v->color_id}}" class="item_list list-group-item d-flex justify-content-between align-items-center">
                                                        <span class="fw-bold">{{$v->color_name}}</span>
                                                        <div>
                                                            <button type="button" onclick="editItem('colors','{{$v->color_id}}','{{$v->color_name}}')" class="btn btn-warning btn-sm me-2">Edit</button>
                                                            <button type="button" onclick="deleteItem('colors','{{$v->color_id}}','{{$v->color_name}}')" class="btn btn-danger btn-sm">Delete</button>
                                                        </div>
                                                    </li> 
                                                    @endforeach 
                                                </ul>  
                                            </div>

                                            <div class="col-md"> 
                                                <h3 class="mb-2 d-flex justify-content-between">
                                                    Melting
                                                    <svg onclick="resetItem('melting')" style="cursor:pointer"  width="20px" height="20px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" transform="matrix(0 1 1 0 2.5 2.5)">
                                                        <path d="m3.98652376 1.07807068c-2.38377179 1.38514556-3.98652376 3.96636605-3.98652376 6.92192932 0 4.418278 3.581722 8 8 8s8-3.581722 8-8-3.581722-8-8-8"/>
                                                        <path d="m4 1v4h-4" transform="matrix(1 0 0 -1 0 6)"/>
                                                        </g>
                                                    </svg> 
                                                </h3> 
                                                <small class="" id="melting_item_type"></small>  
                                                <!-- <form method="post" class="mb-3" id="metal_form"> -->
                                                    <div class="d-flex gap-2 mb-3 ">
                                                        <input type="hidden" id="melting_item" name="item" value="melting">
                                                        <input type="hidden" id="melting_item_id" name="item_id" value="">
                                                        <input name="item_value" id="melting_itemInput" type="text" placeholder="Add new melting..." 
                                                            class="form-control shadow-sm" style="flex: 1;">
                                                        <button onclick="submitForm('melting');"  class="btn btn-primary  shadow-sm">Save</button>
                                                    </div> 
                                                <!-- </form> -->

                                                <!-- Items List -->
                                                <ul id="melting-list" class="list-group">                                      
                                                    @foreach($melting_list as $k=>$v)
                                                    <li id="melting_{{$v->melting_id}}" class="item_list list-group-item d-flex justify-content-between align-items-center">
                                                        <span class="fw-bold">{{$v->melting_name}}</span>
                                                        <div>
                                                            <button type="button" onclick="editItem('melting','{{$v->melting_id}}','{{$v->melting_name}}')" class="btn btn-warning btn-sm me-2">Edit</button>
                                                            <button type="button" onclick="deleteItem('melting','{{$v->melting_id}}','{{$v->melting_name}}')" class="btn btn-danger btn-sm">Delete</button>
                                                        </div>
                                                    </li> 
                                                    @endforeach 
                                                </ul>  
                                            </div>
                                             

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="delete_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete <span class='itemName'></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    Do you want to delete this <span class='itemName'></span> ?
                </div>
            </div>
            <input type="hidden" id="delete_item" value=''/>
            <input type="hidden" id="delete_item_id" value=''/>

            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a onclick="doDeleteItem();" href="#" class="btn btn-primary" data-bs-dismiss="modal">
                    Delete Now
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (event) {
            const targetId = event.target.getAttribute('href');
            history.pushState(null, '', targetId);
        });
    });

    function editItem(item,id,name){
        $('#'+item+'_item').val(item);
        $('#'+item+'_item_id').val(id)
        $('#'+item+'_itemInput').val(name);
        $('#'+item+'_item_type').text('Editing..');
        $('.item_list').css('background','none');
        $('#'+item+'_'+id).css('background','#842b2540');
        
        console.log(item,id,name);
    }
    function resetItem(item){
        $('#'+item+'_item').val(item);
        $('#'+item+'_item_id').val('')
        $('#'+item+'_itemInput').val('');
        $('#'+item+'_item_type').text(''); 
        $('.item_list').css('background','none');
    }

     
    $('#metal_form').on('submit', function(e){
        e.preventDefault();
    });

    function deleteItem(item,item_id,item_value){
        $('#delete_item').val(item);
        $('#delete_item_id').val(item_id);
        $('.itemName').text(item_value);
        $('#delete_item').modal('show');
    }

    function submitForm(item){ 
        const formData = new FormData();
        formData.append('item', $('#'+item+'_item').val());
        formData.append('item_id', $('#'+item+'_item_id').val());
        formData.append('item_value', $('#'+item+'_itemInput').val());
           
        $.ajax({
            url: "{{ route('save.mmc') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                showAlert('success', response.message);
                if(response.status == 200){
                    location.reload(); 
                }
            }
        }); 
    }
    function doDeleteItem(item,item_id){ 
        const formData = new FormData();
        formData.append('item', $('#delete_item').val());
        formData.append('item_id', $('#delete_item_id').val()); 
        $.ajax({
            url: "{{ route('delete.mmc') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                showAlert('success', response.message);
                if(response.status == 200){
                    location.reload(); 
                }
            }
        }); 
    }

    function file_select() { 
        $("#fileInput").click();

    }

    function handleFileUpload(event) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        const file = event.target.files;
        const user_id = "{{$login['id']}}";

        if (file) {
            const formData = new FormData();
            formData.append('notes_text', '');
            for (var i = 0; i < file.length; i++) {
                formData.append('user_file', file[i]);
            }
            formData.append('user_id', user_id);

            $.ajax({
                url: "{{ route('user_update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    showAlert('success', response.message);
                    location.reload();
                }
            });
        }
    }
    @if (session('status'))
        document.addEventListener('DOMContentLoaded', function () {
            showAlert('success', "{{ session('status') }}");
        });

    @endif


    @if (session('warning'))
        document.addEventListener('DOMContentLoaded', function () {
            showAlert('warning', "{{ session('warning') }}");
        });

    @endif

    @if (session('error'))
        document.addEventListener('DOMContentLoaded', function () {
            showAlert('error', "{{ session('error') }}");
        });

    @endif
    @if ($errors->updatePassword->any())
        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($errors->updatePassword->all() as $error)
                showAlert('error', "{{ $error }}");
            @endforeach
        });
    @endif

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

                    showAlert('warning', response.message);
                }
            },
            error: function (xhr, status, error) {

                showAlert('warning', error);
            }
        });
    }

    function showAlert(type, message) {
        const alertContainer = document.getElementById('alert-profile');
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


@endsection
