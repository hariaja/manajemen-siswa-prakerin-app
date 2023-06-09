@extends('layouts.app')
@section('title') {{ trans('page.study-programs.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.study-programs.title') }}</h1>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.study-programs.edit') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('study-programs.index') }}" class="btn btn-sm btn-block-option">
          <i class="fa fa-sm fa-chevron-left me-1"></i>
          {{ trans('page.back') }}
        </a>
      </div>
    </div>
    <div class="block-content">

      <form action="{{ route('study-programs.update', $studyProgram->uuid) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Program Studi') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $studyProgram->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="status" class="form-label">{{ trans('Status Keaktifan') }}</label>
              <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                <option disabled selected>{{ trans('Pilih Status') }}</option>
                <option value="{{ Constant::ACTIVE }}" {{ old('status', $studyProgram->status) == Constant::ACTIVE ? 'selected' : '' }}>{{ trans('Active') }}</option>
                <option value="{{ Constant::INACTIVE }}" {{ old('status', $studyProgram->status) == Constant::INACTIVE ? 'selected' : '' }}>{{ trans('Inactive') }}</option>
              </select>
            </div>

            <div class="mb-4">
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