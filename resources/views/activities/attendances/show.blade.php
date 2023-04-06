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
      {{ trans('page.attendances.show') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="mb-4">
      {!! $attendance->isAttendanceStatus() !!}
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">

        <ul class="list-group push text-center">
          <li class="list-group-item">{{ $attendance->title }}</li>
        </ul>

        {{-- Button presence permission, not yet --}}
        {{-- Button presence permission, not yet --}}

        <ul class="list-group push text-center">
          <li class="list-group-item">
            <div class="row">
              <div class="col-md-6">
                <div class="fw-semibold text-muted">{{ trans('Jam Masuk :') }}</div>
              </div>
              <div class="col-md-6">
                <div class="fw-semibold">{{ Str::substr($attendance->start_time, 0, -3) }} - {{ Str::substr($attendance->timeout_start_time, 0, -3) }}</div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row">
              <div class="col-md-6">
                <div class="fw-semibold text-muted">{{ trans('Jam Pulang :') }}</div>
              </div>
              <div class="col-md-6">
                <div class="fw-semibold">{{ Str::substr($attendance->end_time, 0, -3) }} - {{ Str::substr($attendance->timeout_end_time, 0, -3) }}</div>
              </div>
            </div>
          </li>
          @if($attendance->studyProgram->registrations)
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-6">
                  <div class="fw-semibold text-muted">{{ trans('Status Prakerin :') }}</div>
                </div>
                <div class="col-md-6">
                  @if($attendance->studyProgram->registrationData()->status_prakerin == Constant::ACTIVE)
                    <div class="badge text-success">Active</div>
                  @else
                    <div class="badge text-danger">Inactive</div>
                  @endif
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-6">
                  <div class="fw-semibold text-muted">{{ trans('Durasi Prakerin :') }}</div>
                </div>
                <div class="col-md-6">
                  <div class="fw-semibold">{{ $attendance->studyProgram->registrationData()->duration_prakerin }}</div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-6">
                  <div class="fw-semibold text-muted">{{ trans('Jumlah Siswa :') }}</div>
                </div>
                <div class="col-md-6">
                  <div class="fw-semibold">{{ $attendance->studyProgram->registrationData()->total_student }}</div>
                </div>
              </div>
            </li>
          @endif
        </ul>

      </div>
    </div>

  </div>
</div>

<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('Daftar Absensi Siswa') }}
    </h3>
  </div>
  <div class="block-content">

    <div class="my-3">
      <div class="table-responsive p-1">
        <table class="table table-bordered table-hover table-striped table-vcenter" id="attendance-presences-table"></table>
      </div>
    </div>

  </div>
</div>
@endsection
@push('javascript')
  <script>
    let table

    $(function () {
      let attendaceShowUrl = "{{ route('attendances.show', ['attendance' => $attendance->uuid]) }}"
      table = $('#attendance-presences-table').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [
          [5, 10, 20],
          [5, 10, 20]
        ],
        ajax: {
          url: attendaceShowUrl
        },
        columns: [
          {
            "title": "No.",
            "data": "DT_RowIndex",
            "searchable": false, 
            "sortable": false,
            "class": "text-center",
            "width": "10%"
          },
          {
            "name": "student_name",
            "title": "Nama Siswa",
            "data": "student_name",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "presence_date",
            "title": "Tanggal Absen",
            "data": "presence_date",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "presence_enter_time",
            "title": "Absen Masuk",
            "data": "presence_enter_time",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "presence_out_time",
            "title": "Absen Keluar",
            "data": "presence_out_time",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "is_permission",
            "title": "Kehadiran",
            "data": "is_permission",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
        ],
      })
    })
  </script>
@endpush