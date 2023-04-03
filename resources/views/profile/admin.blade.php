@extends('layouts.app')
@section('title', trans('Profile Saya'))
@section('hero')
<!-- Hero -->
<div class="bg-image" style="background-image: url('{{ asset('assets/src/media/photos/photo10@2x.jpg') }}');">
  <div class="bg-primary-dark-op">
    <div class="content content-full text-center">
      <div class="my-3">
        <img class="img-avatar img-avatar-thumb" src="{{ $user->getAvatar() }}" alt="">
      </div>
      <h1 class="h2 text-white mb-0">{{ $user->name }}</h1>
      <h2 class="h4 fw-normal text-white-75">{{ $user->isRoleName() }}</h2>
      <a class="btn btn-alt-secondary" href="{{ route('home') }}">
        <i class="fa fa-fw fa-arrow-left text-danger"></i>
        {{ trans('Back to Dashboard') }}
      </a>
    </div>
  </div>
</div>
<!-- END Hero -->
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">{{ trans('page.users.show') }}</h3>
  </div>
  <div class="block-content">
    <form action="{{ route('users.update', $user->uuid) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div class="row push">
        <div class="col-lg-4">
          <p class="fs-sm text-muted">
            {{ trans('Info penting akun Anda. Email Anda akan terlihat oleh publik.') }}
          </p>
        </div>
        <div class="col-lg-8 col-xl-5">
          <div class="mb-4">
            <label for="name" class="form-label">{{ trans('Nama') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="email" class="form-label">{{ trans('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Pembimbing') }}" readonly>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
            @error('phone')
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
                  @isset($user->avatar)
                    <img class="img-prev img-center" src="{{ $user->getAvatar() }}" alt="">
                  @else
                    <img class="img-prev img-center" src="{{ asset('assets/images/default.png') }}" alt="">
                  @endisset
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">
          </div>

          <div class="mb-4">
            <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
            <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
            @error('avatar')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="my-4">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.edit') }}
            </button>
          </div>

        </div>
      </div>
    </form>
  </div>
</div>
@endsection