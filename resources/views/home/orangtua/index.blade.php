<div class="container my-2">

    <div class="p-3">
        <p class="alert alert-info">Halo orang tua dari siswa, Selamat Datang di halaman orang tua</p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body shadow-sm">
                    <div class="d-flex justify-content-center">
                        <div class="card p-2">
                            <img src="/img/avatar.jpg" width="100px" alt="">
                        </div>
                    </div>

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
                            <td>Gender</td>
                            <td>: {{ $siswa->gender }}</td>
                        </tr>

                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $siswa->alamat }}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>: {{ $siswa->aktif }}</td>
                        </tr>

                        <tr>
                            <td>Kelas</td>
                            <td>: {{ $siswa->kelas->name }}</td>
                        </tr>


                    </table>


                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-3">
                <form action="" method="GET" class="d-flex">
                    <select name="ta_id" class="form-control" id="">
                        <option value="">--Tahun Ajaran--</option>
                        @foreach ($ta as $item)
                            <option value="{{ $item->id }}" {{ $item->id == request('ta_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                    <select name="semester" class="form-control" id="">
                        <option value="">--Semester--</option>
                        <option value="1" {{ request('semester') == 1 ? 'selected' : '' }}>I</option>
                        <option value="2" {{ request('semester') == 2 ? 'selected' : '' }}>II</option>
                    </select>
                    <button class="btn btn-primary">Tampilkan</button>
                </form>

                
                @if (count($nilai) >= 1)
                    <a href="/home/orangtua/cetak?nisn={{ $siswa->nisn }}&ta_id={{ request('ta_id') }}&kelas_id={{ $siswa->kelas_id }}&semester={{ request('semester') }}" target="blank" class="btn btn-success my-2">Cetak</a>
                  
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2" class="text-center">LAPORAN HASIL PRESTASI SISWA</td>
                        </tr>
                        <tr>
                            <td class="text-center" width="150px">
                                <div>Peringkat</div>
                                <span class="badge bg-primary" style="padding: 20px 50px !important"><h2>{{ $peringkat->peringkat }}</h2></span>
                                <div>Dari {{ $totalsiswa }} Siswa</div>
                            </td>
                            <td>
                                <p>{{ $peringkat->pesan }}</p>
                            </td>
                        </tr>
                    </table>

                @endif

               


                <table class="table mt-3">
                    <tr>
                        <th>NO</th>
                        <th>MATA PELAJARAN</th>
                        <th>NILAI AKHIR</th>
                        <th>CAPAIAN KOMPETENSI</th>
                    </tr>
                

                    @if ($nilai)
                        
                    @foreach($nilai as $item)
                        
                    <tr>
                        <td width="50px" rowspan="2" align="center">{{ $loop->iteration }}</td>
                        <td  width="150px" rowspan="2">{{ $item->mapel->name }}</td>
                        <td  width="50px" rowspan="2"  align="center">{{ $item->nilai }}</td>
                        <td>{{ $item->desc_1 }}</td>
                    </tr>
                    
                    <tr>
                        <td>{{ $item->desc_2 }}</td>
                    </tr>
                    @endforeach

                    @endif

                </table>


            </div>
        </div>
    </div>
</div>