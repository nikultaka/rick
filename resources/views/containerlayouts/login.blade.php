@extends('containerlayouts.index')
@section('title', 'Login Page')
@section('logincontent')

    <div class="login-wrapper">
        <div class="login-container">
            <div class="title">
                <img class="title_img" src="{{ asset('stylecontainer/images/A15-containerservices-tekst 1.png') }}" alt="title">
            </div>
            <div class="rtrack-logo_img">
                <img class="track-img" src="{{ asset('stylecontainer/images/rtrack_logo_img.png') }}" alt="title">
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <div class="input-group username-group">
                                    <div class="control user-control">
                                        <input type="text" name="email"
                                            class="username-input input @error('email') is-invalid @enderror"
                                            placeholder="Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group psw-group">
                                    <div class="control psw-control">
                                        <input type="password" name="password"
                                            class="psw-input input @error('password') is-invalid @enderror"
                                            placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-action">
                                    <span class="forgot-psw">
                                        <a href="{{ route('forgotpassword') }}" class="forgot-psw-link">Forgot Password ?</a>
                                    </span>
                                    <span class="confirm">
                                        <button type="submit" class="confirm-btn" id="submit">
                                            <img class="confrm-link"
                                                src="{{ asset('stylecontainer/images/confirm.png') }}" alt="submit-img">
                                        </button>
                                    </span>
                                </div>
                            </div>
                        <div class="stratent-img">
                            <img src="{{ asset('stylecontainer/images/logo@1x 1.png') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            @endsection
