@extends('layouts.master')  

@section('content')
<div class="col-12">
  <div class="card card-outline card-success">
    <div class="card-header">
      <h4 class="card-title">
        Data Jabatan
      </h4>
      <div class="card-tools">
        <a href="{{ route('jabatan.create') }}" class="btn btn-success btn-xs">
          <span class="fa fa-plus"></span> &ensp; Tambah Data Jabatan
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered" style="width: 150%;">
          <thead>
            <tr>
              <th width="5%" class="text-center">No.</th>
              <th>Nomor Surat</th>
              <th>Pengirim Surat</th>
              <th>Perihal</th>
              <th>Surat Dari</th>
              <th>Disposisi Pada</th>
              <th>Catatan</th>
              <th class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($disposisi as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td><a href="{{ route('surat-masuk.show', $item->surat_id) }}" target="_blank">{{ $item->surat->nomor_surat }}</a></td>
                <td>{{ $item->surat->perihal }}</td>
                <td>{{ $item->diteruskanUser->nama }}</td>
                <td>{{ $item->penginput->jabatan->nama }} - {{ $item->penginput->nama }} </td>
                <td>{{ $item->diteruskanUser->jabatan->nama }} - {{ $item->diteruskanUser->nama }} </td>
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
                <td colspan="8">Belum Ada Data Disposisi</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection