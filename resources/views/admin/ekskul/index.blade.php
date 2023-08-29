<div class="row">
    <div class="col-md-6">
      <div class="p-3  card">
        <div class="card-body">

          <form action="/guru/ekskul" method="POST">  

            @csrf

            <input type="hidden" name="nisn" value="{{ request('nisn') }}">
            <input type="hidden" name="ta_id" value="{{ request('ta_id') }}">
            <input type="hidden" name="semester" value="{{ request('semester') }}">
            
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" placeholder="Nama">
               @error('name')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>

            <div class="form-group">
              <label for="">Predikat</label>
              <input type="text" class="form-control  @error('predikat') is-invalid @enderror"  name="predikat" value="{{ old('predikat') }}" placeholder="Predikat">
               @error('predikat')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>

            <div class="form-group">
              <label for="">Keterangan</label>
              <input type="text" class="form-control  @error('ket') is-invalid @enderror"  name="ket" value="{{ old('ket') }}" placeholder="Keterangan">
               @error('ket')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>
  
  
            <a href="/guru/raport?ta_id={{  request('ta_id') }}&kelas_id={{ request('kelas_id') }}&semester={{  request('semester') }}" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
           <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>

          </form>

           <table class="table mt-2">
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Predikat</td>
                <td>Keterangan</td>
                <td>#</td>
            </tr>
            {{-- @dd($ekskul) --}}
            @foreach ($ekskul as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->predikat }}</td>
                    <td>{{ $item->ket }}</td>
                    <td>
                        <form action="/guru/ekskul/{{$item->id}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit"class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
           </table>
          
        </div>
      </div>
    </div>
  </div>
  
  