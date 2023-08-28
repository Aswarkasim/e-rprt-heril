  <div class="card">
    <div class="card-body">
        <div class="alert alert-success">Halo {{ auth()->user()->name }} selamat datang di halaman admin😀</div>


        <div class="row">

          <div class="col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-graduation-cap"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Guru</span>
                <span class="info-box-number">
                  {{$guru}}
                  <small>Guru</small>
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
                  {{$siswa}}
                  <small>Siswa</small>
                </span>
        
              </div>
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Kelas</span>
              <span class="info-box-number">
                {{$kelas}}
                <small>Kelas</small>
              </span>
      
            </div>
          </div>
          <!-- /.info-box -->
      </div>

        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Mata Pelajaran</span>
              <span class="info-box-number">
                {{$mapel}}
                <small>Mapel</small>
              </span>
      
            </div>
          </div>
          <!-- /.info-box -->
      </div>

        </div>
    </div>
  </div>