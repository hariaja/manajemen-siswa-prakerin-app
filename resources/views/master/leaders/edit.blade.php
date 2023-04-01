@extends('layouts.app')
@section('title') {{ trans('page.leaders.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.leaders.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.leaders.edit') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('leaders.index') }}" class="btn btn-block-option">
          <i class="fa fa-xs fa-chevron-left me-1"></i>
          {{ trans('page.back') }}
        </a>
      </div>
    </div>
    <div class="block-content">

      <form action="{{ route('leaders.update', $leader->uuid) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Dosen') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $leader->user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" value="{{ old('email', $leader->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Dosen') }}" readonly>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="nidn" class="form-label">{{ trans('NIDN') }}</label>
              <input type="text" name="nidn" id="nidn" value="{{ old('nidn', $leader->nidn) }}" class="form-control @error('nidn') is-invalid @enderror" placeholder="{{ trans('Input Nomor Induk Dosen Nasional') }}" onkeypress="return hanyaAngka(event)">
              @error('nidn')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
              <input type="text" name="phone" id="phone" value="{{ old('phone', $leader->user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="{{ Constant::MALE }}" {{ old('gender', $leader->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                <option value="{{ Constant::FEMALE }}" {{ old('gender', $leader->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
              </select>
              @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="study_program_id" class="form-label">{{ trans('Program Studi') }}</label>
              <select name="study_program_id" id="study_program_id" class="js-select2 form-select @error('study_program_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Program Studi') }}" style="width: 100%;">
                <option></option>
                @foreach ($studyPrograms as $item)
                  @if (old('study_program_id', $leader->study_program_id) == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endif
                @endforeach
              </select>
              @error('study_program_id')
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
                    @isset($leader->user->avatar)
                      <img class="img-prev img-center" src="{{ $leader->user->getAvatar() }}" alt="">
                    @else
                      <img class="img-prev img-center" src="{{ asset('assets/images/default.png') }}" alt="">
                    @endisset
                  </div>
                </div>
              </div>
            </div>

            <div class="mb-4">
              <input type="hidden" name="old_avatar" value="{{ $leader->user->avatar }}">
            </div>

            <div class="mb-4">
              <label class="form-label" for="image">{{ trans('Upload File') }}</label>
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