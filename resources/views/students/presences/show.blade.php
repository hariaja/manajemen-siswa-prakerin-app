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

          @if($holiday)
            <div class="mb-4">
              <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div class="flex-shrink-0">
                  <i class="fa fa-fw fa-times"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                  <p class="mb-0">{{ trans('Hari Ini Adalah Hari Libur.') }}</p>
                </div>
              </div>
            </div>
          @else

            @if(!$datas['is_there_permission'])
              
              @if($attendance->data->is_start && !$datas['is_has_enter_today'])
                <div class="mb-4">
                  <a href="{{ route('students.presences.store', $attendance->uuid) }}" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('presence-in').submit();">{{ trans('Absen Masuk Sekarang Juga') }}</a>

                  <a href="{{ route('excuses.create', $attendance->uuid) }}" class="btn btn-info">{{ trans('Izin Tidak Hadir') }}</a>

                  <form id="presence-in" action="{{ route('students.presences.store', $attendance->uuid) }}" method="POST">
                    @csrf
                  </form>
                </div>
        
                <div class="text-muted text-center mb-4">
                  <strong>{{ trans('Anda akan bisa membuka Halaman Jurnal Praktik Kerja Lapangan jika sudah melakukan absensi masuk pada hari ini.') }}</strong>
                </div>
              @endif

              @if($datas['is_has_enter_today'])
                <div class="mb-4">
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-check"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">{{ trans('Anda sudah berhasil mengirim absensi masuk.') }}</p>
                    </div>
                  </div>
                </div>
              @endif
  
              @if($attendance->data->is_end && $datas['is_has_enter_today'] && $datas['is_not_out_yet'])
                <div class="mb-4">
                  <a href="{{ route('students.presences.update', $attendance->uuid) }}" class="btn btn-warning text-white" onclick="event.preventDefault(); document.getElementById('presence-out').submit();">Checkout Pulang Sekarang Juga</a>
                  <form id="presence-out" action="{{ route('students.presences.update', $attendance->uuid) }}" method="POST">
                    @csrf
                  </form>
                </div>
              @endif
  
              @if($datas['is_has_enter_today'] && !$datas['is_not_out_yet'])
                <div class="mb-4">
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-check"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">{{ trans('Anda sudah melakukan absen masuk dan absen pulang.') }}</p>
                    </div>
                  </div>
                </div>
              @endif
  
              @if($datas['is_has_enter_today'] && !$attendance->data->is_end)
                <div class="mb-4">
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div class="flex-shrink-0">
                      <i class="fa fa-fw fa-times"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <p class="mb-0">{{ trans('Belum saatnya melakukan absensi Pulang.') }}</p>
                    </div>
                  </div>
                </div>
              @endif

            @endif

            @if($datas['is_there_permission'] && !$datas['is_permission_accepted'])
              <div class="mb-4">
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                  <div class="flex-shrink-0">
                    <i class="fa fa-fw fa-exclamation"></i>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <p class="mb-0">{{ trans('Permintaan izin sedang diproses (atau masih belum di terima).') }}</p>
                  </div>
                </div>
              </div>
            @endif

            @if($datas['is_there_permission'] && $datas['is_permission_accepted'])
              <div class="mb-4">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                  <div class="flex-shrink-0">
                    <i class="fa fa-fw fa-check"></i>
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <p class="mb-0">Permintaan izin sudah diterima. Anda pada hari <strong>{{ customDate($attendance->created_at, true) }}</strong> izin tidak mengikuti Praktik Kerja Lapangan.</p>
                  </div>
                </div>
              </div>
            @endif

            <div class="pb-4">
              {!! $attendance->isAttendanceStatus() !!}
            </div>

          @endif

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