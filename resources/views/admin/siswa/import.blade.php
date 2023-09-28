<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-upload"></i> Import
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/admin/siswa/import" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <input type="file" class="form-control" name="file">
              <p>Download format import <a href="/admin/siswa/download/format"><i class="fas fa-download"></i> di sini</a></p>
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