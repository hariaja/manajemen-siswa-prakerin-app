@if(me()->hasRole(Constant::MENTOR))
  @can('journals.edit')
  <a href="{{ route('journals.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil-alt"></i></a>
  @endcan
  @if ($status === Constant::PENDING)
    @can('journals.destroy')
      <a href="#" onclick="deleteJournal(`{{ route('journals.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
    @endcan
  @endif
@endif

@if(me()->hasRole(Constant::STUDENT))
  @if ($status === Constant::PENDING)
    @can('journals.destroy')
      <a href="#" onclick="deleteJournal(`{{ route('journals.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
    @endcan
  @else
    <div class="badge text-secondary">Tidak Ada Aksi</div>
  @endif
@endif
