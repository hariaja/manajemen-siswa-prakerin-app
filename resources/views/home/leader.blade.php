<div class="row items-push justify-content-center">
  <div class="col-sm-6 col-xxl-3">
    <!-- Pending Orders -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->pendingRegistration() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Pendaftaran Pending') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="far fa-gem fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
          <span>{{ trans('Lihat semua pendaftaran') }}</span>
          <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
        </a>
      </div>
    </div>
    <!-- END Pending Orders -->
  </div>
  <div class="col-sm-6 col-xxl-3">
    <!-- Pending Orders -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->approvedRegistration() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Pendaftaran Diterima') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="fas fa-check fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
          <span>{{ trans('Lihat semua pendaftaran') }}</span>
          <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
        </a>
      </div>
    </div>
    <!-- END Pending Orders -->
  </div>
  <div class="col-sm-6 col-xxl-3">
    <!-- Pending Orders -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->rejectedRegistration() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Pendaftaran Ditolak') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="fas fa-ban fs-3 text-primary"></i>
        </div>
      </div>
      <div class="bg-body-light rounded-bottom">
        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
          <span>{{ trans('Lihat semua pendaftaran') }}</span>
          <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
        </a>
      </div>
    </div>
    <!-- END Pending Orders -->
  </div>
  <div class="col-sm-6 col-xxl-3">
    <!-- Pending Orders -->
    <div class="block block-rounded d-flex flex-column h-100 mb-0">
      <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
        <dl class="mb-0">
          <dt class="fs-3 fw-bold">{{ $dashboard->countStudentByRegistration() }}</dt>
          <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">{{ trans('Jumlah Siswa Terdaftar') }}</dd>
        </dl>
        <div class="item item-rounded-lg bg-body-light">
          <i class="fas fa-users fs-3 text-primary"></i>
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
</div>