@extends('auth.layouts.app')

@section('title', 'Setup new Password')

@section('content')

<div class="nk-block-head">
    <div class="nk-block-head-content">
        <h5 class="nk-block-title">
            {{ !empty(request()->input('invite')) ? 'One final step!' : 'Setup new password' }}
        </h5>
        <div class="nk-block-des">
            <p>Please enter your new password in the form below.</p>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    @if (!empty(request()->input('invite')))
    <input type="hidden" name="invite" value="{{ request()->input('invite') }}">
    @endif

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="email">Email Address</label>
        </div>
        <div class="form-control-wrap">
            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Enter your email here" required autocomplete="email" readonly>

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
        </div>
        <div class="form-control-wrap">
            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Enter your password here" required autocomplete="new-password" autofocus>

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="form-label-group">
            <label class="form-label" for="password">Confirm Password</label>
        </div>
        <div class="form-control-wrap">
            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Re-enter your password here" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Set Password</button>
    </div>
</form>

<div class="form-note-s2 text-center pt-4">
    <a href="{{ route('login') }}"><strong>Return to login</strong></a>
</div>

@endsection