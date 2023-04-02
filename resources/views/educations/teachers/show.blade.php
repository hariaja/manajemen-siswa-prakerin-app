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
        {{ trans('page.teachers.show') }}
      </h3>
      <div class="block-options">
        <a href="{{ route('teachers.index') }}" class="btn btn-block-option">
          <i class="fa fa-xs fa-chevron-left me-1"></i>
          {{ trans('page.back') }}
        </a>
      </div>
    </div>
    <div class="block-content">

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="text-center mb-4">
            <div class="my-3">
              <div class="d-flex py-3 justify-content-center">
                <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                  <img class="img-avatar " src="{{ $teacher->user->getAvatar() }}" alt="">
                  @if($teacher->user->hasVerifiedEmail())
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                  @else
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-danger"></span>
                  @endif
                </div>
              </div>
            </div>
            <div class="fw-semibold">{{ $teacher->user->name }}</div>
            <div class="fs-sm text-muted">{{ $teacher->user->isRoleName() == Constant::TEACHER ? 'Guru' : '-' }}</div>
            <div class="fs-sm text-muted">{{ $teacher->nidn }}</div>
          </div>

        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Asal Sekolah') }}
              <span class="fw-semibold">{{ $teacher->school->name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status Akun') }}
              {!! $teacher->user->isStatus() !!}
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status Verifikasi') }}
              {!! $teacher->user->isVerified() !!}
            </li>
          </ul>

        </div>
        <div class="col-md-6">
          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Email') }}
              <span class="fw-semibold">{{ $teacher->user->email }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Nomor Telepon') }}
              <span class="fw-semibold">{{ $teacher->user->phone }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jenis Kelamin') }}
              <span class="fw-semibold">{{ $teacher->gender }}</span>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
@endsection