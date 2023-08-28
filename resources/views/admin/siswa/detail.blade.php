<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $siswa->name }}</td>
                    </tr>

                    <tr>
                        <td>NISN</td>
                        <td>: {{ $siswa->nisn }}</td>
                    </tr>

                    <tr>
                        <td>NIS</td>
                        <td>: {{ $siswa->nis }}</td>
                    </tr>

                    <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>: {{ $siswa->tempat_lahir.', '.$siswa->tanggal_lahir }}</td>
                    </tr>

                    <tr>
                        <td>Gender</td>
                        <td>: {{ $siswa->gender }}</td>
                    </tr>

                    <tr>
                        <td>Agama</td>
                        <td>: {{ $siswa->agama }}</td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $siswa->alamat }}</td>
                    </tr>

                    <tr>
                        <td>No Hp</td>
                        <td>: {{ $siswa->agama }}</td>
                    </tr>

                   

                    <tr>
                        <td>Foto</td>
                        <td>
                            <img src="/{{ $siswa->foto }}" width="150px"  class="mt-2" alt="">
                        </td>
                    </tr>

                </table>

          <a href="/admin/siswa" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>


          
            </div>
        </div>
    </div>
</div>