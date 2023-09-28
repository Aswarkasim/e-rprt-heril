<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Raport</title>
    <link rel="stylesheet" href="/dist/css/styleraport.css">
</head>
<body>
    
<style>

    

    
</style>


<div class="text-center">
    <h3><b>LAPORAN HASIL BELAJAR <br> (RAPOR)</b></h3>
</div>

<div class="d-flex">
    <table class="table" style="width: 50%">
        <tr>
            <td>Nama Peserta Didik</td>
            <td>: {{ $siswa->name }}</td>
        </tr>

        <tr>
            <td>NISN</td>
            <td>: {{ $siswa->nisn }}</td>
        </tr>

        <tr>
            <td>Sekolah</td>
            <td>: SDN No. 206 INPRES SALEKOWA</td>
        </tr>

        <tr>
            <td>ALAMAT</td>
            <td>: SALEKOWA</td>
        </tr>

    </table>

    <table class="table" style="width: 50%">
        <tr>
            <td>Kelas</td>
            <td>: {{ $siswa->kelas->name }}</td>
        </tr>

        <tr>
            <td>Fase</td>
            <td>: B</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>: {{ request('semester') }}</td>
        </tr>

        <tr>
            <td>Tahun Pelajaran</td>
            <td>: {{ $ta->name }}</td>
        </tr>


    </table>
    
</div>


<table id="table-nilai" border="1px" style="border-collapse:collapse">
    <tr>
        <th>NO</th>
        <th>MATA PELAJARAN</th>
        <th>NILAI AKHIR</th>
        <th>CAPAIAN KOMPETENSI</th>
    </tr>

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
</table>

<table id="table-extra" border="1px" style="border-collapse:collapse">
    <tr>
        <th>NO</th>
        <th>EKSTRAKURIKULER</th>
        <th>PREDIKAT</th>
        <th>KETERANGAN</th>
    </tr>

    @foreach ($ekskul as $item)
    <tr>
        <td align="center">{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td  align="center">{{ $item->predikat }}</td>
        <td>{{ $item->ket }}</td>
    </tr>
    @endforeach

   
</table>


@if ($kehadiran)
    
<table id="table-kehadiran" border="1px" style="border-collapse:collapse">
    <tr>
        <th colspan="3">KETIDAKHADIRAN</th>
    </tr>
    <tr>
        <td>Sakit</td>
        <td width="50px" border=0px>{{ $kehadiran->s }}</td>
        <td>Hari</td>
    </tr>
    <tr>
        <td>Izin</td>
        <td>{{ $kehadiran->i }}</td>
        <td>Hari</td>
    </tr>
    <tr>
        <td>Tanpa Keterangan</td>
        <td>{{ $kehadiran->a }}</td>
        <td>Hari</td>
    </tr>
</table>

@endif



<div class="d-flex" >

    <table  style="width: 80%; margin-top:20px" align="center">
        <tr>
            <td></td>
            <td align="center">Takalar, {{ date('Y M D') }}</td>
        </tr>
        <tr>
            <td style="width: 50%" align="center">
                <p>Orang Tua</p>
                <br><br><br>
                ...............
            </td>

            <td style="width: 50%" align="center">
                <p>Wali Kelas</p>
                <br><br><br>
                <b style="font-style: underline">{{ $wali->name }}</b><br>
                <span>NIP. {{ $wali->nip }}</span>
            </td>

        </tr>

        <tr>
            <td colspan="2" align="center">
                <p>Kepala Sekolah</p>
                <br><br><br>
                <b style="font-style: undeline">{{ $sekolah->kepsek }}</b><br>
                <span>NIP. {{ $sekolah->nip_kepsek }}</span>
            </td>
        </tr>
    </table>

</div>


<script>
    window.print()
</script>

</body>
</html>