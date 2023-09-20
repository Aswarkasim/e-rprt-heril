
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SINSIS | Log in</title>

  <link rel="icon" type="image/x-icon" href="/img/logo.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="/dist/css/ktcstyle.css">

  <style>
    body {
        background-image: url('/img/background.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .login-box{
      width: 860px !important;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background-color:white">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="card shadow">
    <div class="card-body login-card-body">

      

      <div class="row">
        <div class="col-md-6">

          <div class="login-logo">
            <img src="/img/logo.png" width="100px">
          </div>

          <p class="login-box-msg">Login untuk mulai memproses data</p>

          @if (session()->has('loginError'))      
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('loginError')}}
                  </div>
          @endif

          <form action="/admin/auth/login" method="post">
            @csrf

            <div class="input-group mb-3">
              <select type="text" name="role" class="form-control @error('role') is-invalid @enderror ">
                <option value="">-- Login Sebagai --</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="walikelas">Wali Kelas</option>
                <option value="orangtua">Orang Tua</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-exchange"></span>
                </div>
              </div>
              @error('role')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>


            <div class="input-group mb-3">
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror " placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              @error('username')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror "  placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @error('password')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="row">
              <div class="col-8">
              
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <div class="text-center">
            <img src="/img/graphic.png" width="70%" alt="">
          </div>
        </div>
      </div>

      {{-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> --}}
      <p class="mb-0">
        {{-- <a href="register.html" class="text-center">Register</a> --}}
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
