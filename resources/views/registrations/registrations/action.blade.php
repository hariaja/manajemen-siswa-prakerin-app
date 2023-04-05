@can('registrations.show')
  <a href="{{ route('registrations.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan

@if($model->status == Constant::PENDING)
  @can('registrations.destroy')
    <a href="#" onclick="deleteRegistration(`{{ route('registrations.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endcan
@endif