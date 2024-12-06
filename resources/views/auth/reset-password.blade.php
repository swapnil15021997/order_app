<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* General Body Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Form Container */
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Title */
        h2 {
            text-align: center;
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        /* Form Elements */
        label {
            font-size: 14px;
            color: #333333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Submit Button */
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Reset Password</h2>
        
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', request()->email) }}" required autofocus />
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required />
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required />
                @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>
