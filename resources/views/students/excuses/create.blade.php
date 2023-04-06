@extends('students.layouts.main')
@section('title') {{ trans('page.excuses.title') }} @endsection
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="py-3 text-center">
        <h1 class="h3 fw-bold mb-2">
          {{ trans('page.excuses.title') }}
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          <a href="{{ route('students.presences.show', $attendance->uuid) }}" class="text-danger"><i class="fa fa-chevron-left fa-xs me-1"></i>{{ trans('page.back') }}</a>
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">{{ trans('page.excuses.create') }}</h3>
  </div>
  <div class="block-content">

    <div class="row justify-content-center">
      <div class="col-md-6">
    
        <form action="{{ route('excuses.store', $attendance->uuid) }}" method="POST">
          @csrf

          <div class="mb-4">
            <label for="title" class="form-label">{{ trans('Alasan Tidak Hadir') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" onkeypress="return hanyaHuruf(event)">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="description" class="form-label">{{ trans('Keterangan atau Alasan Lengkap Izin') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="my-4">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('Submit') }}
            </button>
          </div>

        </form>
    
      </div>
    </div>

  </div>
</div>
@endsection