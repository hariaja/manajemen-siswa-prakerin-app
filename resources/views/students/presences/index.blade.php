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
          {{ trans('Lakukan absensi sesuai dengan jadwal yang tersedia') }}
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="row justify-content-center">
  @forelse ($attendances as $attendance)
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <a class="block block-rounded block-link-pop" href="{{ route('presences.show', $attendance->uuid) }}">
        <div class="block-content block-content-full">
          <div class="text-center">
            <div class="fs-sm fw-semibold text-uppercase text-muted">
              {!! $attendance->isAttendanceStatus() !!} - {{ 'Prodi: ' . $attendance->studyProgram->name }}
            </div>
            <div class="fs-2 fw-normal text-dark">
              {{ $attendance->title }}
            </div>
          </div>
        </div>
      </a>
    </div>
  @empty
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full">
          <div class="fs-2 fw-normal text-dark text-center">{{ trans('Data tidak tersedia atau belum ditambahkan') }}</div>
        </div>
      </a>
    </div>
  @endforelse
</div>
@endsection