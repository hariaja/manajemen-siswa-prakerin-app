@can('holidays.edit')
  <a href="{{ route('holidays.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil-alt"></i></a>
@endcan
@can('holidays.destroy')
  <a href="#" onclick="deleteHoliday(`{{ route('holidays.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan