@if(isRoleName() == Constant::ADMIN)
  <a href="{{ route('registrations.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
  @if($model->status == Constant::PENDING)
    <a href="#" onclick="deleteRegistration(`{{ route('registrations.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@else
  <a href="{{ route('registrations.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endif