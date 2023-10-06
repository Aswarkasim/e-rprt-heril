<div class="row">
  <div class="col-md-6">

<div class="card">
<div class="card-body">
  {{-- <a href="/admin/mapel/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a> --}}

  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/mapel" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>TA</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($mapel as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td><a href="/guru/desc/{{ $row->id}}"><b>{{ $row->name }}</b></a></td>
      <td>{{ isset($row->guru) ? $row->guru->name : ''}}</td>
    
    </tr>

    @endforeach

  </tbody>
</table>

  <div class="float-right">
    {{-- {{$mapel->links()}} --}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


