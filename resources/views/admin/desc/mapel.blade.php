<div class="row">
  <div class="col-md-6">

<div class="card">
<div class="card-body">
  <a href="/guru/desc/create?mapel_id={{ $mapel_id }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/guru/desc" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Rentan Mulai</th>
      <th>Rentan Akhir</th>
      <th>Deskripsi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($desc as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td>{{$row->start_value}}</td>
      <td>{{$row->end_value}}</td>
      <td>{{$row->desc}}</td>
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu" x-placement="bottom-start">
              <a class="dropdown-item" href="/guru/desc/{{$row->id}}/edit?mapel_id={{ $row->mapel_id }}"><i class="fa fa-edit"></i> Edit</a>
                <div class="dropdown-divider"></div>
                <form action="/guru/desc/{{$row->id}}" method="post" id="form-delete" >
                  @method('delete')
                  @csrf
                  <button type="submit" id="delete" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</button>
                </form>
            </div>
          </div>
      </td>
    </tr>

    @endforeach

  </tbody>
</table>

  <div class="float-right">
    {{-- {{$desc->links()}} --}}
  </div>
</div>
</div>

  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h4><b>Capaian</b></h4>
        <form action="/guru/desc/save/capaian/{{ $mapel_id }}" method="POST">
          @method('PUT')
          @csrf
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

          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- /.card-body -->


