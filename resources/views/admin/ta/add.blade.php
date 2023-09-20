<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @isset($ta)
        <form action="/admin/ta/{{$ta->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/ta" method="POST">  
        @endisset
          @csrf
          <div class="form-group">
            <label for="">Tahun Ajaran</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($ta) ? $ta->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($ta) ? $ta : null)!!} --}}

          <a href="/admin/ta" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

