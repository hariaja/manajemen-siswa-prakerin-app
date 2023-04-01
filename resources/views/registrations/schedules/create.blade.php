@extends('layouts.app')
@section('title') {{ trans('page.schedules.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.schedules.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.schedules.create') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('schedules.index') }}" class="btn btn-sm btn-block-option">
          <i class="fa fa-chevron-left me-2"></i>
          {{ trans('page.back') }}
        </a>
      </div>
    </div>
    <div class="block-content">

      <form action="{{ route('schedules.store') }}" method="POST">
        @csrf

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="title" class="form-label">{{ trans('Batch') }}</label>
              <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="{{ trans('Etc. Gelombang IV') }}">
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="start" class="form-label">{{ trans('Tanggal Dibuka') }}</label>
              <input type="date" name="start" id="start" value="{{ old('start') }}" class="form-control @error('start') is-invalid @enderror">
              @error('start')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-4">
              <label for="end" class="form-label">{{ trans('Tanggal Ditutup') }}</label>
              <input type="date" name="end" id="end" value="{{ old('end') }}" class="form-control @error('end') is-invalid @enderror">
              @error('end')
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