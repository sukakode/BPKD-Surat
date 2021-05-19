@extends('layouts.master')

@section('content')
<div class="col-12">
  <div class="card card-outline card-info">
    <div class="card-header">
      <h5 class="card-title">
        Data Pengguna
      </h5>
      <div class="card-tools">
        <a href="{{ route('pengguna.create') }}" class="btn btn-success btn-xs">
          <span class="fa fa-plus"></span> &ensp; Buat Data Pengguna
        </a>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>No. Telp</th>
              <th>E-Mail</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $item)
              <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan->nama }}</td>
                <td>{{ $item->notelp }}</td>
                <td>{{ $item->email }}</td>
                <td class="text-center">
                  @if (auth()->user()->id == $item->id)
                    <button class="btn btn-secondary btn-sm">
                      Tidak Ada Aksi
                    </button>
                  @else
                  <div class="btn-group">
                    <form action="{{ route('pengguna.destroy', $item->id) }}" method="post">
                      @csrf
                      @method('DELETE')

                      <a href="{{ route('pengguna.edit', $item->id) }}" class="btn btn-outline-info btn-sm">
                        Edit Data
                      </a>
                      <button type="submit" class="btn btn-outline-danger btn-sm">
                        Hapus Data
                      </button>
                    </form>
                  </div>
                  @endif

                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">Belum Ada Data</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection