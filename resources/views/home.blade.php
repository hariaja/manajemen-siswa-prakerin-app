@extends('layouts.app')
@section('title', 'Dashboard Page')
@section('hero')
  <div class="content">
    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
      <div class="flex-grow-1 mb-1 mb-md-0">
        <h1 class="h3 fw-bold mb-2">
          {{ trans('page.dashboard.title') }}
        </h1>
        <h2 class="h6 fw-medium fw-medium text-muted mb-0">
          Selamat Datang <a class="fw-semibold" href="{{ route('users.show', me()->uuid) }}">{{ me()->name }}</a>, semuanya terlihat baik.
        </h2>
      </div>
      <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
        <a class="btn btn-sm btn-alt-secondary space-x-1" href="be_pages_generic_profile_edit.html">
          <i class="fa fa-cogs opacity-50"></i>
          <span>Settings</span>
        </a>
      </div>
    </div>
  </div>
@endsection
@section('content')
  @if(isRoleName() == Constant::ADMIN)
    @include('home.admin')
  @else
    {{-- @include('home.admin') --}}
  @endif
@endsection
