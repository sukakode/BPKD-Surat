@extends('layouts.master')  

@section('content')
<div class="col-12"> 
  <div class="card card-outline card-success">
    <div class="card-header d-flex p-0">
      <h3 class="card-title p-3">Data Disposisi</h3>
      <ul class="nav nav-pills ml-auto p-2">
        <li class="nav-item"><a class="nav-link active" href="#masuk" data-toggle="tab">Disposisi Masuk</a></li>
        <li class="nav-item"><a class="nav-link" href="#keluar" data-toggle="tab">Disposisi Keluar</a></li> 
      </ul>
    </div>
    <div class="card-body p-0">
      <div class="tab-content">
        <div class="tab-pane active" id="masuk">
          <div class="table-responsive">
            <table class="table table-bordered" style="width: 150%;">
              <thead>
                <tr>
                  <th width="5%" class="text-center">No.</th>
                  <th>Nomor Surat</th>
                  <th>Pengirim Surat</th>
                  <th>Perihal</th>
                  <th>Surat Dari</th>
                  <th>Catatan</th>
                  <th class="text-center">Status</th>
                  <th width="18%" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($disposisiMasuk as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td>{{ $item->surat->nomor_surat }}</td>
                    <td>{{ $item->surat->perihal }}</td>
                    <td>{{ $item->diteruskanUser->nama }}</td>
                    <td>{{ $item->penginput->jabatan->nama }} - {{ $item->penginput->nama }} </td>
                    <td>{!! empty($item->catatan) ? '<i>Tidak Ada Catatan</i>':$item->catatan !!}</td>
                    <td class="text-center">
                      @switch($item->status_penerima)
                        @case(0)
                          <span class="badge badge-secondary">Belum di-Terima</span>
                          @break
                        @case(1)
                          <span class="badge badge-success">Disposisi di-Terima</span>                            
                          @break
                        @case(2)
                          <span class="badge badge-info">di-Lakukan Disposisi</span>                            
                          @break
                        @case(3)
                          <span class="badge badge-primary">Disposisi Selesai</span>                            
                          @break
                        @default
                        <span class="badge badge-secondary">Tidak Ada Informasi</span>                            
                      @endswitch
                    </td>

                    <td class="text-center">
                      @if ($item->status_penerima == 0)
                        <form action="{{ route('disposisi.terima', $item->id) }}" method="post">
                          @csrf
                          <button type="submit" class="btn btn-success btn-sm">
                            <span class="fa fa-check"></span> &ensp; Terima Surat
                          </button>
                        </form>
                      @else
                        @switch($item->status_penerima)
                          @case(1)
                            <form action="{{ route('disposisi.selesai', $item->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              <a href="{{ route('disposisi.surat', $item->id) }}" class="btn btn-outline-primary mt-1 btn-sm">
                                {{-- <span class="fa fa-eye"></span> --}}
                                Lihat Surat
                              </a>
                              <a href="{{ route('disposisi.create', $item->id) }}" class="btn btn-outline-secondary mt-1 btn-sm">
                                {{-- <span class="fa fa-sign-in-alt"></span> --}}
                                Disposisi Surat
                              </a>    

                              <button type="submit" class="btn btn-outline-success mt-1 btn-sm">
                                {{-- <span class="fa fa-check"></span> --}}
                                Disposisi Selesai
                              </button>
                            </form>
                            @break
                          @case(2)
                            <a href="{{ route('disposisi.surat', $item->id) }}" class="btn btn-outline-primary mt-1 btn-sm">
                              {{-- <span class="fa fa-eye"></span> --}}
                              Lihat Surat
                            </a>
                            <a href="{{ route('disposisi.create', $item->id) }}" class="btn btn-outline-secondary mt-1 btn-sm">
                              {{-- <span class="fa fa-sign-in-alt"></span> --}}
                              Disposisi Surat
                            </a>    
                            @break
                          @case(3)
                            <a href="{{ route('disposisi.surat', $item->id) }}" class="btn btn-outline-primary mt-1 btn-sm">
                              {{-- <span class="fa fa-eye"></span> --}}
                              Lihat Surat
                            </a>
                            @break
                          @default
                          <a href="{{ route('disposisi.surat', $item->id) }}" class="btn btn-outline-primary mt-1 btn-sm">
                            {{-- <span class="fa fa-eye"></span> --}}
                            Lihat Surat
                          </a>
                        @endswitch 
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8">Belum Ada Data Disposisi</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="tab-pane" id="keluar">
          <div class="table-responsive">
            <table class="table table-bordered" style="width: 150%;">
              <thead>
                <tr>
                  <th width="5%" class="text-center">No.</th>
                  <th>Nomor Surat</th>
                  <th>Pengirim Surat</th>
                  <th>Perihal</th>
                  <th>Disposisi Untuk</th>
                  <th>Catatan</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($disposisiKeluar as $item)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}.</td>
                    <td><a target="_blank" href="{{ route('disposisi.surat', $item->id) }}">{{ $item->surat->nomor_surat }}</a></td>
                    <td>{{ $item->surat->pengirim }}</td>
                    <td>{{ $item->surat->perihal }}</td>
                    <td>{{ $item->diteruskanUser->nama }}</td>
                    <td>{!! empty($item->catatan) ? '<i>Tidak Ada Catatan</i>':$item->catatan !!}</td>

                    <td class="text-center">
                      @switch($item->status_penerima)
                        @case(0)
                          <span class="badge badge-secondary">Belum di-Terima</span>
                          @break
                        @case(1)
                          <span class="badge badge-success">Disposisi di-Terima</span>                            
                          @break
                        @case(2)
                          <span class="badge badge-info">di-Lakukan Disposisi</span>                            
                          @break
                        @case(3)
                          <span class="badge badge-primary">Disposisi Selesai</span>                            
                          @break
                        @default
                        <span class="badge badge-secondary">Tidak Ada Informasi</span>                            
                      @endswitch
                    </td> 
                  </tr>
                @empty
                  <tr>
                    <td colspan="7">Belum Ada Data Disposisi</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
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