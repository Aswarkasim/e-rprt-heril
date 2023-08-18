  {{-- @dd($provider_ta) --}}
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      @if (auth()->user()->role == 'admin')
          

      <li class="nav-item dropdown show">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
          {{ Illuminate\Support\Facades\Session::get('ta_name') }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
          @foreach ($provider_ta as $item)
          <a class="dropdown-item" tabindex="-1" href="/admin/ta/user/change?ta_id={{ $item->id }}">{{ $item->name }}</a>
          @endforeach
        </div>
      </li>

      @endif


    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a href="/admin/auth/logout" class="nav-link" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>