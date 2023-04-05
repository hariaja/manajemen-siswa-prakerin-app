@extends('layouts.app')
@section('title') {{ trans('page.attendances.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.attendances.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('attendances.index') }}" class="btn btn-sm btn-block-option text-danger">
              <i class="fa fa-xs fa-chevron-left me-1"></i>
              {{ trans('page.back') }}
            </a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.attendances.create') }}
    </h3>
  </div>
  <div class="block-content">

    <form action="{{ route('attendances.store') }}" method="POST">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <div class="fw-semibold text-center">Prodi</div>
            <div class="fw-semibold text-center">{{ isLeader()->studyProgram->name }}</div>
          </div>

          <div class="mb-4">
            <input type="hidden" name="study_program_id" value="{{ isLeader()->studyProgram->id }}" class="form-control">
          </div>

          <div class="mb-4">
            <label for="title" class="form-label">{{ trans('Abensi') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="{{ trans('Input Judul Absensi') }}" onkeypress="return hanyaHuruf(event)">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="start_time" class="form-label">{{ trans('Jam Masuk') }}</label>
            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="form-control @error('start_time') is-invalid @enderror">
            @error('start_time')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>

          <div class="mb-4">
            <label for="timeout_start_time" class="form-label">{{ trans('Batas Absen Jam Masuk') }}</label>
            <input type="time" name="timeout_start_time" id="timeout_start_time" value="{{ old('timeout_start_time') }}" class="form-control @error('timeout_start_time') is-invalid @enderror">
            @error('timeout_start_time')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>

          <div class="mb-4">
            <label for="end_time" class="form-label">{{ trans('Jam Pulang') }}</label>
            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="form-control @error('end_time') is-invalid @enderror">
            @error('end_time')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>

          <div class="mb-4">
            <label for="timeout_end_time" class="form-label">{{ trans('Batas Absen Jam Pulang') }}</label>
            <input type="time" name="timeout_end_time" id="timeout_end_time" value="{{ old('timeout_end_time') }}" class="form-control @error('timeout_end_time') is-invalid @enderror">
            @error('timeout_end_time')
              <span class="invalid-feedback" role="alert">
                {{ $message }}
              </span>
            @enderror
          </div>

          <div class="mb-4">
            <label for="description" class="form-label">{{ trans('Deskripsi') }} <em class="fs-sm text-muted">{{ trans('Opsional') }}</em></label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Input Deskripsi">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.create') }}
            </button>
          </div>

        </div>
      </div>
    
    </form>

  </div>
</div>
@endsection