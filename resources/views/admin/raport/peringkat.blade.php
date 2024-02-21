<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  {{-- <a href="/admin/siswa/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a> --}}


  <a href="/guru/raport?ta_id={{  request('ta_id') }}&kelas_id={{ request('kelas_id') }}&semester={{  request('semester') }}" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>

  <h3><b>Peringkat</b></h3>


  <div class="table-responsive">
    <table id="example1" class="table table-bordered">
      <thead>
        <tr>
          <th>NO</th>
          <th>NISN</th>
          <th>NAMA</th>
          <th class="text-center">Rerata Nilai</th>
          <th class="text-center"  width="350px">Isi Pesan</th>
          <th class="text-center">Berikan Pesan</th>

      </thead>

        <tbody>

          @foreach($peringkat as $row)
          <tr>
            <td width="50px">{{$loop->iteration}}</td>
            <td>{{ $row->nisn }}</td>
            <td>{!!  $row->siswa->name.'<br>'.$row->siswa->tanggal_lahir !!}</td>
            <td>{{ $row->rerata_nilai }}</td>
            <td>{{ $row->pesan }}</td>
            <td>
              @include('admin.raport.pesanmodal')
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



