<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <meta name="keywords" content="{{config('app.name')}}">

    <title>{{config('app.name')}} | Update Password</title>

<script src="{{asset('admin/assets/js/color-modes.js')}}"></script>

<link rel="stylesheet" href="{{asset('admin/assets/vendors/core/core.css')}}">

<link rel="stylesheet" href="{{asset('admin/assets/fonts/feather-font/css/iconfont.css')}}">

<link rel="stylesheet" href="{{asset('admin/assets/css/demo1/style.css')}}">

<link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}"/>

<link rel="stylesheet" href="{{asset('css/fontawesome-free-7.0.0-web/css/all.min.css')}}">

</head>
<body>
@include('sweetalert::alert')
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <p class="text-center nobleui-logo d-block mb-2">Update Password </p>

                                    <form class="forms-sample" method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="email" value="{{ $request->email }}">
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="mb-3">
                                            <label for="otp" class="form-label">OTP</label>
                                            <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"
                                                   name="otp" value="{{ old('otp') }}" autocomplete="otp" autofocus placeholder="Enter your otp">

                                            @error('otp')
                                            <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3" style="position: relative;">
                                            <label for="password" class="form-label">New Password</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" value="{{ old('password') }}"
                                                   autocomplete="new-password"
                                                   placeholder="Enter your password"
                                                   style="padding-right: 35px;">
                                            <i class="fa fa-eye toggle-password"
                                               data-toggle="#password"
                                               style="position: absolute; top: 38px; right: 10px; cursor: pointer;"></i>
                                            @error('password')
                                            <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3" style="position: relative;">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input id="password_confirmation" type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   name="password_confirmation" value="{{ old('password_confirmation') }}"
                                                   autocomplete="new-password"
                                                   placeholder="Confirm your password"
                                                   style="padding-right: 35px;">
                                            <i class="fa fa-eye toggle-password"
                                               data-toggle="#password_confirmation"
                                               style="position: absolute; top: 38px; right: 10px; cursor: pointer;"></i>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Reset Password</button>

                                        <button type="button" class="btn btn-link" onclick="document.getElementById('resend-otp-form').submit();">Resend OTP</button>
                                    </form>

                                    <form method="POST" action="{{ route('password.email') }}" id="resend-otp-form" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $request->email }}">
                                    </form>

                                    <div class="mt-3">
                                        <a href="{{ route('adb-login') }}">Back to Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{asset('admin/assets/vendors/core/core.js')}}"></script>
<script src="{{asset('admin/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('jq-validation/jquery.validate.js')}}"></script>
<script src="{{asset('jq-validation/additional-methods.js')}}"></script>

<script>

    $(document).on('click', '.toggle-password', function () {
        let input = $($(this).attr('data-toggle'));
        let icon = $(this);

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });


    $(document).ready(function () {
        $('.forms-sample').validate({
            rules: {
                otp: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                otp: {
                    required: "Please enter your OTP"
                },
                password: {
                    required: "Please enter your new password",
                    minlength: "Password must be at least 6 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your new password",
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: 'div',
            errorClass: 'text-danger mt-1',
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>

</body>

</html>
