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
  <div class="card card-outline card-info">
    <div class="card-header">
      <h5 class="card-title">
        Edit Data Pengguna
      </h5>
      <div class="card-tools">
        <a href="{{ route('pengguna.index') }}" class="btn btn-danger btn-xs">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('pengguna.update', $pengguna->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row p-3" style="border: 1px solid #00000087; border-radius: 10px;">
          <div class="col-12">
            <h5>Data Diri Pengguna : </h5>
            <hr style="border-top: 3px solid #00000087 !important;">
          </div>
          <div class="col-12 pl-4 pr-4">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">  
                  <label for="nip" class="font-weight-normal">NIP : </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="nip">
                        <i class="fa fa-address-card"></i>
                      </span>
                    </div>
                    <input type="number" name="nip" id="nip" class="form-control borad-r {{ $errors->has('nip') ? 'is-invalid':'' }}" maxlength="18" pattern="/d" value="{{ empty(old('nip')) ? $pengguna->nip:old('nip') }}" placeholder="Masukan NIP Pengguna..." required autocomplete="off" autofocus>
                    <span class="invalid-feedback">
                      {{ $errors->first('nip') }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="nama" class="font-weight-normal">Nama Pengguna : </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="nama">
                        <i class="fa fa-user"></i>
                      </span>
                    </div>
                    <input type="text" name="nama" id="nama" class="form-control borad-r {{ $errors->has('nama') ? 'is-invalid':'' }}" max="35" maxlength="35" value="{{ empty(old('nama')) ? $pengguna->nama:old('nama') }}" placeholder="Masukan Nama Pengguna..." required autocomplete="off">
                    <span class="invalid-feedback">
                      {{ $errors->first('nama') }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="notelp" class="font-weight-normal">Nomor Telpon : </label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="notelp">
                        +62
                      </span>
                    </div>
                    <input type="text" name="notelp" id="notelp" class="form-control borad-r {{ $errors->has('notelp') ? 'is-invalid':'' }}" maxlength="14" pattern="\d*" placeholder="Masukan Nomor Telpon..." value="{{ empty(old('notelp')) ? $pengguna->notelp:old('notelp') }}" required autocomplete="off">
                    <span class="invalid-feedback">
                      {{ $errors->first('notelp') }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="jabatan_id" class="font-weight-normal {{ $errors->has('jabatan_id') ? 'is-invalid':'' }}">Jabatan Pengguna : </label>
                  <select name="jabatan_id" id="jabatan_id" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Jabatan Pengguna" required>
                    <option value=""></option>
                    @foreach ($jabatan as $item)
                      @if (empty(old('jabatan_id')))
                      <option value="{{ $item->id }}" {{ $pengguna->jabatan_id == $item->id ? 'selected':'' }}>{{ $item->nama }} {{ empty($item->keterangan) ? '':'|| '. $item->keterangan }}</option>
                      @else
                      <option value="{{ $item->id }}" {{ old('jabatan_id') == $item->id ? 'selected':'' }}>{{ $item->nama }} {{ empty($item->keterangan) ? '':'|| '. $item->keterangan }}</option>
                      @endif
                    @endforeach
                  </select>
                  <span class="invalid-feedback">
                    {{ $errors->first('jabatan_id') }}
                  </span>
                </div>
              </div> 
            </div>
          </div>
          <div class="col-12 mt-2">
            <h5>Data Login Pengguna : </h5>
            <hr style="border-top: 3px solid #00000087 !important;">
          </div>
          <div class="col-12 pl-4 pr-4">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="font-weight-normal">E-Mail Pengguna :</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-envelope"></i>
                      </span>
                    </div>
                    <input type="email" name="email" id="email" class="form-control borad-r {{ $errors->has('email') ? 'is-invalid':'' }}" maxlength="246" placeholder="Masukan E-Mail Pengguna..." value="{{ empty(old('email')) ? $pengguna->email:old('email') }}" required>
                    <span class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="font-weight-normal">Tulis Ulang E-Mail Pengguna :</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-envelope"></i>
                      </span>
                    </div>
                    <input type="email" name="email_confirmation" id="email_confirmation" class="form-control borad-r {{ $errors->has('email') ? 'is-invalid':'' }}" maxlength="246" placeholder="Masukan Ulang E-Mail Pengguna..." value="{{ empty(old('email')) ? $pengguna->email:old('email') }}" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password" class="font-weight-normal">Password Pengguna :</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-key"></i>
                      </span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control borad-r {{ $errors->has('password') ? 'is-invalid':'' }}" maxlength="246" placeholder="Masukan Password Pengguna...">
                    <span class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="font-weight-normal">Tulis Ulang Password Pengguna :</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                      </span>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control borad-r {{ $errors->has('password') ? 'is-invalid':'' }}" maxlength="246" placeholder="Masukan Ulang Password Pengguna...">
                  </div>
                </div>
              </div>
              <div class="col-12">
                <hr>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <button type="submit" class="btn btn-block btn-success btn-sm">
                    <span class="fa fa-save"></span> &ensp; Ubah Data Jabatan
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
<!-- Select2 -->
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2(); 
  });
</script>
@endsection