@extends('layouts.master')

@section('css')
<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .select2-container .select2-selection--single {
    height: 38px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 34px !important;
  }

  .borad-r {
    border-top-right-radius: .25rem !important;
    border-bottom-right-radius: .25rem !important;
  }
</style>

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content')
<div class="col-12">
  <div class="card card-outline card-success">
    <div class="card-header">
      <h4 class="card-title">
        Tambah Data Jabatan Disposisi - {{ $jabatan->nama }}
      </h4>
      <div class="card-tools">
        <a href="{{ route('jabatan.index') }}" class="btn btn-xs btn-danger">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body pt-3">
        <div class="row">
          <div class="col-12">
            <h5>Data Diri Pengguna : </h5>
            <hr style="border-top: 3px solid #00000087 !important;">
          </div>
          <div class="col-12 pl-4 pr-4">
            <form action="{{ route('jabatan-disposisi.store', $jabatan->id) }}" method="post">
              @csrf
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="jabatan_dituju" class="font-weight-normal {{ $errors->has('jabatan_dituju') ? 'is-invalid':'' }}">Jabatan Pengguna : </label>
                    <select name="jabatan_dituju" id="jabatan_dituju" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Jabatan Pengguna" required>
                      <option value=""></option>
                      @foreach ($data as $item)
                        @if ($item->id != $jabatan->id)
                        <option value="{{ $item->id }}" {{ old('jabatan_dituju') == $item->id ? 'selected':'' }}>{{ $item->nama }} {{ empty($item->keterangan) ? '':'|| '. $item->keterangan }}</option>
                        @endif
                      @endforeach
                    </select>
                    <span class="invalid-feedback">
                      {{ $errors->first('jabatan_dituju') }}
                    </span>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">&ensp;</label>
                    <button type="submit" class="btn btn-block btn-success btn-sm">
                      <span class="fa fa-check"></span> &ensp; Buat Data Jabatan
                    </button>
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="col-12">
            <h5>Dapat di-Tujukan : </h5>
            <hr style="border-top: 3px solid #00000087 !important;">
          </div>
          <div class="col-12 pl-4 pr-4">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%" class="text-center">No.</th>
                  <th>Dari</th>
                  <th>Nama Jabatan</th>
                  <th width="25%" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($jabatan->disposisi as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $jabatan->nama }}</td>
                    <td>{{ $item->jabatan_tuju->nama }}</td>
                    <td class="text-center">
                      <div class="btn-group">
                        <form action="{{ route('jabatan-disposisi.destroy', ['jabatan' => $jabatan->id, 'jabatan_disposisi' => $item->id]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-outline-danger btn-sm">
                            Hapus Data
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4">Tidak memiliki hak disposisi</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        
    </div>
  </div>
</div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2(); 
  });
</script>
@endsection