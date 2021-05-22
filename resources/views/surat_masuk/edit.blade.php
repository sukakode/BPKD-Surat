@extends('layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-success">
    <div class="card-header">
      <h4 class="card-title">
        Buat Data Surat Masuk
      </h4>
      <div class="card-tools">
        <a href="{{ route('surat-masuk.index') }}" class="btn btn-xs btn-danger">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('surat-masuk.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row p-3" style="border: 1px solid #00000087; border-radius: 10px;">
          <div class="col-12">
            <h5>Informasi Surat : <small class="float-right text-danger">&#8277; Wajib di-Isi</small></h5>
            <hr style="border-top: 3px solid #00000087 !important;">
          </div>
          <div class="col-12 pl-4 pr-4">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="pengirim" class="font-weight-normal">Pengirim Surat : <span class="text-danger">*</span></label>
                  <input type="text" name="pengirim" id="pengirim" class="form-control {{ $errors->has('pengirim') ? 'is-invalid':'' }}" placeholder="Masukan Pengirim Surat..." max="50" maxlength="50" value="{{ old('pengirim') }}" required autocomplete="off" autofocus>
                  <span class="invalid-feedback">
                    {{ $errors->first('pengirim') }}
                  </span>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="tgl_surat" class="font-weight-normal">Tanggal Surat : <span class="text-danger">*</span></label>
                  <input type="date" name="tgl_surat" id="tgl_surat" class="form-control {{ $errors->has('tgl_surat') ? 'is-invalid':'' }}" value="{{ empty(old('tgl_terima')) ? date('Y-m-d'):old('tgl_terima') }}" required autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('tgl_surat') }}
                  </span>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="tgl_terima" class="font-weight-normal">Tanggal Di-Terima : <span class="text-danger">*</span></label>
                  <input type="date" name="tgl_terima" id="tgl_terima" class="form-control {{ $errors->has('tgl_terima') ? 'is-invalid':'' }}" value="{{ empty(old('tgl_terima')) ? date('Y-m-d'):old('tgl_terima') }}" required autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('tgl_terima') }}
                  </span>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="nomor_surat" class="font-weight-normal">Nomor Surat : <span class="text-danger">*</span></label>
                  <input type="text" name="nomor_surat" id="nomor_surat" class="form-control {{ $errors->has('nomor_surat') ? 'is-invalid':'' }}" placeholder="Masukan Pengirim Surat..." max="30" maxlength="30" value="{{ old('nomor_surat') }}" required autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('nomor_surat') }}
                  </span>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="sifat" class="font-weight-normal">Sifat Surat : </label>
                  <input type="text" name="sifat" id="sifat" class="form-control {{ $errors->has('sifat') ? 'is-invalid':'' }}" placeholder="Masukan Sifat Surat..." max="20" maxlength="20" value="{{ old('sifat') }}" autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('sifat') }}
                  </span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lampiran" class="font-weight-normal">Lampiran : </label>
                  <input type="text" name="lampiran" id="lampiran" class="form-control {{ $errors->has('lampiran') ? 'is-invalid':'' }}" placeholder="Masukan Lampiran Surat..." max="50" maxlength="50" value="{{ old('lampiran') }}" autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('lampiran') }}
                  </span>
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group">
                  <label for="perihal" class="font-weight-normal">Perihal : </label>
                  <input type="text" name="perihal" id="perihal" class="form-control {{ $errors->has('perihal') ? 'is-invalid':'' }}" placeholder="Masukan Perihal..." max="40" maxlength="40" value="{{ old('perihal') }}" required autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('perihal') }}
                  </span>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="surat_ditujukan" class="font-weight-normal">Di Tujukan Kepada : </label>
                  <input type="text" name="surat_ditujukan" id="surat_ditujukan" class="form-control {{ $errors->has('surat_ditujukan') ? 'is-invalid':'' }}" placeholder="Masukan Di Tujukan Kepada..." max="40" maxlength="40" value="{{ old('surat_ditujukan') }}" required autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('surat_ditujukan') }}
                  </span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="perihal" class="font-weight-normal">Konteks Isi Surat Singkat : </label>
                  <textarea name="isi_singkat" id="isi_singkat" class="form-control {{ $errors->has('isi_singkat') ? 'is-invalid':'' }}" cols="1" rows="2" maxlength="100" placeholder="Masukan Konteks Isi Surat Singkat Surat Masuk...">{{ old('isi_singkat') }}</textarea>
                  <span class="invalid-feedback">
                    {{ $errors->first('isi_singkat') }}
                  </span>
                </div>
              </div> 
            </div>
          </div>
          <div class="col-12 mt-2">
            <h5>Upload Hasil Scan Surat : *</h5>
            <hr style="border-top: 3px solid #00000087 !important;">
          </div>
          <div class="col-12 pl-4 pr-4">
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
                    <span class="fa fa-check"></span> &ensp; Buat Data Surat
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
          </div>
        </div>
      </form>
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