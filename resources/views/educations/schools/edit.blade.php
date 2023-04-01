@extends('layouts.app')
@section('title') {{ trans('page.schools.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.schools.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.schools.edit') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('schools.index') }}" class="btn btn-block-option">
          <i class="fa fa-xs fa-chevron-left me-1"></i>
          {{ trans('page.back') }}
        </a>
      </div>
    </div>
    <div class="block-content">

      <form action="{{ route('schools.update', $school->uuid) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Sekolah') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $school->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="npsn" class="form-label">{{ trans('NPSN') }}</label>
              <input type="text" name="npsn" id="npsn" value="{{ old('npsn', $school->npsn) }}" class="form-control @error('npsn') is-invalid @enderror" placeholder="{{ trans('Input Nomor Kepala Sekolah Nasional') }}" onkeypress="return hanyaAngka(event)">
              @error('npsn')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="education" class="form-label">{{ trans('Bentuk Pendidikan') }}</label>
              <select name="education" id="education" class="form-select @error('education') is-invalid @enderror">
                <option disabled selected>{{ trans('Pilih Bentuk Pendidikan') }}</option>
                <option value="{{ Constant::SMK }}" {{ old('education', $school->education) === Constant::SMK ? 'selected' : '' }}>{{ Constant::SMK }}</option>
                <option value="{{ Constant::SMA }}" {{ old('education', $school->education) === Constant::SMA ? 'selected' : '' }}>{{ Constant::SMA }}</option>
                <option value="{{ Constant::STM }}" {{ old('education', $school->education) === Constant::STM ? 'selected' : '' }}>{{ Constant::STM }}</option>
              </select>
              @error('education')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="status" class="form-label">{{ trans('Status Sekolah') }}</label>
              <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                <option disabled selected>{{ trans('Pilih Status Sekolah') }}</option>
                <option value="{{ Constant::NEGERI }}" {{ old('status', $school->status) === Constant::NEGERI ? 'selected' : '' }}>{{ Constant::NEGERI }}</option>
                <option value="{{ Constant::SWASTA }}" {{ old('status', $school->status) === Constant::SWASTA ? 'selected' : '' }}>{{ Constant::SWASTA }}</option>
              </select>
              @error('status')
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