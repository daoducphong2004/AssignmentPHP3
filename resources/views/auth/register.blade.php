@extends('layout.app')

@section('content')
    <style>
        .register-container  {
            display: flex;
            justify-content: center;
            display: flex;
            align-items: center;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .register-image {
            max-width: 300px;
            margin-right: 2rem;
        }
        .register-form {
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
    <div class="register-container">
        <img src="{{ asset('assets/img/about/pet_care.png') }}" alt="Login Image" class="login-image">
        <div class="register-form">
            <h2 class="text-center">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">
                </div>
                <button type="submit" class="btn genric-btn default success circle">Register</button>
            </form>
        </div>
    </div>
@endsection
