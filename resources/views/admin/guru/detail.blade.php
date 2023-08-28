<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $guru->name }}</td>
                    </tr>

                    <tr>
                        <td>NIP</td>
                        <td>: {{ $guru->nip }}</td>
                    </tr>

                    <tr>
                        <td>Agama</td>
                        <td>: {{ $guru->alamat }}</td>
                    </tr>

                    <tr>
                        <td>No Hp</td>
                        <td>: {{ $guru->name }}</td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td>: {{ $guru->jabatan }}</td>
                    </tr>

                    <tr>
                        <td>Foto</td>
                        <td>
                            <img src="/{{ $guru->foto }}" width="150px"  class="mt-2" alt="">
                        </td>
                    </tr>

                </table>

          <a href="/admin/guru" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>


          
            </div>
        </div>
    </div>
</div>