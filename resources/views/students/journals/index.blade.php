@extends('students.layouts.main')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="py-3 text-center">
        <h1 class="h3 fw-bold mb-2">
          {{ trans('page.journals.title') }}
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          {{ trans('Anda bisa mengakses halaman ini jika anda sudah melakukan absensi di Halaman absen') }}
        </h2>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">{{ trans('page.journals.index') }}</h3>
  </div>
  <div class="block-content">

    @can('journals.create')
      <div class="mb-4">
        <a href="{{ route('journals.create') }}" class="btn btn-primary"><i class="fa fa-plus fa-xs me-2"></i>{{ trans('page.journals.create') }}</a>
      </div>
    @endcan

    <div class="my-3">
      {{ $dataTable->table() }}
    </div>

  </div>
</div>
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}

  <script>
    let table

    $(function () {
      table = $('.table').DataTable()
    })

    function deleteJournal(url) {
      Swal.fire({
        icon: 'warning',
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!",
        showCancelButton: true,
        confirmButtonText: 'Hapus Data',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
          })
          .done((response) => {
            Swal.fire({
              icon: 'success',
              title: response.message,
              confirmButtonText: 'Selesai'
            })
            table.ajax.reload()
          })
          .fail((errors) => {
            Swal.fire({
              icon: 'error',
              title: errors.responseJSON.message,
              confirmButtonText: 'Mengerti'
            })
            return
          })
        } else if (result.dismiss == swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: 'Tidak ada perubahan disimpan',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3498DB'
          })
        }
      })
    }
  </script>

@endpush