@if(isRoleName() == Constant::ADMIN)
  <a href="{{ route('schools.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="#" onclick="deleteSchool(`{{ route('schools.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endif