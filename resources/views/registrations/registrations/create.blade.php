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
  <form action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          {{ trans('page.registrations.create') }}
        </h3>
      </div>
      <div class="block-content">
  
        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Pendaftar') }}</label>
              <input type="text" id="name" value="{{ me()->name }}" class="form-control" readonly>
            </div>
    
            <div class="mb-4">
              <label for="school" class="form-label">{{ trans('Asal Sekolah') }}</label>
              <input type="text" id="school" value="{{ $teacher->school->name }}" class="form-control" readonly>
            </div>
  
            <div class="mb-4">
              <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id }}" class="form-control">
            </div>
    
            @isset($schedules)
              <div class="mb-4">
                <label for="date" class="form-label">{{ trans('Tanggal Daftar') }}</label>
                <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d', strtotime(now()->toDateString()))) }}" class="form-control @error('date') is-invalid @enderror" readonly>
                @error('date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            @endisset
    
            <div class="mb-4">
              <label for="schedule_id" class="form-label">{{ trans('Jadwal Aktif') }}</label>
              <select name="schedule_id" id="schedule_id" class="js-select2 form-select @error('schedule_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Jadwal Aktif') }}" style="width: 100%;">
                <option></option>
                @foreach ($schedules as $item)
                  @if (old('schedule_id') == $item->id)
                    <option value="{{ $item->id }}" data-uuid="{{ $item->uuid }}" selected>{{ $item->title }}</option>
                  @else
                    <option value="{{ $item->id }}" data-uuid="{{ $item->uuid }}">{{ $item->title }}</option>
                  @endif
                @endforeach
              </select>
              <div class="my-2 schedule">
                <span class="fw-semibold text-center" id="schedule-start"></span><br>
                <span class="fw-semibold text-center" id="schedule-end"></span>
              </div>
              @error('schedule_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label class="form-label" for="note">{{ trans('Upload Surat Pendaftaran') }}</label>
              <input class="form-control @error('note') is-invalid @enderror" type="file" accept="application/pdf" id="note" name="note">
              @error('note')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <div class="text-center">
                <div class="fw-semibold">{{ trans('Pilih Calon Peserta Prakerin') }}</div>
                <div class="fs-sm text-muted">{!! 'Menampilkan <strong>' . $students->count() . '</strong> Siswa dari <strong>' . $students->total() . '</strong> Siswa yang tersedia' !!}</div>
                <div class="fs-sm text-muted">
                  {{ $students->links('pagination::bootstrap-5') }}
                </div>
              </div>

            </div>

            @if(count($students) > 0)
              <div class="mb-4">
                <div class="space-y-2">
                  <div class="form-check">
                    <input type="checkbox" name="all_students" id="all_students" class="form-check-input @error('students') is-invalid @enderror">
                    <label for="all_students" class="form-check-label">{{ trans('Pilih Semua Siswa') }}</label>
                    @error('student')
                      <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
            @endif

            <div class="mb-4">
              <div class="row items-push justify-content-center">
                @forelse ($students as $student)
                  <div class="col-md-6">
                    <div class="form-check form-block">
                      <input class="student form-check-input @error('student') is-invalid @enderror" name="student[{{ $student->id }}]" id="student-{{ $student->id }}" type="checkbox" value="{{ $student->id }}">
                      <label class="form-check-label" for="student-{{ $student->id }}">
                        <span class="d-flex align-items-center">
                          <img class="img-avatar img-avatar48" src="{{ $student->user->getAvatar() }}" alt="">
                          <span class="ms-2">
                            <span class="fw-bold">{{ $student->user->name }}</span>
                            <span class="d-block fs-sm text-muted">{{ $student->nisn }}</span>
                          </span>
                        </span>
                      </label>
                    </div>
                  </div>
                @empty
                  <div class="col-md-6">
                    <div class="border border-1 p-3">
                      <div class="text-center">
                        <span class="fw-semibold">
                          {{ trans('Data siswa tidak tersedia atau anda sudah mendaftarkan semua siswa') }}
                        </span>
                      </div>
                    </div>
                  </div>
                @endforelse
              </div>
            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-primary w-100">
                <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                {{ trans('page.create') }}
              </button>
            </div>

          </div>
        </div>
  
      </div>
    </div>

  </form>
@endsection
@push('javascript')
  <script>

    $(document).ready(function () {

      $('.schedule').hide()

      $('#schedule_id').change(function () {
        var schedule_uuid = $(this).children(':selected').data('uuid')
        if (schedule_uuid) {
          $.ajax({
            url: '/schedules/' + schedule_uuid,
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
              $('.schedule').show()
              $('#schedule-start').text('Dibuka Pada: ' + data.new_start)
              $('#schedule-end').text('Ditutup Pada: ' + data.new_end)
            }
          })
        }
      })

      $('[name="all_students"]').on('click', function() {
        if($(this).is(':checked')) {
          $.each($('.student'), function() {
            $(this).prop('checked',true);
          });
        } else {
          $.each($('.student'), function() {
            $(this).prop('checked', false);
          });
        }
      });

    })

  </script>
@endpush