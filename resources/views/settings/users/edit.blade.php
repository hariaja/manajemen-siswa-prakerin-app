@if($model->isRoleName() == Constant::ADMIN)
  <span class="badge text-dark">{{ trans('Tidak Bisa Diubah') }}</span>
@else
  @if($status == Constant::ACTIVE)
  <a href="#" onclick="statusUser(`{{ route('users.status', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-ban me-2"></i>{{ trans('Non-Aktifkan') }}</a>
  @else
  <a href="#" onclick="statusUser(`{{ route('users.status', $uuid) }}`)" class="text-success me-2"><i class="fa fa-sm fa-check-circle me-2"></i>{{ trans('Aktifkan') }}</a>
  @endif
@endif