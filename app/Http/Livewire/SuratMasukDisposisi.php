<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuratMasukDisposisi extends Component
{
    public $surat = [];
    public $disposisiAktif = [];

    public function mount(Surat $surat)
    {
        $this->surat = $surat->toArray();
        $this->getDisposisi();
    }

    public function render()
    {
        return view('livewire.surat-masuk-disposisi');
    }

    public function hapusDisposisi($id)
    {
        try {
            $disposisi = Disposisi::findOrFail($id);
            $disposisi->delete();

            $this->emit('warning', 'Data Disposisi di-Hapus !');
            $this->reset(['disposisiAktif']);
            $this->getDisposisi();
        } catch (\Throwable $th) {
            $this->emit('error', 'Terjadi Kesalahan !');
        }
    }

    public function getDisposisi()
    {
        $disposisiAktif = Disposisi::where('surat_id', $this->surat['id'])
            ->where('penginput_id', Auth::user()->id)
            ->with('diteruskanUser')
            ->with('diteruskanUser.jabatan')
            ->get();

        if ($disposisiAktif->count() > 0) {
            $this->disposisiAktif = $disposisiAktif->toArray();
        }
    }
}
