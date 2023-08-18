<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        {{-- @if (session()->all())
            {{ session()->all() }}
        @endif --}}

        @isset($guru)
        <form action="/admin/guru/{{$guru->id}}" method="POST" enctype="multipart/form-data">  
          @method('PUT')
        @else
        <form action="/admin/guru" method="POST" enctype="multipart/form-data">  

        @endisset
          @csrf
          
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($guru) ? $guru->name : old('name')}}" placeholder="Nama">
                  @error('name')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">NIP</label>
                  <input type="text" class="form-control  @error('nip') is-invalid @enderror"  name="nip"  value="{{isset($guru) ? $guru->nip : old('nip')}}" placeholder="NIP">
                  @error('nip')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Jabatan</label>
                  <select name="jabatan" class="form-control @error('nip') is-invalid @enderror" id="">
                    <option value="">--Jabatan--</option>
                    <option value="Kepala Sekolah" {{ isset($guru) ?  $guru->jabatan == 'Kepala Sekolah' ? 'selected' : '' : ''  }}>Kepala Sekolah</option>
                    <option value="Guru" {{ isset($guru) ? $guru->jabatan == 'Guru' ? 'selected' : '' : ''  }}>Guru</option>
                  </select>
                  @error('jabatan')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Agama</label>
                  <input type="text" class="form-control  @error('agama') is-invalid @enderror"  name="agama"  value="{{isset($guru) ? $guru->agama : old('agama')}}" placeholder="Agama">
                  @error('agama')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Alamat</label>
                  <input type="text" class="form-control  @error('alamat') is-invalid @enderror"  name="alamat"  value="{{isset($guru) ? $guru->alamat : old('alamat')}}" placeholder="Alamat">
                  @error('alamat')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                


              </div>
            

              <div class="col-md-6">

                <div class="form-group">
                  <label for="">No HP</label>
                  <input type="text" class="form-control  @error('nohp') is-invalid @enderror"  name="nohp"  value="{{isset($guru) ? $guru->nohp : old('nohp')}}" placeholder="No HP">
                  @error('nohp')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Foto</label>
                  <input type="file" class="form-control  @error('foto') is-invalid @enderror"  name="foto"  value="{{isset($guru) ? $guru->foto : old('foto')}}" placeholder="Foto">
                  @error('foto')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                  @isset($guru)
                      @isset($guru->foto)
                          <img src="/{{ $guru->foto }}" width="100px"  class="mt-2" alt="">
                      @endisset
                  @endisset
                </div>

              
                {{-- <hr> --}}

                {{-- <h5><b>Buat Akun</b></h5> --}}
                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror"  name="username" value="{{isset($guru) ? $guru->username : old('username')}}"   placeholder="Username">
                   @error('username')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                   @enderror
                </div>


                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="Password">
                   @error('password')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                   @enderror
                </div>
      
                <div class="form-group">
                  <label for="">Konfirmasi Password</label>
                  <input type="password" class="form-control @error('re_password') is-invalid @enderror"  name="re_password" placeholder="Konfirmasi Password">
                   @error('re_password')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                   @enderror
                </div>


              </div>
            </div>


          <a href="/admin/guru" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

