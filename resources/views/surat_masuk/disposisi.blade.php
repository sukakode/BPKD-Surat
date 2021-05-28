@extends('layouts.master')  

@section('content')
<div class="col-12"> 
  <div class="card card-outline card-success">
    <div class="card-header d-flex p-0">
      <h3 class="card-title p-3">Disposisi Surat Masuk</h3>
      <ul class="nav nav-pills float-right ml-auto p-2">
        <li class="nav-item"><a class="nav-link btn btn-danger text-white btn-sm mr-3" href="{{ route('surat-masuk.index') }}"><span class="fa fa-arrow-left"></span> &ensp; Kembali</a></li>
        <li class="nav-item"><a class="nav-link active" href="#masuk" data-toggle="tab">Buat Disposisi</a></li>
        <li class="nav-item"><a class="nav-link" href="#aktif" data-toggle="tab">Disposisi Aktif</a></li> 
        <li class="nav-item"><a class="nav-link" href="#keluar" data-toggle="tab">Detail Surat Masuk</a></li> 
      </ul>
    </div>
    <div class="card-body p-0">
      <div class="tab-content">
        <div class="tab-pane p-2 active" id="masuk"> 
          <form action="{{ route('surat-masuk.disposisi.create', $suratMasuk->id) }}" method="post">
            @csrf
            @livewire('disposisi-create')
          </form>
        </div>
        <div class="tab-pane" id="aktif"> 
          @livewire('surat-masuk-disposisi', ['surat' => $suratMasuk->id])
        </div>
        <div class="tab-pane p-2" id="keluar"> 
          <div class="row p-2">
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
              <div class="row px-4">
                <div class="col-md-12">
                  <h5 class="m-0">File Surat : </h5>
                </div> 
              </div>
              <hr style="border-top: 3px solid #00000087 !important;">
            </div>
            <div class="col-12">
              <div class="row">
                @forelse ($suratMasuk->files as $item)
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <h5 class="card-title w-100">
                              Dokumen Surat ke -{{ $loop->iteration }}
                              <br> 
                              <span class="badge badge-success">
                                {{ $item->nama_file }}
                              </span>
                            </h5>
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
  </div>
</div>

@endsection

@section('script')
<script>
  $(document).ready(function () {
    $('#disposisi-surat').on('click', function () {
      
    });
  });
</script>
@endsection