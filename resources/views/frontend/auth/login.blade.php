@extends('frontend.layouts.app')

@section('frontend.content')

<div id="login-page" class="page">
    <div class="auth-container d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card auth-card">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2><i class="fas fa-blog text-primary"></i> My Blog</h2>
                                <p class="text-muted">Welcome back! Please sign in to your account</p>
                            </div>

                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-decoration-none small">Forgot Password?</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-sign-in-alt"></i> Sign In
                                </button>
                            </form>

                            <div class="text-center mb-3">
                                <small class="text-muted">── Or continue with ──</small>
                            </div>

                            <!-- Social Login Buttons -->
                            <div class="row g-2">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary social-btn facebook text-white w-100">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-info social-btn twitter text-white w-100">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-danger social-btn google text-white w-100">
                                        <i class="fab fa-google"></i> Google
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-dark social-btn github text-white w-100">
                                        <i class="fab fa-github"></i> GitHub
                                    </button>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="text-center">
                                <small>Don't have an account?
                                    <a href="#" class="text-decoration-none fw-bold" onclick="showSignup()">Sign up here</a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
