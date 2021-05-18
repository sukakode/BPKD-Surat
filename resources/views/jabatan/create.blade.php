@extends('layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-success">
    <div class="card-header">
      <h4 class="card-title">
        Tambah Data Jabatan
      </h4>
      <div class="card-tools">
        <a href="{{ route('jabatan.index') }}" class="btn btn-xs btn-danger">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{ route('jabatan.store') }}" method="post">
        @csrf
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="nama" class="font-weight-normal">Nama Jabatan : </label>
              <input type="text" name="nama" id="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" placeholder="Masukan Nama Jabatan..." max="35" value="{{ old('name') }}" required autocomplete="off" autofocus>
              <span class="invalid-feedback">
                {{ $errors->first('nama') }}
              </span>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label for="keterangan" class="font-weight-normal">Keterangan : </label>
              <textarea name="keterangan" id="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid':'' }}" cols="1" rows="1" maxlength="100" placeholder="Masukan Keterangan Jabatan... *Keterangan Boleh di-Kosongkan">{{ old('keterangan') }}</textarea>
              <span class="invalid-feedback">
                {{ $errors->first('keterangan') }}
              </span>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <button type="submit" class="btn btn-block btn-success btn-sm">
                <span class="fa fa-check"></span> &ensp; Buat Data Jabatan
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
    </div>
  </div>
</div>
@endsection