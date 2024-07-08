@extends('layout.app')

@section('content')
<style>
    /* body {
        background-color: #f8f9fa;
        height: 100vh;
        margin: 0;
    } */
    .login-container {
        display: flex;
        justify-content: center;
        display: flex;
        align-items: center;
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .login-image {
        max-width: 300px;
        margin-right: 2rem;
    }
    .login-form {
        width: 300px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .form-check-label {
        margin-left: 0.5rem;
    }
    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
    <div class="login-container">
        <img src="{{ asset('assets/img/about/pet_care.png') }}" alt="Login Image" class="login-image">
        <div class="login-form">
            <h2 class="text-center">Sign In</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <div class="button-group-area">
                <button type="submit" class="btn genric-btn default success circle">SIGN IN</button>
                @if (Route::has('password.request'))
                    <a class="btn genric-btn link-border circle" href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>
            </form>
        </div>
    </div>
@endsection
