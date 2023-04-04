@extends('layouts.app')
@section('title') {{ trans('page.students.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.students.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('students.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.students.edit') }}
    </h3>
  </div>
  <div class="block-content">

    <form action="{{ route('students.update', $student->uuid) }}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="nisn" class="form-label">{{ trans('Nisn') }}</label>
            <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $student->nisn) }}" class="form-control @error('nisn') is-invalid @enderror" placeholder="{{ trans('Input Nomor Induk Siswa Nasional') }}" onkeypress="return hanyaAngka(event)">
            @error('nisn')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="name" class="form-label">{{ trans('Nama Lengkap') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $student->user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="email" class="form-label">{{ trans('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email', $student->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Input Email Siswa') }}" readonly>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="phone" class="form-label">{{ trans('Nomor Telepon') }}</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $student->user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Input Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="gender" class="form-label">{{ trans('Jenis Kelamin') }}</label>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
              <option disabled selected>{{ trans('Pilih Jenis Kelamin') }}</option>
              <option value="{{ Constant::MALE }}" {{ old('gender', $student->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
              <option value="{{ Constant::FEMALE }}" {{ old('gender', $student->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
            </select>
            @error('gender')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <input type="hidden" class="form-control" id="school_id" name="school_id" value="{{ $teacher->school_id }}" readonly>
          </div>

          <div class="mb-4">
            <label for="school_name" class="form-label">{{ trans('Asal Sekolah') }}</label>
            <input type="text" name="school_name" id="school_name" value="{{ $teacher->school->name }}" class="form-control @error('school_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)" readonly>
            <div class="my-2">
              <span class="text-muted">{{ trans('Asal sekolah akan menyesuaikan dengan asal sekolah anda') }}</span>
            </div>
            @error('school_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="date_birth" class="form-label">{{ trans('Tanggal Lahir') }}</label>
            <input type="date" name="date_birth" id="date_birth" value="{{ old('date_birth', date('Y-m-d', strtotime($student->date_birth->toDateString()))) }}" class="form-control @error('date_birth') is-invalid @enderror">
            @error('date_birth')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="major" class="form-label">{{ trans('Jurusan') }}</label>
            <input type="text" name="major" id="major" value="{{ old('major', $student->major) }}" class="form-control @error('major') is-invalid @enderror" placeholder="{{ trans('Etc. Teknik Komputer Jaringan') }}" onkeypress="return hanyaHuruf(event)">
            @error('major')
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
                  @isset($student->user->avatar)
                    <img class="img-prev img-center" src="{{ $student->user->getAvatar() }}" alt="">
                  @else
                    <img class="img-prev img-center" src="{{ asset('assets/images/default.png') }}" alt="">
                  @endisset
                </div>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <input type="hidden" name="old_avatar" value="{{ $student->user->avatar }}">
          </div>

          <div class="mb-4">
            <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
            <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
            @error('avatar')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="address" class="form-label">{{ trans('Alamat') }}</label>
            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30" rows="10" placeholder="Input Alamat Lengkap">{{ old('address', $student->address) }}</textarea>
            @error('address')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="my-4">
            <button type="submit" class="btn btn-primary w-100">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.edit') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection