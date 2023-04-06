@if($is_accepted)
  <span class="badge text-success">{{ trans('Accepted') }}</span>
@else

  <a class="text-success" href="{{ route('excuses.update', $uuid) }}" onclick="event.preventDefault(); document.getElementById('excuse-accept').submit();">
    <i class="fa fa-check fa-xs me-1"></i>
    {{ trans('Terima Izin') }}
  </a>
  <form id="excuse-accept" action="{{ route('excuses.update', $uuid) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="student_id" value="{{ $model->student->id }}">
    <input type="hidden" name="excuse_date" value="{{ $model->excuse_date }}">
  </form>
@endif