@extends('layouts.app')
@section('title') {{ trans('page.holidays.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.holidays.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('holidays.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.holidays.edit') }}
    </h3>
  </div>
  <div class="block-content">

    <form action="{{ route('holidays.update', $holiday->uuid) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="title" class="form-label">{{ trans('Agenda Kegiatan') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $holiday->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="{{ trans('Input Agenda Kegiatan') }}" onkeypress="return hanyaHuruf(event)">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="study_program_id" class="form-label">{{ trans('Program Studi') }}</label>
            <select name="study_program_id" id="study_program_id" class="js-select2 form-select @error('study_program_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Program Studi') }}" style="width: 100%;">
              <option></option>
              @foreach ($studyPrograms as $item)
                @if (old('study_program_id', $holiday->study_program_id) == $item->id)
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
            <label for="holiday_date" class="form-label">{{ trans('Pilih Tanggal') }}</label>
            <input type="date" name="holiday_date" id="holiday_date" value="{{ old('holiday_date', date('Y-m-d', strtotime($holiday->holiday_date->toDateString()))) }}" class="form-control @error('holiday_date') is-invalid @enderror">
            @error('holiday_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="description" class="form-label">{{ trans('Deskripsi') }} <em class="fs-sm text-muted">{{ trans('Opsional') }}</em></label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10" placeholder="Input Deskripsi">{{ old('description', $holiday->description) }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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