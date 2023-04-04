<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="content-header">
    <!-- Logo -->
    <a class="fw-semibold text-dual" href="index.html">
      <span class="smini-visible">
        <i class="fa fa-circle-notch text-primary"></i>
      </span>
      <span class="smini-hide fs-5 tracking-wider">Politeknik <span class="fw-normal">SMI</span></span>
    </a>
    <!-- END Logo -->

    <!-- Extra -->
    <div>
      <!-- Dark Mode -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
        <i class="far fa-moon"></i>
      </button>
      <!-- END Dark Mode -->

      <!-- Close Sidebar, Visible only on mobile screens -->
      <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
      <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
        <i class="fa fa-fw fa-times"></i>
      </a>
      <!-- END Close Sidebar -->
    </div>
    <!-- END Extra -->
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
        <li class="nav-main-item">
          <a class="nav-main-link {{ Request::is('home*') ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">{{ trans('Dashboard') }}</span>
          </a>
        </li>

        @can('schedules.index')
          <li class="nav-main-item">
            <a class="nav-main-link {{ Request::is('schedules*') ? 'active' : '' }}" href="{{ route('schedules.index') }}">
              <i class="nav-main-link-icon fa fa-calendar"></i>
              <span class="nav-main-link-name">{{ trans('Jadwal Pendaftaran') }}</span>
            </a>
          </li>
        @endcan

        @canany([
          'study-programs.index', 
          'leaders.index', 
          'mentors.index',
          'schools.index',
          'teachers.index',
          'registrations.index',
          'roels.index',
          'users.index',
          ])
          <li class="nav-main-heading">{{ trans('Prakerin') }}</li>
        @endcanany
        
        @canany(['study-programs.index', 'leaders.index', 'mentors.index'])
          <li class="nav-main-item {{ Request::is('prodi*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('prodi*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-file"></i>
              <span class="nav-main-link-name">{{ trans('Master Data') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('leaders.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('prodi/leaders*') ? 'active' : '' }}" href="{{ route('leaders.index') }}">
                  <span class="nav-main-link-name">{{ trans('Kaprodi') }}</span>
                </a>
              </li>
              @endcan
              @can('mentors.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('prodi/mentors*') ? 'active' : '' }}" href="{{ route('mentors.index') }}">
                  <span class="nav-main-link-name">{{ trans('Pembimbing') }}</span>
                </a>
              </li>
              @endcan
              @can('study-programs.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('prodi/study-programs*') ? 'active' : '' }}" href="{{ route('study-programs.index') }}">
                  <span class="nav-main-link-name">{{ trans('Program Studi') }}</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endcan

        @canany(['schools.index', 'teachers.index'])
          <li class="nav-main-item {{ Request::is('educations*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('educations*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-school"></i>
              <span class="nav-main-link-name">{{ trans('Education') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('teachers.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('educations/teachers*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">
                  <span class="nav-main-link-name">{{ trans('Guru') }}</span>
                </a>
              </li>
              @endcan
              @can('schools.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('educations/schools*') ? 'active' : '' }}" href="{{ route('schools.index') }}">
                  <span class="nav-main-link-name">{{ trans('Sekolah') }}</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endcan

        @canany(['registrations.index', 'students.index'])
          <li class="nav-main-item {{ Request::is('regsitrations*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('regsitrations*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-users"></i>
              <span class="nav-main-link-name">{{ trans('Prakerin') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('students.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('regsitrations/students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                  <span class="nav-main-link-name">{{ trans('Siswa') }}</span>
                </a>
              </li>
              @endcan
              @can('registrations.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('regsitrations/registrations*') ? 'active' : '' }}" href="{{ route('registrations.index') }}">
                  <span class="nav-main-link-name">{{ trans('Pendaftaran') }}</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endcan

        @canany(['roles.index', 'users.index'])
          <li class="nav-main-heading">{{ trans('Management') }}</li>
          <li class="nav-main-item {{ Request::is('settings*') ? 'open' : '' }}">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}" href="#">
              <i class="nav-main-link-icon fa fa-cog"></i>
              <span class="nav-main-link-name">{{ trans('Settings') }}</span>
            </a>
            <ul class="nav-main-submenu">
              @can('users.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('settings/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                  <span class="nav-main-link-name">{{ trans('Pengguna') }}</span>
                </a>
              </li>
              @endcan
              @can('roles.index')
              <li class="nav-main-item">
                <a class="nav-main-link {{ Request::is('settings/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                  <span class="nav-main-link-name">{{ trans('Role & Permission') }}</span>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        @endcan
        
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>