@extends('containerlayouts.index')
@section('title', 'Register Page')
@section('logincontent')

    <div class="login-wrapper">
        <div class="login-container">
            <div class="title">
                <img class="title_img" src="{{ asset('stylecontainer/images/A15-containerservices-tekst 1.png') }}"
                    alt="title">
            </div>
            <div class="rtrack-logo_img">
                <img class="track-img" src="{{ asset('stylecontainer/images/rtrack_logo_img.png') }}" alt="title">
            </div>
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="form-group">
                                <div class="input-group username-group">
                                    <div class="control user-control">
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your name"
                                            class="username-input input @error('name') is-invalid @enderror"
                                            required autocomplete="name" autofocus splaceholder="Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group username-group">
                                    <div class="control user-control">
                                        <input type="text" name="email" id="email"
                                            class="username-input input @error('email') is-invalid @enderror" placeholder="Enter your Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group username-group">
                                    <div class="control username-control">
                                        <input type="password" name="password" id="password" placeholder="Enter Password"
                                            class="username-input input @error('password') is-invalid @enderror"  required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="input-group psw-group">
                                    <div class="control psw-control">
                                        <input type="password" name="password_confirmation" id="password-confirm" placeholder="Enter confirm Password"
                                            class="psw-input input @error('password') is-invalid @enderror"  required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-action">
                                    <span class="confirm">
                                        <button type="submit" class="confirm-btn" id="submit">
                                            <img class="confrm-link"
                                                src="{{ asset('stylecontainer/images/confirm.png') }}" alt="submit-img">
                                        </button>
                                    </span>
                                </div>
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
