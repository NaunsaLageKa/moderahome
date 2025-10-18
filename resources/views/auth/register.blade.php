<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - ModeraHome</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .register-container {
                background: white;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                padding: 40px;
                width: 100%;
                max-width: 450px;
                position: relative;
                overflow: hidden;
            }
            
            .register-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #8B4513, #D2691E, #CD853F);
            }
            
            .logo {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .logo h1 {
                color: #8B4513;
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 5px;
            }
            
            .logo p {
                color: #666;
                font-size: 0.9rem;
            }
            
            .form-group {
                margin-bottom: 20px;
            }
            
            .form-group label {
                display: block;
                margin-bottom: 8px;
                color: #333;
                font-weight: 500;
            }
            
            .form-group input {
                width: 100%;
                padding: 12px 16px;
                border: 2px solid #e1e5e9;
                border-radius: 10px;
                font-size: 16px;
                transition: all 0.3s ease;
                background: #f8f9fa;
            }
            
            .form-group input:focus {
                outline: none;
                border-color: #8B4513;
                background: white;
                box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
            }
            
            .form-row {
                display: flex;
                gap: 15px;
            }
            
            .form-row .form-group {
                flex: 1;
            }
            
            .btn-register {
                width: 100%;
                padding: 14px;
                background: linear-gradient(135deg, #8B4513, #A0522D);
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-bottom: 20px;
            }
            
            .btn-register:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(139, 69, 19, 0.3);
            }
            
            .login-link {
                text-align: center;
                color: #666;
            }
            
            .login-link a {
                color: #8B4513;
                text-decoration: none;
                font-weight: 500;
            }
            
            .login-link a:hover {
                text-decoration: underline;
            }
            
            .furniture-icon {
                position: absolute;
                top: 20px;
                right: 20px;
                font-size: 2rem;
                color: #8B4513;
                opacity: 0.3;
            }
            
            .error-message {
                background: #fee;
                color: #c33;
                padding: 10px;
                border-radius: 8px;
                margin-bottom: 20px;
                border-left: 4px solid #c33;
            }
            
            .success-message {
                background: #efe;
                color: #363;
                padding: 10px;
                border-radius: 8px;
                margin-bottom: 20px;
                border-left: 4px solid #363;
            }
        </style>
    @endif
</head>
<body>
    <div class="register-container">
        <div class="furniture-icon">🏠</div>
        
        <div class="logo">
            <h1>ModeraHome</h1>
            <p>Join our furniture community</p>
        </div>
        
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            
            <button type="submit" class="btn-register">
                Create Account
            </button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </div>
</body>
</html>
