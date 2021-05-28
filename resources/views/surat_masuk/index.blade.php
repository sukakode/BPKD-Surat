@extends('layouts.master')  

@section('content')
<div class="col-12">
  <div class="card card-outline card-success">
    <div class="card-header">
      <h4 class="card-title">
        Data Surat
      </h4>
      <div class="card-tools">
        <a href="{{ route('surat-masuk.create') }}" class="btn btn-success btn-xs">
          <span class="fa fa-plus"></span> &ensp; Tambah Data Surat
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%" class="text-center">No.</th>
              <th>Pengirim</th>
              <th>Perihal</th>
              <th class="text-center">Sifat</th>
              <th class="text-center">Tanggal Surat</th>
              <th class="text-center">Tanggal Terima</th>
              <th>File PDF</th>
              <th width="18%" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td>{{ $item->pengirim }}</td>
                <td>{{ $item->perihal }}</td>
                <td class="text-center">{{ empty($item->sifat) ? '-':$item->sifat }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($item->tgl_terima)) }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($item->tgl_surat)) }}</td>
                <td>{{ $item->files->count() }} File</td>
                <td class="text-center"> 
                  <div class="btn-group">
                    <form action="{{ route('surat-masuk.destroy', $item->id) }}" method="post">
                      @csrf
                      @method('DELETE')

                      <a href="{{ route('surat-masuk.show', $item->id) }}" class="btn btn-outline-primary mt-1 btn-sm">
                        {{-- <span class="fa fa-eye"></span>  --}}
                        Lihat Surat
                      </a>

                      <a href="{{ route('surat-masuk.edit', $item->id) }}" class="btn btn-outline-info mt-1 btn-sm">
                        {{-- <span class="fa fa-edit"></span> --}}
                        Edit
                      </a>
                      
                      <button type="submit" class="btn btn-outline-danger mt-1 btn-sm">
                        {{-- <span class="fa fa-trash"></span> --}}
                        Hapus
                      </button>

                      <a href="{{ route('surat-masuk.disposisi', $item->id) }}" class="btn btn-success mt-1 btn-sm">
                        {{-- <span class="fa fa-sign-in-alt"></span> --}}
                        Disposisi
                      </a>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">Belum Ada Data Surat Masuk</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> 
@endsection

@section('script')
<script>
  $(document).ready(function () {
    // $('.disposisi-surat').on('click', function() {
    //   var id = $(this).data('id');
    //   Livewire.emit('get-disposisi', id);
    // });

    // Livewire.on('openModal', () => {
    //   $('#modal-disposisi').modal('show');
    // });
  });
</script>
@endsection