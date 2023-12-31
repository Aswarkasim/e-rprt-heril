@if (auth()->user()->role == 'guru')
<li class="nav-item">
    <a href="/guru/dashboard" class="nav-link {{Request::is('guru/dashboard*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
        Dashboard
        </p>
    </a>
</li>



<li class="nav-item">
    <a href="/guru/nilai" class="nav-link {{Request::is('guru/nilai*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-list"></i>
        <p>
        Input Nilai
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="/guru/desc" class="nav-link {{Request::is('guru/desc*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-folder"></i>
        <p>
        Deskripsi Mapel
        </p>
    </a>
</li>

@endif


@if (auth()->user()->role == 'walikelas')
    

<li class="nav-item">
    <a href="/guru/raport" class="nav-link {{Request::is('guru/raport*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Raport Perwalian
        </p>
    </a>
</li>

@endif

<li class="nav-item">
    <a href="/guru/profile/{{ auth()->user()->id}}" class="nav-link {{ Request ::is('guru/profile*') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>
        Profil
        </p>
    </a>
</li>

