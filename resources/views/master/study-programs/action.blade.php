@if($status == Constant::ACTIVE)
  <a href="{{ route('study-programs.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@else
  <a href="{{ route('study-programs.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="#" onclick="deleteStudyProgram(`{{ route('study-programs.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endif