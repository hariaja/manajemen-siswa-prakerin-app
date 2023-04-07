<div class="row items-push justify-content-center">
  <div class="col-sm-6 col-xxl-3">
    <!-- Pending Orders -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->studentActive() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Siswa Aktif') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="fa fa-users fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
          <span>{{ trans('Lihat semua siswa') }}</span>
          <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
        </a>
      </div>
    </div>
    <!-- END Pending Orders -->
  </div>
  <div class="col-sm-6 col-xxl-3">
    <!-- New Customers -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->userActive() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Pengguna Aktif') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="far fa-user-circle fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        @can('users.index')
          <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('users.index') }}">
            <span>{{ trans('Lihat semua pengguna') }}</span>
            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
          </a>
        @endcan
      </div>
    </div>
    <!-- END New Customers -->
  </div>
  <div class="col-sm-6 col-xxl-3">
    <!-- Messages -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->studyProgramActive() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Program Studi Terdaftar') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="fa fa-file-alt fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        @can('study-programs.index')
          <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('study-programs.index') }}">
            <span>{{ trans('Lihat semua prodi') }}</span>
            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
          </a>
        @endcan
      </div>
    </div>
    <!-- END Messages -->
  </div>
  <div class="col-sm-6 col-xxl-3">
    <!-- Conversion Rate -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->schoolCount() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Sekolah Terdaftar') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="fa fa-school fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        @can('schools.index')
          <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('schools.index') }}">
            <span>{{ trans('Lihat semua sekolah') }}</span>
            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
          </a>
        @endcan
      </div>
    </div>
    <!-- END Conversion Rate-->
  </div>
</div>