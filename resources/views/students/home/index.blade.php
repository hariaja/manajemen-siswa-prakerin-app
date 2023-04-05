@extends('students.layouts.main')
@section('title', 'Home')
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="py-3 text-center">
        <h1 class="h3 fw-bold mb-2">
          Dashboard
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          Welcome to your app, everything looks great!
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')
  <!-- Stats -->
  <div class="row">
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full">
          <div class="fs-sm fw-semibold text-uppercase text-muted">Visitors</div>
          <div class="fs-2 fw-normal text-dark">120,580</div>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full">
          <div class="fs-sm fw-semibold text-uppercase text-muted">Sales</div>
          <div class="fs-2 fw-normal text-dark">150</div>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full">
          <div class="fs-sm fw-semibold text-uppercase text-muted">Earnings</div>
          <div class="fs-2 fw-normal text-dark">$3,200</div>
        </div>
      </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
      <a class="block block-rounded block-link-pop" href="javascript:void(0)">
        <div class="block-content block-content-full">
          <div class="fs-sm fw-semibold text-uppercase text-muted">Avg Sale</div>
          <div class="fs-2 fw-normal text-dark">$21</div>
        </div>
      </a>
    </div>
  </div>
  <!-- END Stats -->
@endsection

{{-- <div class="fw-semibold">
  This Home Student Page
</div>

<a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <span class="fs-sm fw-medium">{{ trans('Keluar Aplikasi') }}</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form> --}}