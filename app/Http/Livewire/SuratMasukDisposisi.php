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
    public $disposisiDetail = [];

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

    public function getData($id)
    {
        try {
            $disposisi = Disposisi::findOrFail($id);
            $this->disposisiDetail[$id] = $disposisi->toArray();
            if ($disposisi->disposisi_selanjutnya != null) {
                $explode = explode(',', $disposisi->disposisi_selanjutnya);
                if (count($explode) > 0) {
                    $detail = $this->getDetail($explode);
                    $this->disposisiDetail[$id]['lanjutan'] = $detail;
                    foreach ($detail as $key => $value) {
                        $this->getData($key);
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getDetail($explode)
    {
        try {
            $lanjutan = [];
            foreach ($explode as $key => $value) {
                $detail = Disposisi::findOrFail($value)->toArray();
                $lanjutan[$value] = $detail; 
            }
            return $lanjutan;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getTest()
    {
        dd($this->disposisiDetail);
    }

    function myfunction($products, $field, $value)
    {
        foreach($products as $key => $product)
        {
            if ( $product[$field] === $value )
            return $key;
        }
        return false;
    }

    
}
