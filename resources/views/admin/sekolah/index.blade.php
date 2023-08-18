<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">


          <form action="/admin/sekolah/update" method="POST" enctype="multipart/form-data">  
            @method('PUT')
          @csrf
        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama Sekolah</label>
                <input type="text" class="form-control  @error('nama_sekolah') is-invalid @enderror"  name="nama_sekolah"  value="{{isset($sekolah) ? $sekolah->nama_sekolah : old('nama_sekolah')}}" placeholder="Nama Sekolah">
                @error('nama_sekolah')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">NIDN</label>
                <input type="text" class="form-control  @error('nidn') is-invalid @enderror"  name="nidn"  value="{{isset($sekolah) ? $sekolah->nidn : old('nidn')}}" placeholder="NIDN">
                @error('nidn')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" class="form-control  @error('alamat') is-invalid @enderror"  name="alamat"  value="{{isset($sekolah) ? $sekolah->alamat : old('alamat')}}" placeholder="Alamat">
                @error('alamat')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Kepala Sekolah</label>
                <input type="text" class="form-control  @error('kepsek') is-invalid @enderror"  name="kepsek"  value="{{isset($sekolah) ? $sekolah->kepsek : old('kepsek')}}" placeholder="Kepala Sekolah">
                @error('kepsek')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">NIP Kepala Sekolah</label>
                <input type="text" class="form-control  @error('nip_kepsek') is-invalid @enderror"  name="nip_kepsek"  value="{{isset($sekolah) ? $sekolah->nip_kepsek : old('nip_kepsek')}}" placeholder="NIP Kepala Sekolah">
                @error('nip_kepsek')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


            </div>

          </div>
          

       

          <a href="/admin/sekolah" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

