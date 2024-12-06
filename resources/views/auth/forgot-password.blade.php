<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Reset Your Password</h2>
        <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email address" value="{{ old('email') }}">

                <div id="emailError" class="error" style="display:none;"></div>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="btn">Send Password Reset Link</button>
            
            <!-- Back to login link -->
            <p style="text-align: center; margin-top: 15px;">
                <a href="{{ route('login') }}">Back to login</a>
            </p>

            <div id="responseMessage" class="success" style="display:none;"></div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    
    $(document).ready(function() {
    $('#forgotPasswordForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
                var email = $('#email').val(); // Get email value
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    // Submit the password reset request
        $.ajax({
            url: "{{ route('password.email') }}", // Password reset route
            method: 'POST',
            data: {
                email:email
            },
            dataType:"JSON",
            success: function(response) {
                $('#responseMessage').text(response.status).show();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                if (errors && errors.email) {
                    $('#emailError').text(errors.email[0]).show();
                } else {
                    $('#emailError').text('Something went wrong, please try again.').show();
                }
            }
        });
    });
});

    </script>
</body>
</html>
