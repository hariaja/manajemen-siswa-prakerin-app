@if ($status == Constant::OPEN)
  <a href="{{ route('schedules.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@else
  <a href="{{ route('schedules.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  <a href="#" onclick="deleteSchedule(`{{ route('schedules.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endif