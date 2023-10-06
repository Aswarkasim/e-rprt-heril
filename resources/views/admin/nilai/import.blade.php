<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Nilai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/guru/nilai/import" method="POST" enctype="multipart/form-data">
            @csrf

              <input type="hidden" name="ta_id" value="{{ request('ta_id') }}">
              <input type="hidden" name="mapel_id" value="{{ request('mapel_id') }}">
              <input type="hidden" name="kelas_id" value="{{ request('kelas_id') }}">
              <input type="hidden" name="semester" value="{{ request('semester') }}">

            <div class="form-group">
              <input type="file" class="form-control" name="file">
              <p>Download format import <a href="/guru/nilai/download/format"><i class="fas fa-download"></i> di sini</a></p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
            </div>

          </form>
        </div>
        
      </div>
    </div>
  </div>