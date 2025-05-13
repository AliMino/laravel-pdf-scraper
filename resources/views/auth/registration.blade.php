<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Create an Account</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
            crossorigin="anonymous"></script>
    
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
            crossorigin="anonymous"></script>
    
    <!-- Bootstrap 4 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
            crossorigin="anonymous"></script>
    
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous"></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="container">
        <div class="registration form">
            <header>Signup</header>
            <form action="{{ route('user-registration-form-submission') }}" method="POST">
                @csrf
                
                @error('name')
                    <div class="text-danger fs-6 fst-italic fw-semibold">{{ $message }}</div>
                @enderror
                <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                
                @error('email')
                    <div class="text-danger fs-6 fst-italic fw-semibold">{{ $message }}</div>
                @enderror
                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">

                @error('password')
                    <div class="text-danger fs-6 fst-italic fw-semibold">{{ $message }}</div>
                @enderror
                <input type="password" name="password" placeholder="Create a password">

                @error('password_confirmation')
                    <div class="text-danger fs-6 fst-italic fw-semibold">{{ $message }}</div>
                @enderror
                <input type="password" name="password_confirmation" placeholder="Confirm your password">
                <input type="submit" class="button" value="Signup">
            </form>
            <div class="signup">
                <span class="signup">Already have an account?
                    <a href="{{ route('user-login-form') }}">Login</a>
                </span>
            </div>
        </div>
    </div>
</body>

</html>