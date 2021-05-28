<div>
  <div class="row">
    <div class="col-12">
      
    </div>
    <div class="col-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Di-Teruskan Kepada</th>
              <th class="text-center">Status Penerima</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($disposisiAktif as $item)
              <tr>
                <td>{{ $item['diteruskan_user']['jabatan']['nama'] }} - {{ $item['diteruskan_user']['nama'] }}</td>
                <td class="text-center">
                  @switch($item['status_penerima'])
                    @case(0)
                      <button type="button" class="btn btn-sm btn-info">Belum Di-Terima</button>                          
                      @break
                    @case(1)
                      <button type="button" class="btn btn-sm btn-success">Di-Terima</button>                          
                      @break
                    @case(2)
                      <button type="button" class="btn btn-sm btn-success">di-Lakukan Disposisi</button>                          
                      @break
                    @case(3)
                      <button type="button" class="btn btn-sm btn-success">Selesai</button>                          
                      @break
                    @default
                    <button class="btn btn-sm btn-secondary">Tidak Ada Informasi</button>
                  @endswitch
                </td>
                <td class="text-center">
                  @if ($item['status_penerima'] == 1 || $item['status_penerima'] == 0)
                  <button class="btn btn-danger btn-sm" wire:click="hapusDisposisi('{{ $item['id'] }}')">
                    Hapus & Batalkan Disposisi
                  </button>
                  @else
                  <button class="btn btn-secondary btn-sm">
                    Tidak Ada Aksi
                  </button>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3">Belum Ada Disposisi Aktif</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  
</script>
@endpush