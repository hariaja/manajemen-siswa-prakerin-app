@can('teachers.edit')
  <a href="{{ route('teachers.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@endcan

@can('teachers.show')
  <a href="{{ route('teachers.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan

@if($model->user->status == Constant::INACTIVE)
  @can('teachers.destroy')
    <a href="#" onclick="deleteTeacher(`{{ route('teachers.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endcan
@endif