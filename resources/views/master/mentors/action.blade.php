@if(isRoleName() == Constant::ADMIN)
  <a href="{{ route('mentors.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="{{ route('mentors.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
  @if($model->user->status == Constant::INACTIVE)
    <a href="#" onclick="deleteMentor(`{{ route('mentors.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@else
  <a href="{{ route('mentors.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endif