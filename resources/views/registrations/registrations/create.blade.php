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
        <div class="block-options">
          <a href="#" class="btn btn-sm btn-block-option" onclick="newForms()">
            <i class="fa fa-xs fa-plus me-1"></i>
            {{ trans('Tambah Data Siswa') }}
          </a>
        </div>
      </div>
      <div class="block-content">
  
        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Pendaftar') }}</label>
              <input type="text" id="name" value="{{ me()->name }}" class="form-control" readonly>
            </div>
    
            @foreach (me()->teachers as $data)
              <div class="mb-4">
                <label for="school" class="form-label">{{ trans('Asal Sekolah') }}</label>
                <input type="text" id="school" value="{{ $data->school->name }}" class="form-control" readonly>
              </div>
    
              <div class="mb-4">
                <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $data->id }}" class="form-control">
                <input type="hidden" name="school_id" id="school_id" value="{{ $data->school->id }}" class="form-control">
              </div>
            @endforeach
    
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

          </div>
        </div>
  
      </div>
    </div>

    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">
          {{ trans('page.students.create') }}
        </h3>
      </div>
      <div class="block-content">

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama Siswa') }}</label>
              <input type="text" name="name[]" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email[]" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Siswa') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label for="nisn" class="form-label">{{ trans('NISN') }}</label>
              <input type="text" name="nisn[]" id="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="{{ trans('Input Nomor Induk Siswa Nasional') }}" onkeypress="return hanyaAngka(event)">
              @error('nisn')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
              <input type="text" name="phone[]" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
    
            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
              <select name="gender[]" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="{{ Constant::MALE }}">{{ Constant::MALE }}</option>
                <option value="{{ Constant::FEMALE }}">{{ Constant::FEMALE }}</option>
              </select>
              @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="date_birth" class="form-label">{{ trans('Tanggal Lahir') }}</label>
              <input type="date" name="date_birth[]" id="date_birth" class="form-control @error('date_birth') is-invalid @enderror">
              @error('date_birth')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- value="{{ old('date_birth') }}" --}}

            <div class="mb-4">
              <label for="class" class="form-label">{{ trans('Kelas') }}</label>
              <input type="text" name="class[]" id="class" class="form-control @error('class') is-invalid @enderror" placeholder="Contoh: XII - RPL">
              @error('class')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

          </div>

        </div>

      </div>
    </div>

    <div id="new-form">
      <template id="students-form">

        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">
              {{ trans('page.students.create') }}
            </h3>
          </div>
          <div class="block-content">

            <div class="row justify-content-center">
              <div class="col-md-6">
    
                <div class="mb-4">
                  <label for="name" class="form-label">{{ trans('Nama Siswa') }}</label>
                  <input type="text" name="name[]" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
        
                <div class="mb-4">
                  <label for="email" class="form-label">{{ trans('Email') }}</label>
                  <input type="email" name="email[]" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Siswa') }}">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
        
                <div class="mb-4">
                  <label for="nisn" class="form-label">{{ trans('NISN') }}</label>
                  <input type="text" name="nisn[]" id="nisn" value="{{ old('nisn') }}" class="form-control @error('nisn') is-invalid @enderror" placeholder="{{ trans('Input Nomor Induk Siswa Nasional') }}" onkeypress="return hanyaAngka(event)">
                  @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-4">
                  <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
                  <input type="text" name="phone[]" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
        
                <div class="mb-4">
                  <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
                  <select name="gender[]" id="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
                    <option value="{{ Constant::MALE }}" {{ old('gender') === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                    <option value="{{ Constant::FEMALE }}" {{ old('gender') === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-4">
                  <label for="date_birth" class="form-label">{{ trans('Tanggal Lahir') }}</label>
                  <input type="date" name="date_birth[]" id="date_birth" value="{{ old('date_birth') }}" class="form-control @error('date_birth') is-invalid @enderror">
                  @error('date_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
    
                <div class="mb-4">
                  <label for="class" class="form-label">{{ trans('Kelas') }}</label>
                  <input type="text" name="class[]" id="class" class="form-control @error('class') is-invalid @enderror" placeholder="Contoh: XII - RPL" value="{{ old('class') }}">
                  @error('class')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

              </div>
            </div>

          </div>
        </div>

      </template>
    </div>

    <div class="mb-4">
      <button type="submit" class="btn btn-primary w-100">
        <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
        {{ trans('page.create') }}
      </button>
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

    })

    function newForms() {
      var newForm = document.getElementById('new-form')
      var studentsForm = document.getElementById('students-form')
      var cloneForms = studentsForm.content.cloneNode(true)
      newForm.appendChild(cloneForms)
    }

  </script>
@endpush