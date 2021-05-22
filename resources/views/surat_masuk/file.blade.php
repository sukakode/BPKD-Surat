@extends('layouts.master')  

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Informasi Surat</h4>
      <div class="card-tools">
        <a href="{{ route('surat-masuk.show', $suratMasuk->id) }}" class="btn btn-danger btn-xs">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('surat-masuk.addFile', $suratMasuk->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="surat_file">File input</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input {{ $errors->has('surat_file.*') }}" name="surat_file[]" id="surat_file" multiple required>
                  <label class="custom-file-label" id="file_label" for="surat_file">Silahkan Pilih File</label>
                </div>  
              </div>
              <span class="text-secondary">
                &#8277; Format File Harus Berupa PDF, Ukuran Max: 10MB.
              </span>
              <span class="text-danger"> 
                {{ $errors->first('surat_file.*') }}
              </span>
            </div>
          </div>
          <div class="col-12">
            <hr class="mt-1">
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <button type="submit" class="btn btn-block btn-success btn-sm">
                <span class="fa fa-check"></span> &ensp; Tambah File Surat
              </button>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <button type="reset" class="btn btn-block btn-danger btn-sm">
                <span class="fa fa-undo"></span> &ensp; Reset Input
              </button>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-12">
          <hr style="border-top: 3px solid #00000087 !important;">
          <h5 class="mx-3">File Surat : </h5>
          <hr style="border-top: 3px solid #00000087 !important;">
        </div>
        <div class="col-12">
          <div class="row">
            @forelse ($suratMasuk->files as $item)
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-8">
                        <h5 class="card-title w-100">
                          Dokumen Surat ke -{{ $loop->iteration }}
                          <br> 
                          <span class="badge badge-success">
                            {{ $item->nama_file }}
                          </span>
                        </h5>
                      </div>
                      <div class="col-md-4 text-right">
                        <form action="{{ route('surat-masuk.deleteSurat', ['surat_masuk' => $suratMasuk->id, 'file' => $item->id]) }}" method="post">
                          @csrf
                          @method('DELETE')
    
                          <button type="submit" class="btn btn-danger btn-xs">
                            <span class="fa fa-trash"></span> &ensp; Hapus File
                          </button>
                        </form>
                      </div>
                      <div class="col-12">
                        <hr class="mb-0">
                      </div>
                    </div>
                    <div class="btn-group text-center">
                      <form action="{{ route('surat-masuk.getFiles') }}" method="post" target="_blank">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="{{ $hashDownload }}">
                        <input type="hidden" name="dataPdf" value="{{ rand(10, 99) . ($item->id + 30 + 1999) * 12 . rand(100, 999) }}">

                        <button type="submit" class="btn btn-outline btn-success btn-block mr-2 ml-1 my-2">
                          <span class="fa fa-download"></span> &ensp; Unduh
                        </button>
                      </form>
                      <form action="{{ route('surat-masuk.getFiles') }}" method="post" target="_blank">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="{{ $hashRead }}">
                        <input type="hidden" name="dataPdf" value="{{ rand(10, 99) . ($item->id + 30 + 1999) * 12 . rand(100, 999) }}">

                        <button type="submit" class="btn btn-outline btn-info btn-block mr-1 ml-2 my-2">
                          <span class="fa fa-eye"></span> &ensp; Lihat File
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title text-center">Tidak Memilki Hasil Scan Dokumen</h5>
                  </div>
                </div>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#surat_file').on('change', function() {
      var data_file = (this).files;
      var nama_file = "";
      for (let index = 0; index < data_file.length; index++) {
        var data = data_file[index].name;
        nama_file += data + ", "; 
      }

      $('#file_label').empty().append(nama_file);
    });
  });
</script>
@endsection