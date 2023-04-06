@extends('layouts.app')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.journals.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('journals.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.journals.edit') }}
    </h3>
  </div>
  <div class="block-content">

    <div class="row justify-content-center">
      <div class="col-md-6">

        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Materi') }}
            <div class="fw-semibold">
              {{ $journal->title }}
            </div>
          </li>
          {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Deskripsi') }}
            <div class="fw-semibold">
              {{ $journal->description }}
            </div>
          </li> --}}
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Upload At') }}
            <div class="fw-semibold">
              {{ $journal->created_at->diffForHumans() }}
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Bukti') }}
            <div class="fw-semibold">
              <a href="{{ Storage::url($journal->proof) }}" target="_blank" rel="noopener noreferrer">
                <i class="fa fa-eye fa-xs me-1"></i>
                {{ trans('Lihat Disini') }}
              </a>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Status') }}
            {!! $journal->isStatus() !!}
          </li>
        </ul>

        @if(me()->hasRole(Constant::MENTOR))
          <div class="mb-4">
            <div class="fw-semibold text-center">
              {{ trans('Ubah Status') }}
            </div>
          </div>

          <form action="{{ route('journals.status', $journal->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="text-center">
              <div class="mb-4">
                <label class="form-label">{{ trans('Pilih Status') }}</label>
                <div class="space-x-2">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="status-pending" name="status" value="{{ Constant::PENDING }}" {{ $journal->status == Constant::PENDING ? 'checked' : '' }}>
                    <label class="form-check-label text-primary" for="status-pending">{{ Constant::PENDING }}</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="status-approved" name="status" value="{{ Constant::APPROVED }}" {{ $journal->status == Constant::APPROVED ? 'checked' : '' }}>
                    <label class="form-check-label text-success" for="status-approved">{{ Constant::APPROVED }}</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="status-rejected" name="status" value="{{ Constant::REJECTED }}" {{ $journal->status == Constant::REJECTED ? 'checked' : '' }}>
                    <label class="form-check-label text-danger" for="status-rejected">{{ Constant::REJECTED }}</label>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <button type="submit" class="btn btn-primary w-100">
                  <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                  {{ trans('page.edit') }}
                </button>
              </div>

            </form>

        @endif

      </div>
    </div>

  </div>
</div>
@endsection