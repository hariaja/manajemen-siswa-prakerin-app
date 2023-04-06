@can('attendances.edit')
  <a href="{{ route('attendances.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil-alt"></i></a>
@endcan
@can('attendances.show')
  <a href="{{ route('attendances.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('attendances.destroy')
  <a href="#" onclick="deleteAttendance(`{{ route('attendances.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan