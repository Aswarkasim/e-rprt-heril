<div class="row">
  <div class="col-6">

<div class="card">
<div class="card-body">
  <a href="/admin/kelas/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

  @include('admin.kelas.import')

  
  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/kelas" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Kelas</th>
      <th>Wali Kelas</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($kelas as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td>{{$row->name}} <small>ID: {{ $row->id }}</small></td>
      <td>{{ isset($row->guru) ? $row->guru->name : ''}}</td>
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu" x-placement="bottom-start">
              <a class="dropdown-item" href="/admin/kelas/{{$row->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                <div class="dropdown-divider"></div>
                <form action="/admin/kelas/{{$row->id}}" method="post" id="form-delete" >
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
    {{$kelas->links()}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


