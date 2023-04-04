@extends('layouts.guest')
@section('title', 'Register Page')
@section('content')
  <div class="hero-static d-flex align-items-center">
    <div class="w-100">
      <!-- Sign Up Section -->
      <div class="bg-body-extra-light">
        <div class="content content-full">
          <div class="row g-0 justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
              <!-- Header -->
              <div class="text-center">
                <p class="mb-3">
                  {{-- <i class="fa fa-2x fa-circle-notch text-primary"></i> --}}
                  <img class="img-avatar" src="{{ asset('assets/images/polikami.png') }}" alt="">
                </p>
                <h1 class="h4  mb-1">
                  {{ trans('Buat Akun Baru') }}
                </h1>
                <p class="text-muted mb-3">
                  {{ trans('Dapatkan akses Anda hari ini dalam satu langkah mudah') }}
                </p>
              </div>
              <!-- END Header -->

              <!-- Sign Up Form -->
              <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="py-3">

                  <div class="mb-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror form-control-lg form-control-alt" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}">
                    @error('name')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror form-control-lg form-control-alt">
                      <option disabled selected>{{ trans('Jenis Kelamin') }}</option>
                      <option value="{{ Constant::MALE }}" {{ old('gender') == Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                      <option value="{{ Constant::FEMALE }}" {{ old('gender') == Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
                    </select>
                    @error('gender')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <input type="email" class="form-control @error('email') is-invalid @enderror form-control-lg form-control-alt" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror form-control-lg form-control-alt" id="phone" name="phone" placeholder="Nomor Telepon" onkeypress="return hanyaAngka(event)" value="{{ old('phone') }}">
                    @error('phone')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <input type="password" class="form-control @error('password') is-invalid @enderror form-control-lg form-control-alt" id="password" name="password" placeholder="Password">
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror form-control-lg form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Password Konfirmasi">
                    @error('password_confirmation')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <select name="school_id" id="school_id" class="js-select2 @error('school_id') is-invalid @enderror form-control-lg form-control-alt" data-placeholder="{{ trans('Asal Sekolah') }}" style="width: 100%;">
                      <option></option>
                      @foreach ($schools as $item)
                        @if (old('school_id') == $item->id)
                          <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('school_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <div class="block block-rounded">
                      <div class="block-header block-header-default">
                        <label class="form-label">{{ trans('page.image') }}</label>
                      </div>
                      <div class="block-content">
                        <div class="push">
                          <img class="img-prev img-center" src="{{ asset('assets/images/default.png') }}" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <div class="mb-4">
                    <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
                    @error('avatar')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror form-control-lg form-control-alt" placeholder="Alamat">{{ old('address') }}</textarea>
                    @error('address')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                
                <div class="mb-4">
                  <div class="row justify-content-center">
                    <div class="col-lg-6 col-xxl-5">
                      <button type="submit" class="btn w-100 btn-alt-primary">
                        <i class="fa fa-fw fa-plus me-1 opacity-50"></i>
                        {{ trans('Buat Akun') }}
                      </button>
                    </div>
                  </div>
                </div>

                <div class="fs-sm text-center text-muted py-3">
                  <span>{{ trans('Sudah memiliki akun?') }}</span>
                  <a href="{{ route('login') }}"><strong>{{ trans('Masuk Ke Aplikasi') }}</strong></a>
                </div>

              </form>
              <!-- END Sign Up Form -->
            </div>
          </div>
        </div>
      </div>
      <!-- END Sign Up Section -->

      <!-- Footer -->
      <div class="fs-sm text-center text-muted py-3">
        <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
      </div>
      <!-- END Footer -->
    </div>

  </div>
@endsection
