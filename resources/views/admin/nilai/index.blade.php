<div class="row">
  <div class=" col-md-12">

<div class="card">
<div class="card-body">
  {{-- <a href="/admin/mapel/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a> --}}

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
          <div class="col-md-3"><label for="">Nama Mapel</label></div>
          <div class="col-md-9">
            <select name="mapel_id" class="form-control" id="" required>
              <option value="">--Nama Mapel--</option>
              @foreach ($mapel as $item)
                <option value="{{ $item->id }}" {{ request('mapel_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        
      </div>

      <div class="col-md-4">
        
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
      <button type="submit" class="btn btn-primary my-2"><i class="fas fa-search"></i> Kelola</button>
      
      @if (request('ta_id') && request('mapel_id'))

        <button type="button" class="btn btn-info mx-1 my-2" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-upload"></i> Import
        </button>
        
        <a href="/guru/nilai/save?ta_id={{  request('ta_id') }}&mapel_id={{  request('mapel_id') }}&kelas_id={{  request('kelas_id') }}&semester={{  request('semester') }}" class="btn btn-success my-2"><i class="fas fa-check"></i> Simpan</a>
      
        @endif

    </div>
  </form>

  <style>
    .kotak-nilai{
      width: 120px !important;
    }
  </style>
<table id="example1" class="table table-bordered">
  <thead>
    <tr>
      <th rowspan="2">NO</th>
      <th rowspan="2">NISN</th>
      <th rowspan="2">NAMA</th>
      <th class="text-center" colspan="2">ASESMEN FORMATIF</th>
      <th class="text-center" colspan="2">ASESMEN SUMATIF</th>
      <th class="text-center" rowspan="2">NILAI RAPORT</th>
    </tr>

    <tr class="text-center">
      <td class="kotak-nilai">TP1</td>
      <td class="kotak-nilai">TP2</td>
      <td class="kotak-nilai">TES</td>
      <td class="kotak-nilai">NON TES</td>
    </tr>

  </thead>

  <tbody>

    @foreach ($nilai as $item)
        
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->nisn }}</td>
        <td>{{ isset($siswa) ? $item->siswa->name : '' }}</td>
        <td class="text-center">
          <input 
                type="number"
                class="form-control"
                name="af_tp1{{ $item->id }}"
                onchange="input_nilai('af_tp1','af_tp1{{ $item->id }}',{{ $item->id }})"
                value="{{ $item->af_tp1 }}">
        </td>
        <td>
          <input  
                type="number"
                class="form-control"
                name="af_tp2{{ $item->id }}"
                onchange="input_nilai('af_tp2','af_tp2{{ $item->id }}',{{ $item->id }})"
                value="{{ $item->af_tp2 }}">
        </td>
        <td>
          <input 
                type="number"
                class="form-control"
                name="as_tes{{ $item->id }}"
                onchange="input_nilai('as_tes','as_tes{{ $item->id }}',{{ $item->id }})"
                value="{{ $item->as_tes }}">
        </td>
        <td>
          <input 
                type="number"
                class="form-control"
                name="as_nontes{{ $item->id }}"
                onchange="input_nilai('as_nontes','as_nontes{{ $item->id }}',{{ $item->id }})"
                value="{{ $item->as_nontes }}">
        </td>
        <td class="text-center"><span id="nilai-akhir{{ $item->id }}">{{ $item->nilai }}</span></td>
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

@include('admin.nilai.import')


<script src="/plugins/jquery/jquery.min.js"></script>

<script>
  

  function input_nilai(field, form, id){
    var nilai = $("[name='"+form+"']").val()
    console.log(nilai);

    $.ajax({
      method:'GET',
      url:'/guru/nilai/update?id='+id+'&field='+field+'&nilai='+nilai,
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
                url: "{{url('/get-kelas')}}" +'/' +$this.val() , 
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

