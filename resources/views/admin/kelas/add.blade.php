<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @isset($kelas)
        <form action="/admin/kelas/{{$kelas->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/kelas" method="POST">  
        @endisset
          @csrf
          
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($kelas) ? $kelas->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          
          <div class="form-group">
            <label for="">Wali Kelas</label>
            <select name="guru_id" class="form-control @error('guru_id') is-invalid @enderror" id="">
              <option value="">-- {{ isset($kelas) ? $kelas->guru->name : '' }} --</option>
              @foreach ($guru as $item)

                  @php
                      $ta_id = auth()->user()->ta_id_active;
                      $kelas = App\Models\Kelas::whereTaId($ta_id)->whereGuruId($item->id)->first();
                  @endphp

                      @if ($kelas == false)
                        <option value="{{ $item->id }}" {{ isset($kelas) ?  $kelas->guru_id == $item->guru_id ? 'selected' : '' : ''  }}>{{ $item->name }}</option>
                      @endif
                @endforeach

            </select>
            @error('guru_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>


          <a href="/admin/kelas" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

