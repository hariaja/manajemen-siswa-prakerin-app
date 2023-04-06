@extends('layouts.app')
@section('title') {{ trans('page.registrations.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.registrations.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.registrations.show') }}
    </h3>
  </div>
  <div class="block-content">

    <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="text-center">
          <div class="mb-4">
            <span class="fw-semibold">{{ trans('Detail Data Guru') }}</span>
          </div>

          <div class="mb-4">
            <div class="my-3">
              <div class="d-flex py-3 justify-content-center">
                <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                  <img class="img-avatar" src="{{ $teacher->user->getAvatar() }}" alt="">
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
            <div class="fs-sm text-muted">{{ $teacher->school->name }}</div>
          </div>
        </div>

        <div class="text-center">
          <div class="mb-4">
            <span class="fw-semibold">{{ trans('Detail Data Pendaftaran') }}</span>
          </div>
        </div>

      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">
        
        <ul class="list-group push">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('No. Pendaftaran') }}
            <span class="fw-semibold">{{ $registration->code }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Tanggal Daftar') }}
            <span class="fw-semibold">{{ customDate($registration->register_date) }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Surat Pengantar') }}
            <span class="fw-semibold">
              <a href="{{ Storage::url($registration->note) }}" target="_blank">
                <i class="fa fa-sm fa-eye me-1"></i>
                {{ trans('Lihat Disini') }}
              </a>
            </span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Status Pendaftaran') }}
            @if ($registration->status == Constant::APPROVED)
              <span class="badge text-success">{{ Constant::APPROVED }}</span>
            @elseif ($registration->status == Constant::PENDING)
              <span class="badge text-primary">{{ Constant::PENDING }}</span>
            @else
              <span class="badge text-danger">{{ Constant::REJECTED }}</span>
            @endif
          </li>
          @if($registration->status === Constant::APPROVED)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Program Studi') }}
              <span class="fw-semibold">{{ $registration->studyProgram->name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status Prakerin') }}
              @if($registration->datas()->status_prakerin == Constant::ACTIVE)
                <div class="badge text-success">{{ trans('Active') }}</div>
              @else
                <div class="badge text-danger">{{ trans('Inactive') }}</div>
              @endif
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Durasi Prakerin') }}
              <span class="fw-semibold">{{ $registration->datas()->duration_prakerin }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jumlah Siswa') }}
              <span class="fw-semibold">{{ $registration->datas()->total_student }}</span>
            </li>
          @endif
        </ul>

        @if(isRoleName() === Constant::ADMIN)
          @if($registration->status !== Constant::APPROVED)
            <div class="text-center">
              <div class="fw-semibold mb-4">{{ trans('Ubah Status Pendaftaran') }}</div>
            </div>

            <form action="{{ route('registrations.update', $registration->uuid) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="text-center">
                <div class="mb-4">
                  <label class="form-label">{{ trans('Pilih Status') }}</label>
                  <div class="space-x-2">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-pending" name="status" value="{{ Constant::PENDING }}" {{ $registration->status == Constant::PENDING ? 'checked' : '' }}>
                      <label class="form-check-label text-primary" for="status-pending">{{ Constant::PENDING }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-approved" name="status" value="{{ Constant::APPROVED }}" {{ $registration->status == Constant::APPROVED ? 'checked' : '' }}>
                      <label class="form-check-label text-success" for="status-approved">{{ Constant::APPROVED }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status-rejected" name="status" value="{{ Constant::REJECTED }}" {{ $registration->status == Constant::REJECTED ? 'checked' : '' }}>
                      <label class="form-check-label text-danger" for="status-rejected">{{ Constant::REJECTED }}</label>
                    </div>
                  </div>
                </div>

                <div id="form-study-program" style="display: none;">
                  <div class="mb-4">
                    <label for="study_program_id" class="form-label">{{ trans('Program Studi') }}</label>
                    <select name="study_program_id" id="study_program_id" class="js-select2 form-select @error('study_program_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Program Studi') }}" style="width: 100%;">
                      <option></option>
                      @foreach ($studyPrograms as $item)
                        @if (old('study_program_id') == $item->id)
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
                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary w-100">
                    <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                    {{ trans('page.edit') }}
                  </button>
                </div>

              </div>

            </form>
          @endif
        @endif

      </div>
    </div>

    <div class="table-responsive p-1">
      <table class="table table-bordered table-hover table-striped table-vcenter students-table"></table>
    </div>

  </div>
</div>
@endsection
@push('javascript')
  <script>

    let table

    $(function () {

      let registrationUrl = @json(route('registrations.show', ['registration' => $registration->uuid]))

      table = $('.students-table').DataTable({
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
          url: registrationUrl
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
            "name": "name",
            "title": "Nama Siswa",
            "data": "name",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "account",
            "title": "Status Akun",
            "data": "account",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "school",
            "title": "Nama Sekolah",
            "data": "school",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
          {
            "name": "major",
            "title": "Jurusan",
            "data": "major",
            "class": 'text-center',
            "searchable": true,
            "orderable": true,
          },
        ],
      })

      $('input[name="status"]').change(function() {
        if ($(this).val() === 'Approved') {
          $('#form-study-program').show()
        } else {
          $('#form-study-program').hide()
          $('#study_program_id').val('')
        }
      })

    })

  </script>
@endpush