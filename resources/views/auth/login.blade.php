@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')

<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h4 class="nk-block-title">Sign-In</h4>
        <div class="nk-block-des">
            <p>Access the {{ config('app.name') }} using your email and password.</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('login') }}" >
    @csrf
    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email">Email</label>
        </div>
        <div class="form-control-wrap">
            <input type="text" class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter your email address" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">Password</label>
            <a class="link link-primary link-sm" href="{{ route('password.request') }}">Forgot Password?</a>
        </div>
        <div class="form-control-wrap">
            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
            </a>
            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password"  placeholder="Enter your password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-control-xs custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">Remember me</label>
        </div>
    </div>
    
    <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
    </div>
</form>

@endsection
