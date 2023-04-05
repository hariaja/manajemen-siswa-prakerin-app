@can('students.edit')
  <a href="{{ route('students.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@endcan

@can('students.show')
  <a href="{{ route('students.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan

@if($model->user->status == Constant::INACTIVE)
  @can('students.destroy')
    <a href="#" onclick="deleteStudent(`{{ route('students.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endcan
@endif