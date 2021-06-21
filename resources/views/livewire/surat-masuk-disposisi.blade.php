<div>
  <div class="row">
    {{-- <div class="col-12">
      <h5>Test</h5>
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title w-100">
            <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
              Collapsible Group Item #1
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="collapse show" data-parent="#accordion">
          <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
            3
            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
            laborum
            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
            nulla
            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
            beer
            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
            labore sustainable VHS.
          </div>
        </div>
      </div>
    </div> --}}
    <div class="col-12">
      <button type="button" class="btn btn-sm btn-info" wire:click="getTest()">Belum Di-Terima</button>                          

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
                      <button type="button" class="btn btn-sm btn-info" wire:click="doDetail('{{ $item['id'] }}')">Belum Di-Terima</button>                          
                      @break
                    @case(1)
                      <button type="button" class="btn btn-sm btn-success" wire:click="doDetail('{{ $item['id'] }}')">Di-Terima</button>                          
                      @break
                    @case(2)
                      <button type="button" class="btn btn-sm btn-success" wire:click="doDetail('{{ $item['id'] }}')">di-Lakukan Disposisi</button>                          
                      @break
                    @case(3)
                      <button type="button" class="btn btn-sm btn-success" wire:click="doDetail('{{ $item['id'] }}')">Selesai</button>                          
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

@livewire('disposisi-detail')

@push('script')
<script>
  
</script>
@endpush