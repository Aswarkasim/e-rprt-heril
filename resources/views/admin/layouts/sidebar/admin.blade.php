<li class="nav-item">
    <a href="/admin/dashboard" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="/admin/mapel" class="nav-link {{Request::is('admin/mapel*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
        Mapel
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="/admin/kelas" class="nav-link {{Request::is('admin/kelas*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-list"></i>
      <p>
        Kelas
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="/admin/siswa" class="nav-link {{Request::is('admin/siswa*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-user"></i>
      <p>
        Siswa
      </p>
    </a>
  </li>
  

  <li class="nav-item">
    <a href="/admin/guru" class="nav-link {{Request::is('admin/guru*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-graduation-cap"></i>
      <p>
        Guru
      </p>
    </a>
  </li>
  

  <li class="nav-item">
    <a href="/admin/ta" class="nav-link {{Request::is('admin/ta*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-calendar"></i>
      <p>
        Tahun Ajaran
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="/admin/sekolah" class="nav-link {{Request::is('admin/sekolah*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-building"></i>
      <p>
        Sekolah
      </p>
    </a>
  </li>

  <li class="nav-item {{Request::is('admin/user*') ? 'menu-open' : ''}}">
    <a href="#" class="nav-link {{Request::is('admin/user*') ? 'active' : ''}}">
      <i class="nav-icon fas fa-users"></i>
      <p>
        User
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="/admin/user?role=guru" class="nav-link {{request('role')== 'guru' ? 'child-active' : ''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>Guru</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/admin/user?role=admin" class="nav-link  {{request('role')== 'admin' ? 'child-active' : ''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>Admin</p>
        </a>
      </li>
    </ul>
  </li>
