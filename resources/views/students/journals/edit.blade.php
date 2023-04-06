@extends('students.layouts.main')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="py-3 text-center">
        <h1 class="h3 fw-bold mb-2">
          {{ trans('page.journals.title') }}
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          {{ trans('Anda bisa mengakses halaman ini jika anda sudah melakukan absensi di Halaman absen') }} <br>
          <a href="{{ route('journals.index') }}" class="text-danger"><i class="fa fa-chevron-left fa-xs me-1"></i>{{ trans('page.back') }}</a>
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">{{ trans('page.journals.edit') }}</h3>
  </div>
  <div class="block-content">

    <div class="row justify-content-center">
      <div class="col-md-6">

        <form action="{{ route('journals.update', $journal->uuid) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-4">
            <label for="title" class="form-label">{{ trans('Materi') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $journal->title) }}" class="form-control @error('title') is-invalid @enderror" placeholder="{{ trans('Input Judul Materi') }}" onkeypress="return hanyaHuruf(event)">
            @error('title')
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
                  @isset($journal->proof)
                    <img class="img-prev img-placholder-center" src="{{ Storage::url($journal->proof) }}" alt="">
                  @else
                    <img class="img-prev img-placholder-center" src="{{ asset('assets/images/placeholder.png') }}" alt="">
                  @endisset
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <input type="hidden" name="old_proof" value="{{ $journal->proof }}">
          </div>

          <div class="mb-4">
            <label class="form-label" for="image">{{ trans('Upload Buktis') }}</label>
            <input class="form-control @error('proof') is-invalid @enderror" type="file" accept="image/*" id="image" name="proof" onchange="return previewImage()">
            @error('proof')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="description" class="form-label">{{ trans('Deskripsi') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Input Deskripsi">{{ old('description', $journal->description) }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
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