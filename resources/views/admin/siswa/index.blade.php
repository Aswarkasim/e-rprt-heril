<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  <a href="/admin/siswa/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

  @include('admin.import.import')

  <br>
  @if($errors->any())
  {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
@endif

  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/siswa" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>

  <div class="table-responsive">
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>NISN</th>
      <th>NIS</th>
      <th>Nama Lengkap</th>
      <th>Gender</th>
      <th>TTL</th>
      <th>Agama</th>
      <th>Alamat</th>
      <th>No Hp</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($siswa as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td>{{ $row->nisn }}</td>
      <td>{{ $row->nis }}</td>
      <td><a href="/admin/siswa/{{ $row->id }}"><b>{{$row->name}}</b></a></td>
      <td>{{ $row->gender }}</td>
      <td>{{ $row->tempat_lahir.', '.$row->tanggal_lahir }}</td>
      <td>{{ $row->agama }}</td>
      <td>{{ $row->alamat }}</td>
      <td>{{ $row->nohp }}</td>
      <td>{{ $row->status }}</td>
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu" x-placement="bottom-start">
              <a class="dropdown-item" href="/admin/siswa/{{$row->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                <div class="dropdown-divider"></div>
                <form action="/admin/siswa/{{$row->id}}" method="post" id="form-delete" >
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
</div>
  <div class="float-right">
    {{$siswa->links()}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


