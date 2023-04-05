@extends('students.layouts.main')
@section('title') {{ trans('page.presences.title') }} @endsection
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="py-3 text-center">
        <h1 class="h3 fw-bold mb-2">
          {{ trans('page.presences.title') }}
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          {{ trans('page.presences.show') }}
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">{{ trans('Absensi') }}</h3>
        </div>
        <div class="block-content">
          
        </div>
      </div>

    </div>
    <div class="col-md-6">

      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">{{ trans('Info Kehadiran') }}</h3>
        </div>
        <div class="block-content">
          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Judul') }}
              <span class="fw-semibold">{{ $attendance->title }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jam Masuk') }}
              <span class="fw-semibold">{{ Str::substr($attendance->start_time, 0, -3) }} - {{ Str::substr($attendance->timeout_start_time, 0, -3) }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jam Pulang') }}
              <span class="fw-semibold">{{ Str::substr($attendance->end_time, 0, -3) }} - {{ Str::substr($attendance->timeout_end_time, 0, -3) }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">{{ trans('Info Anda') }}</h3>
        </div>
        <div class="block-content">
          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Nama') }}
              <span class="fw-semibold">{{ me()->name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Email') }}
              <span class="fw-semibold">{{ me()->email }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('No. Telepon') }}
              <span class="fw-semibold">{{ me()->phone }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Asal Sekolah') }}
              <span class="fw-semibold">{{ isStudent()->school->name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Bergabung Pada') }}
              <span class="fw-semibold">{{ me()->created_at->diffForHumans() }} ({{ customDate(me()->created_at, true) }})</span>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
@endsection