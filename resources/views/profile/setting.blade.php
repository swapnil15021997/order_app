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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('role-master')}}">Settings</a></li>
                         </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div id="alert-profile"></div>
            <div class="row">
                <div class="card">
                    <div class="row g-0">

                    <div class="col-12 col-md-3 border-end">
                            <div class="card-body">
                                <h4 class="subheader">Profile settings</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="#myAccount" class="list-group-item list-group-item-action d-flex align-items-center active" data-bs-toggle="tab" role="tab" aria-controls="myAccount" aria-selected="true">My Account</a>
                                    <a href="#password" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="password" aria-selected="false">
                                        Password
                                    </a>
                                    <a href="#general_settings" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="tab" role="tab" aria-controls="password" aria-selected="false">
                                        General Settings
                                    </a>
                                    <a href="{{route('branch-master')}}" class="list-group-item list-group-item-action d-flex align-items-center" >
                                        Branch
                                    </a>
                                    <a href="{{route('user-master')}}" class="list-group-item list-group-item-action d-flex align-items-center" >
                                        User & Roles
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-9 d-flex flex-column">
                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="myAccount" role="tabpanel">
                                    <div class="card-body">
                                        <h2 class="mb-1">My Profile</h2>
                                        <h3 class="">Profile Details</h3>
                                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                            @csrf
                                            @method('patch')

                                            <div class="row align-items-center">
                                            
                                                <div class="col-md mb-3">
                                                    <div class="form-label">Name</div>
                                                    <input type="text" class="form-control" name="name" value="{{$login['user_name']}}">
                                                </div>
                                                <div class="col-md mb-3">
                                                    <div class="form-label">Email</div>
                                                    <input type="email" class="form-control" name="email" value="{{$login['email']}}">
                                                </div>
                                                <div class="col-md mb-3">
                                                    <div class="form-label">Phone No</div>
                                                    <input type="text" class="form-control" name="user_phone_number" value="{{$login['user_phone_number']}}">
                                                </div>
                                                <div class="col-md mb-3">
                                                    <div class="form-label">Change Active Branch</div>
                                                    <select class="form-select" onchange="changeBranch(this.value)">
                                                        @foreach($user_branch as $branch)
                                                            <option value="{{ $branch['branch_id'] }}" 
                                                                    @if($branch['branch_id'] == $login['user_active_branch']) selected @endif>
                                                                {{ $branch['branch_name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div>
                                                    <div class="row g-2">
                                                    
                                                        <div class="col-auto">
                                                            <button href="#" class="btn" type="submit">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="password" role="tabpanel">
                                    <div class="card-body">
                                        <h2 class="mb-4">My Account</h2>
                                        <h3 class="card-title">Change Password</h3>

                                            <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                                @csrf
                                                @method('post')

                                                <div>
                                                    <div class="row g-3 mb-3">
                             
                                                        <div class="col-md">
                                                            <div class="form-label">Current Password</div>
                                                            <input type="password" name="current_password" class="form-control" name="name">
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-label">New Password</div>
                                                            <input type="password" class="form-control" name="password">
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-label">Confirm Password</div>
                                                            <input type="password" class="form-control" name="password_confirmation">
                                                        </div>

                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="card-footer bg-transparent mt-auto">
                                                    <div class="btn-list justify-content-end">
                                                        <!-- <a href="#" class="btn">
                                                            Cancel
                                                        </a> -->
                                                        <button  type="submit" class="btn  btn-primary">
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

                                            <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                                         

                                                <div>
                                                    <div class="row g-3 mb-3">
                                                        @foreach($settings as $set)
                                                        <div class="col-md">
                                                            <div class="form-label">{{$set['setting_name']}}</div>
                                                            @if($set['setting_name']=="email")
                                                            <input type="email" name="{{$set['setting_name']}}" value="{{$set['setting_value']}}" class="form-control">
                                                            @endif

                                                            @if($set['setting_name']=="logo")
                                                            <input type="file" name="{{$set['setting_name']}}" class="form-control">
                                                            @endif
                                                            @if($set['setting_name']=="notification_icon")
                                                            <input type="file" name="{{$set['setting_name']}}" class="form-control">
                                                            @endif
                                                            @if($set['setting_name']=="fcm_token")
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
                                                        <button  type="submit" class="btn  btn-primary">
                                                            Submit
                                                        </button>
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


    <script>

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