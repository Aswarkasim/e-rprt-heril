<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        {{-- @if (session()->all())
            {{ session()->all() }}
        @endif --}}

        @isset($siswa)
        <form action="/admin/siswa/{{$siswa->id}}" method="POST" enctype="multipart/form-data">  
          @method('PUT')
        @else
        <form action="/admin/siswa" method="POST" enctype="multipart/form-data">  

        @endisset
          @csrf
          
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($siswa) ? $siswa->name : old('name')}}" placeholder="Nama">
                  @error('name')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">NISN</label>
                  <input type="text" class="form-control  @error('nisn') is-invalid @enderror"  name="nisn"  value="{{isset($siswa) ? $siswa->nisn : old('nisn')}}" placeholder="NISN">
                  @error('nisn')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">NIS</label>
                  <input type="text" class="form-control  @error('nis') is-invalid @enderror"  name="nis"  value="{{isset($siswa) ? $siswa->nis : old('nis')}}" placeholder="NIS">
                  @error('nis')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Kelas</label>
                  <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" id="">
                    <option value="">--Kelas--</option>
                    @foreach ($kelas as $item)
                      <option value="{{ $item->id }}" {{ isset($siswa) ?  $siswa->kelas_id == $item->id ? 'selected' : '' : ''  }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                  @error('kelas_id')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Tempat Lahir</label>
                  <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror"  name="tempat_lahir"  value="{{isset($siswa) ? $siswa->tempat_lahir : old('tempat_lahir')}}" placeholder="Tempat Lahir">
                  @error('tempat_lahir')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Tanggal Lahir</label>
                  <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror"  name="tanggal_lahir"  value="{{isset($siswa) ? $siswa->tanggal_lahir : old('tanggal_lahir')}}" placeholder="Tanggal Lahir">
                  @error('tanggal_lahir')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

              </div>
            

              <div class="col-md-6">

                <div class="form-group">
                  <label for="">Agama</label>
                  <input type="text" class="form-control  @error('agama') is-invalid @enderror"  name="agama"  value="{{isset($siswa) ? $siswa->agama : old('agama')}}" placeholder="Agama">
                  @error('agama')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Alamat</label>
                  <input type="text" class="form-control  @error('alamat') is-invalid @enderror"  name="alamat"  value="{{isset($siswa) ? $siswa->alamat : old('alamat')}}" placeholder="Alamat">
                  @error('alamat')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">No HP</label>
                  <input type="text" class="form-control  @error('nohp') is-invalid @enderror"  name="nohp"  value="{{isset($siswa) ? $siswa->nohp : old('nohp')}}" placeholder="No HP">
                  @error('nohp')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Foto</label>
                  <input type="file" class="form-control  @error('foto') is-invalid @enderror"  name="foto"  value="{{isset($siswa) ? $siswa->foto : old('foto')}}" placeholder="Foto">
                  @error('foto')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                  @isset($siswa)
                      @isset($siswa->foto)
                          <img src="/{{ $siswa->foto }}" width="100px"  class="mt-2" alt="">
                      @endisset
                  @endisset
                </div>

              </div>
            </div>


          <a href="/admin/siswa" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

