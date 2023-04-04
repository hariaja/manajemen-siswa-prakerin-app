@if($status != Constant::APPROVED)
  @if($status == Constant::PENDING)
    <a href="#" onclick="registerStatus(`{{ route('registrations.update', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-ban me-2"></i>{{ Constant::REJECTED }}</a>
  @endif
@endif