@if(isRoleName() == Constant::ADMIN)
  @canany(['mentors.edit', 'mentors.show'])
    <a href="{{ route('mentors.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
    <a href="{{ route('mentors.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
  @endcan
  @if($model->user->status == Constant::INACTIVE)
    @can('mentors.destroy')
      <a href="#" onclick="deleteMentor(`{{ route('mentors.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
    @endcan
  @endif
@else
  @can('mentors.show')
    <a href="{{ route('mentors.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
  @endcan
@endif