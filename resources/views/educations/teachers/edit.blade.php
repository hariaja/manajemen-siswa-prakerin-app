@extends('layouts.app')
@section('title') {{ trans('page.teachers.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.teachers.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.teachers.edit') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('teachers.index') }}" class="btn btn-block-option">
          <i class="fa fa-xs fa-chevron-left me-1"></i>
          {{ trans('page.back') }}
        </a>
      </div>
    </div>
    <div class="block-content">

      <form action="{{ route('teachers.update', $teacher->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Lengkap') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $teacher->user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" value="{{ old('email', $teacher->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Pembimbing') }}" readonly>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
              <input type="text" name="phone" id="phone" value="{{ old('phone', $teacher->user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="{{ Constant::MALE }}" {{ old('gender', $teacher->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                <option value="{{ Constant::FEMALE }}" {{ old('gender', $teacher->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
              </select>
              @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="school_id" class="form-label">{{ trans('Asal Sekolah') }}</label>
              <select name="school_id" id="school_id" class="js-select2 form-select @error('school_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Asal Sekolah') }}" style="width: 100%;">
                <option></option>
                @foreach ($schools as $item)
                  @if (old('school_id', $teacher->school_id) == $item->id)
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
                    @isset($teacher->user->avatar)
                      <img class="img-prev img-center" src="{{ $teacher->user->getAvatar() }}" alt="">
                    @else
                      <img class="img-prev img-center" src="{{ asset('assets/images/default.png') }}" alt="">
                    @endisset
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <input type="hidden" name="old_avatar" value="{{ $teacher->user->avatar }}">
            </div>

            <div class="mb-4">
              <label class="form-label" for="image">{{ trans('Upload File') }}</label>
              <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
              @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
              <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror">{{ old('address', $teacher->address) }}</textarea>
              @error('address')
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