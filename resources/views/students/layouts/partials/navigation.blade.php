<div id="main-navigation" class="d-none d-lg-block mt-2 mt-lg-0">
  <ul class="nav-main nav-main-dark nav-main-horizontal nav-main-hover">
    <li class="nav-main-item">
      <a class="nav-main-link {{ request()->is('students/home*') ? 'active' : '' }}" href="{{ route('students.home') }}">
        <i class="nav-main-link-icon si si-home"></i>
        <span class="nav-main-link-name">{{ trans('Home') }}</span>
      </a>
    </li>
    <li class="nav-main-heading">{{ trans('Feature') }}</li>
    <li class="nav-main-item">
      <a class="nav-main-link {{ request()->is('students/presences*') ? 'active' : '' }}" href="{{ route('students.presences.index') }}">
        <i class="nav-main-link-icon si si-cup"></i>
        <span class="nav-main-link-name">{{ trans('Absensi') }}</span>
      </a>
    </li>
  </ul>
</div>