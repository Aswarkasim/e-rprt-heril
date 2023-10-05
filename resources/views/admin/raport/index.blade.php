<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  {{-- <a href="/admin/siswa/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a> --}}

  <form action="" method="GET">
    <div class="row mb-2">
      <div class="offset-md-2 col-md-4">

        <div class="row">
          <div class="col-md-3"><label for="">Tahun Ajaran</label></div>
          <div class="col-md-9">
            <select class="form-control" id="ta" name="ta_id" required>
              <option value=""> -- {{ isset($kelas_pilih) ? $kelas_pilih->ta->name : '' }} --</option>
              @foreach($ta as $item)
                <option value="{{$item->id}}" {{ request('ta_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">
              Pilih Tahun Ajaran.
            </div>
          </div>
        </div>

        <div class="row mt-1">
          <div class="col-md-3"><label for="">Kelas</label></div>
          <div class="col-md-9">
            <select class="form-control" id="kelas" name="kelas_id" disabled required>
              <option value="">{{ isset($kelas_pilih) ? $kelas_pilih->name : ''}}</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid kelas.
            </div>
          </div>
        </div>

        
      </div>

      <div class="col-md-4">
        <div class="row mt-1">
          <div class="col-md-3"><label for="">Semester</label></div>
          <div class="col-md-9">
            <select name="semester" class="form-control" id="" required>
              <option value="">--Semester--</option>
              <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>1</option>
              <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>2</option>
            </select>
          </div>
        </div>

      </div>
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary my-2"><i class="fas fa-search"></i> Tampilkan</button>
      {{-- <a href="/guru/nilai/save?ta_id={{  request('ta_id') }}&mapel_id={{  request('mapel_id') }}&kelas_id={{  request('kelas_id') }}&semester={{  request('semester') }}" class="btn btn-success my-2 ml-2"><i class="fas fa-check"></i> Simpan</a> --}}
    </div>
  </form>



  <div class="table-responsive">
    <table id="example1" class="table table-bordered">
      <thead>
        <tr>
          <th rowspan="2" style="text-align: center">NO</th>
          <th rowspan="2" style="text-align: center">NISN</th>
          <th rowspan="2" style="text-align: center">NAMA</th>
          <th colspan="3" style="text-align: center">KEHADIRAN</th>
          <th rowspan="2" style="text-align: center">EKSKUL</th>
          <th rowspan="2" style="text-align: center">ACTION</th>
        </tr>

        <tr>
          <td>S</td>
          <td>I</td>
          <td>A</td>
        </tr>
      </thead>

        <tbody>
          @foreach ($siswa as $row)
              
          <tr>
            <td width="50px">{{$loop->iteration}}</td>
            <td>{{ $row->nisn }}</td>
            <td>{!!  $row->name.'<br>'.$row->tanggal_lahir !!}</td>
            <td width="100px">
              <input 
                  type="number"
                  placeholder="S"
                  class="form-control"
                  name="s{{ $row->id }}"
                  onchange="input_kehadiran('s','s{{ $row->id }}',{{ $row->id }})"
                  value="{{ $row->kehadiran->s }}">
            </td>
            <td width="100px">
              <input 
                  type="number"
                  placeholder="S"
                  class="form-control"
                  name="i{{ $row->id }}"
                  onchange="input_kehadiran('i','i{{ $row->id }}',{{ $row->id }})"
                  value="{{ $row->kehadiran->i }}">
            </td>
            <td width="100px">
              <input 
                  type="number"
                  placeholder="S"
                  class="form-control"
                  name="a{{ $row->id }}"
                  onchange="input_kehadiran('a','a{{ $row->id }}',{{ $row->id }})"
                  value="{{ $row->kehadiran->a }}">
            </td>
            <td width="100px">
              <a href="/guru/ekskul?nisn={{ $row->nisn }}&ta_id={{  request('ta_id') }}&kelas_id={{ request('kelas_id') }}&semester={{  request('semester') }}" class="btn btn-info btn-sm btn-block">Tambahkan</a>
            </td>
            <td>
              <a href="/guru/raport/cetak?ta_id={{  request('ta_id') }}&kelas_id={{  request('kelas_id') }}&semester={{  request('semester') }}&nisn={{ $row->nisn }}" class="btn btn-primary btn-sm" target="blank"><i class="fas fa-print"></i> Cetak</a>
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  <div class="float-right">
    {{-- {{$siswa->links()}} --}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->



<script src="/plugins/jquery/jquery.min.js"></script>

<script>

  function input_kehadiran(field, form, id){
    var nilai = $("[name='"+form+"']").val()

    // console.log(nilai)

    $.ajax({
      method:'GET',
      url:'/guru/raport/kehadiran/update?id='+id+'&field='+field+'&nilai='+nilai,
      dataType:'json',
      success:function(data){
        console.log(data);
      }
    })
  }


  $(document).ready(function(){
    $('#ta option[value=""]').prop('selected',true);
    $('#kelas option[value!=""]').remove();

    ta = $('#ta')
    ta.on('change', function() {
        $this = $(this)
        kelas = $('#kelas')

        if ($this.val() !== '') {
            $.ajax({
                url: "{{url('/get-kelas-raport')}}" +'/' +$this.val() , 
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    if (response !== 'NOT OK') {
                        kelas.removeAttr('disabled')
                        kelas.html(response)
                    }
                }
            });
        } else {
            kelas.prop('disabled', true)
            kelas.find('option').val('').text('Pilih Tahun Ajaran')
        }
    })  
  });
</script>



