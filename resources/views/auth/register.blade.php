@extends('layouts.app', [
    'class' => 'register-page',
    'backgroundImagePath' => 'img/login template.jpg'
])

@section('content')
<div class="page-header align-items-center min-vh-100 pt-5 pb-100 m-0 border-radius-lg" style="background-image: url('../img/login template.jpg'); background-size: cover; background-repeat: no-repeat;">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                 <div class="col-lg-0 col-md-4">
                    <div class="info-area info-horizontal mt-5">
                        <div class="description">
                            <h5 class="info-title">{{ __('') }}</h5>
                            <p class="description">
                                {{ __('') }}
                            </p>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="description">
                            <h5 class="info-title">{{ __('') }}</h5>
                            <p class="description">
                                {{ __('') }}
                            </p>
                        </div>
                    </div>
                    <div class="info-area info-horizontal">
                        <div class="description">
                            <h5 class="info-title">{{ __('') }}</h5>
                            <p class="description">
                                {{ __('') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mr-auto">
                    <div class="card card-signup text-center">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Create Account') }}</h4>
                            <div class="social">
                                <button class="btn btn-icon btn-round btn-facebook">
                                    <i class="fa fa-facebook"></i>
                                </button>
                                <button class="btn btn-icon btn-round btn-wechat">
                                    <i class="fa fa-wechat"></i>
                                </button>
                                <button class="btn btn-icon btn-round btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                </button>
                                <p class="card-description">{{ __('') }}</p>
                            </div>
                        </div>
                        <div class="card-body ">
                            <form class="form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-single-02"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-email-85"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="nc-icon nc-key-25"></i>
                                        </span>
                                    </div>
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Password Confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-check text-left">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="agree_terms_and_conditions" type="checkbox">
                                        <span class="form-check-sign"></span>
                                            {{ __('I agree to the') }}
                                        <a href="#something">{{ __('terms and conditions') }}</a>.
                                    </label>
                                    @if ($errors->has('agree_terms_and_conditions'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('agree_terms_and_conditions') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="password-alert" class="alert alert-danger" style="display: none;" role="alert">
                                    Password must contain at least one uppercase letter, one lowercase letter, one number, and be at least 8 characters long.
                                </div>
                                <div class="card-footer ">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Get Started') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div> 
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                var password = $('input[name="password"]').val();
                var passwordConfirmation = $('input[name="password_confirmation"]').val();
                var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

                if (!passwordPattern.test(password)) {
                    $('#password-alert').show();
                    event.preventDefault();
                } else {
                    $('#password-alert').hide();
                }
            });
        });
    </script>
@endpush
