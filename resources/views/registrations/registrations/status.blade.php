@if ($status == Constant::APPROVED)
  <span class="badge text-success">{{ Constant::APPROVED }}</span>
@elseif ($status == Constant::PENDING)
  <span class="badge text-primary">{{ Constant::PENDING }}</span>
@else
  <span class="badge text-danger">{{ Constant::REJECTED }}</span>
@endif