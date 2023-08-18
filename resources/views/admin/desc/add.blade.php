<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @isset($desc)
        <form action="/guru/desc/{{$desc->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/guru/desc" method="POST">  
        @endisset
          @csrf
          
          <input type="hidden" name="mapel_id" value="{{ request('mapel_id') }}">
          <div class="form-group">
            <label for="">Rentan Nilai Awal</label>
            <input type="number" class="form-control  @error('start_value') is-invalid @enderror"  name="start_value"  value="{{isset($desc) ? $desc->start_value : old('start_value')}}" placeholder="0">
             @error('start_value')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Rentan Nilai Akhir</label>
            <input type="number" class="form-control  @error('end_value') is-invalid @enderror"  name="end_value"  value="{{isset($desc) ? $desc->end_value : old('end_value')}}" placeholder="0">
             @error('end_value')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>


          <div class="form-group">
            <label for="">Deskripsi</label>
           <textarea name="desc" id="" class="form-control" cols="20" rows="5">
            {{isset($desc) ? $desc->desc : old('desc')}}
           </textarea>
             @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <a href="/guru/desc/{{ request('mapel_id') }}" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

