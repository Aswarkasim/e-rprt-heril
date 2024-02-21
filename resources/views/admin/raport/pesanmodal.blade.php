    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">
        Berikan Pesan
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pesan Untuk : {{ $row->siswa->name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="/guru/peringkat/pesan/{{ $row->id }}" method="POST">
                @method('PUT')
              @csrf
              <div class="modal-body">
                {{-- <input type="hidden" name="peringkat_id" value="{{ $row->id }}"> --}}
                <textarea name="pesan" class="form-control" id="" cols="30" rows="10">{{ $row->pesan }}</textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>