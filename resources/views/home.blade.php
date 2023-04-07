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
    </div>
  </div>
@endsection
@section('content')
  @if(me()->hasRole(Constant::ADMIN))
    @include('home.admin')
  @elseif (me()->hasRole(Constant::LEADER) || me()->hasRole(Constant::MENTOR))
    @include('home.leader')
  @else
    {{-- @include('home.admin') --}}
  @endif
@endsection
