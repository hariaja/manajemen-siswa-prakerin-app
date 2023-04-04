@if(isRoleName() == Constant::ADMIN)
  <a href="{{ route('students.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="{{ route('students.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
  @if($model->user->status == Constant::INACTIVE)
    <a href="#" onclick="deleteStudent(`{{ route('students.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@else
  <a href="{{ route('students.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="{{ route('students.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endif