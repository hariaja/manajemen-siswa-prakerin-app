@if(isRoleName() == Constant::ADMIN)
  <a href="{{ route('teachers.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="{{ route('teachers.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
  @if($model->user->status == Constant::INACTIVE)
    <a href="#" onclick="deleteTeacher(`{{ route('teachers.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@else
  <a href="{{ route('teachers.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endif