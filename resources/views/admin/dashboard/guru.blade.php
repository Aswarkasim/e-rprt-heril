  <div class="card">
    <div class="card-body">
        <div class="alert alert-success">Halo {{ auth()->user()->name }} selamat datang di halaman {{ auth()->user()->role }}😀</div>

        
        <div class="row">

          <div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Guru</span>
                <span class="info-box-number">
                  {{ auth()->user()->name }}
                  {{-- <small>Profil</small> --}}
                </span>
        
              </div>
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-graduation-cap"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Guru</span>
                <span class="info-box-number">
                  {{-- {{$guru}} --}}
                  <small>Mapel</small>
                </span>
        
              </div>
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Siswa</span>
                <span class="info-box-number">
                  {{-- {{$guru}} --}}
                  <small>Siswa</small>
                </span>
        
              </div>
            </div>
            <!-- /.info-box -->
          </div>
          
          <div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-newspaper"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Kelas</span>
                <span class="info-box-number">
                  {{-- {{$guru}} --}}
                  <small>Kelas</small>
                </span>
        
              </div>
            </div>
            <!-- /.info-box -->
          </div>




        </div>
    </div>
  </div>