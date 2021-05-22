@extends('layouts.master')  

@section('content')
<div class="col-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h4 class="card-title">Informasi Surat</h4>
      <div class="card-tools">
        <a href="{{ route('surat-masuk.index') }}" class="btn btn-danger btn-xs">
          <span class="fa fa-arrow-left"></span> &ensp; Kembali
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <div class="row justify-content-between">
            <div class="col-md-6">
              <div class="table-responsive">
                <table>
                  <tr>
                    <td>Nomor Surat</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->nomor_surat) ? '-':$suratMasuk->nomor_surat }}</span></td>
                  </tr>
                  <tr>
                    <td>Pengirim Surat</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->pengirim) ? '-':$suratMasuk->pengirim }}</span></td>
                  </tr>
                  <tr>
                    <td>Perihal</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->perihal) ? '-':$suratMasuk->perihal }}</span></td>
                  </tr>
                  <tr>
                    <td>Lampiran</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->lampiran) ? '-':$suratMasuk->lampiran }}</span></td>
                  </tr>
                  <tr>
                    <td>Surat di-Tujukan</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->surat_ditujukan) ? '-':$suratMasuk->surat_ditujukan }}</span></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-md-4">
              <div class="table-responsive">
                <table>
                  <tr>
                    <td>Tanggal Surat</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ date('d/m/Y', strtotime($suratMasuk->tgl_surat)) }}</span></td>
                  </tr>
                  <tr>
                    <td>Tanggal Terima</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ date('d/m/Y', strtotime($suratMasuk->tgl_terima)) }}</span></td>
                  </tr>
                  <tr>
                    <td>Sifat</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->sifat) ? '-':$suratMasuk->sifat }}</span></td>
                  </tr>
                </table>
              </div> 
            </div>
            <div class="col-12 mt-2">
              <div class="table-responsive">
                <table>
                  <tr>
                    <td>Konteks Isi Singkat Surat</td>
                    <td width="10%" class="text-center">:</td>
                    <td><span class="font-weight-bolder">{{ empty($suratMasuk->isi_surat) ? '-':$suratMasuk->isi_surat }}</span></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <hr style="border-top: 3px solid #00000087 !important;">
        </div>
        <div class="col-12">
          <h5>File Surat : </h5>
          <hr style="border-top: 3px solid #00000087 !important;">
        </div>
        <div class="col-12">
          <div class="row">
            @forelse ($suratMasuk->files as $item)
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title w-100">
                      Dokumen ke-{{ $loop->iteration }}
                      <hr class="mb-0">
                    </h5>
                    <p class="card-text">
                      <form action="{{ route('surat-masuk.getFiles') }}" method="post" target="_blank">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="{{ $hashRead }}">
                        <input type="hidden" name="dataPdf" value="{{ rand(10, 99) . ($item->id + 30 + 1999) * 12 . rand(100, 999) }}">

                        <button type="submit" class="btn btn-outline btn-info btn-block">
                          <span class="fa fa-file"></span> &ensp; {{ $item->nama_file }}
                        </button>
                      </form>
                    </p>
                    <div class="btn-group">
                      <form action="{{ route('surat-masuk.getFiles') }}" method="post" target="_blank">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="action" value="{{ $hashDownload }}">
                        <input type="hidden" name="dataPdf" value="{{ rand(10, 99) . ($item->id + 30 + 1999) * 12 . rand(100, 999) }}">

                        <button type="submit" class="btn btn-outline btn-success btn-block">
                          <span class="fa fa-download"></span> &ensp; Unduh
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
