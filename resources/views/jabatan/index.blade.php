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
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="5%" class="text-center">No.</th>
              <th>Nama Jabatan</th>
              <th>Keterangan</th>
              <th width="25%" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td>{{ $item->nama }}</td>
                <td>{!! empty($item->keterangan) ? '<i>Tidak Ada Keterangan</i>':$item->keterangan !!}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <form action="{{ route('jabatan.destroy', $item->id) }}" method="post">
                      @csrf
                      @method('DELETE')

                      <a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-outline-info m-1 btn-sm">
                        Edit Data
                      </a>
                      <button type="submit" class="btn btn-outline-danger m-1 btn-sm">
                        Hapus Data
                      </button>

                      <a href="{{ route('jabatan-disposisi.index', $item->id) }}" class="btn btn-outline-success m-1 btn-sm">
                        Atur Disposisi
                      </a>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4">Belum Ada Data Jabatan</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection