@extends('layouts.guest')
@section('title', 'Login Page')

@section('content')
  <!-- Page Content -->
  <div class="hero-static d-flex align-items-center">
    <div class="content">
      <div class="row justify-content-center push">
        <div class="col-md-8 col-lg-6 col-xl-4">
          <!-- Sign In Block -->
          <div class="block block-rounded mb-0">
            <div class="block-header block-header-default">
              <h3 class="block-title">{{ trans('Masuk ke Akun') }}</h3>
              <div class="block-options">
                @if (Route::has('password.request'))
                  <a class="btn-block-option" href="{{ route('password.request') }}">{{ trans('Lupa Kata Sandi?') }}</a>
                @endif
                <a class="btn-block-option" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="New Account">
                  <i class="fa fa-user-plus"></i>
                </a>
              </div>
            </div>
            <div class="block-content">
              <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                <h1 class="h2 mb-1">{{ trans('Masuk ke Akun') }}</h1>
                <p class="fw-medium text-muted">
                  {{ trans('Masukkan email & kata sandi Anda untuk login') }}
                </p>

                <!-- Sign In Form -->
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="py-3">
                    <div class="mb-4">
                      <div class="input-group input-group-lg">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        <span class="input-group-text">
                          <i class="fa fa-envelope"></i>
                        </span>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="input-group input-group-lg">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                        <span class="input-group-text">
                          <i class="fa fa-lock"></i>
                        </span>
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ trans('Ingat Saya') }}</label>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-6 col-xl-5">
                      <button type="submit" class="btn w-100 btn-alt-primary">
                        <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i>
                        {{ trans('Masuk') }}
                      </button>
                    </div>
                  </div>
                </form>
                <!-- END Sign In Form -->
              </div>
            </div>
          </div>
          <!-- END Sign In Block -->
        </div>
      </div>
      <div class="fs-sm text-muted text-center">
        <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
@endsection
