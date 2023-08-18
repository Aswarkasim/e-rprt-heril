<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @isset($mapel)
        <form action="/admin/mapel/{{$mapel->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/mapel" method="POST">  
        @endisset
          @csrf
          
          <div class="form-group">
            <label for="">Nama Mapel</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($mapel) ? $mapel->name : old('name')}}" placeholder="Nama Mapel">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Guru</label>
            <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror" id="">
              <option value="">--Guru--</option>
              @foreach ($guru as $item)
                <option value="{{ $item->id }}" {{ isset($mapel) ?  $mapel->guru_id == $item->id ? 'selected' : '' : ''  }}>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('guru_id')
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
                <option value="{{ $item->id }}" {{ isset($mapel) ?  $mapel->kelas_id == $item->id ? 'selected' : '' : ''  }}>{{ $item->name }}</option>
              @endforeach
            </select>
            @error('kelas_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">KKM</label>
            <input type="number" class="form-control  @error('kkm') is-invalid @enderror"  name="kkm"  value="{{isset($mapel) ? $mapel->kkm : old('kkm')}}" placeholder="0">
             @error('kkm')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Deskripsi CP</label>
            <textarea name="desc_cp" class="form-control  @error('desc_cp') is-invalid @enderror" id="" cols="20" rows="5" placeholder="Contoh : menyimak dan menanggapi bacaan tentang tempat dan aturan bermain, mengenali tanda tanya dan tanda seru dalam kalimat, serta membaca dan menulis suku kata yang diawali dengan huruf ‘h’ dan ‘c’.">{{isset($mapel) ? $mapel->desc_cp : old('desc_cp')}}</textarea>
             @error('kkm')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>
          


          <a href="/admin/mapel" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

