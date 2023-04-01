@if(isRoleName() == Constant::ADMIN)
  <a href="{{ route('leaders.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="#" onclick="deleteLeader(`{{ route('leaders.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@else
  <a href="{{ route('leaders.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@endif