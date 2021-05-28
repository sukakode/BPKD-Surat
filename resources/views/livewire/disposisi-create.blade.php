<div>
  <div class="row m-0 p-0">
    <div class="col-12 mt-2">
      <div class="row">
        <div class="col-md-8">
          <h5>Disposisi Surat :</h5>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-success btn-sm btn-block">
            <span class="fa fa-check"></span> &ensp; Buat dan Kirim Disposisi
          </button>
        </div>
        <div class="col-12">
          <hr style="border-top: 3px solid #00000087 !important;">
        </div>
      </div>
    </div>
    <div class="col-12 pl-4 pr-4">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group" wire:ignore>
            <label>Tujuan Disposisi : </label>
            <div class="select2-success">
              <select id="disposisi_user" class="form-control select2" data-placeholder="Pilih Tujuan Disposisi Surat..." data-dropdown-css-class="select2" style="width: 100%;">
                <option value=""></option>
                @foreach ($disposisi_user as $item)
                  <option value="{{ $item->id }}">{{ $item->jabatan->nama }} - {{ $item->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group" wire:ignore>
            <label>Catatan Disposisi : </label>
            <textarea wire:model.lazy="catatan" id="catatan" maxlength="100" placeholder="Masukan Catatan Disposisi..." cols="1" rows="1" class="form-control"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="" class="d-none d-md-block">&ensp;</label>
            <button type="button" class="btn btn-info btn-block" wire:click="tambahDisposisi()">
              <span class="fa fa-arrow-right"></span> &ensp; Disposisi
            </button>
          </div>
        </div>
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Tujuan Disposisi</th>
                  <th>Catatan</th>
                  <th class="text-center" width="5%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($disposisi as $key => $item)
                  <tr>
                    <td class="align-middle"><h6 class="m-0">{{ $item['jabatan'] }} || {{ $item['nama'] }}</h6></td>
                    <td class="align-middle"><h6 class="m-0">{!! $item['catatan'] == '' ? '<i>Tidak Ada Catatan</i>':$item['catatan'] !!}</h6></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-danger btn-sm" wire:click="hapusDisposisi('{{ $key }}')">
                        <span class="fa fa-trash"></span>
                      </button>
                      <input type="hidden" name="disposisi_user_id[]" value="{{ $key }}">
                      <input type="hidden" name="disposisi_catatan[]" value="{{ $item['catatan'] }}">
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3">Belum Ada Tujuan Disposisi</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <span class="text-danger"> 
              {{ $errors->first('disposisi_user_id') }}
              {{ $errors->first('disposisi_user_id.*') }}
              {{ $errors->first('disposisi_catatan') }}
              {{ $errors->first('disposisi_catatan.*') }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<style>
  .select2-container .select2-selection--single {
    height: 38px !important;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 34px !important;
  }
</style>
@endpush

@push('script')
<script src="{{ asset('assets') }}/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function () {
    $('.select2').select2(); 

    $('#disposisi_user').on('change', function (e) {
      @this.set('user_disposisi', e.target.value);
    });

    Livewire.on('reset', () => {
      $('#disposisi_user').val(null).trigger('change');
    });
  });
</script>
@endpush