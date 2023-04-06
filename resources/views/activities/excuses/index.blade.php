@extends('layouts.app')
@section('title') {{ trans('page.excuses.title') }} @endsection
@section('hero')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.excuses.title') }}</h1>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a href="{{ route('attendances.show', $attendance->uuid) }}" class="btn btn-sm btn-block-option text-danger">
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
        {{ trans('page.excuses.index') }}
      </h3>
    </div>
    <div class="block-content">

      <div class="my-3">
        {{ $dataTable->table() }}
      </div>

    </div>
  </div>

@includeIf('activities.excuses.show')
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  <script>
    let table

    $(function () {
      table = $('.table').DataTable()
    })

    function showExcuse(url)
    {
      $('#modal-izin').modal('show')
      $('#modal-izin .block-title').text('Detail Data Izin')

      $.get(url)
        .done((response) => {
          console.log(response)
          $('#modal-izin .title').text(response.title)
          $('#modal-izin .description').text(response.description)
        })
    }

  </script>
@endpush