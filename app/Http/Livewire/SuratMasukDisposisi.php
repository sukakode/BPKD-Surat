<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function doDetail($id)
    {
        $this->emit('get-data', $id);
    }

    public function setData()
    {
        //
    }

    public function getTest()
    {
        // dd(Hash::make("test"));
        dd($this->disposisiDetail);
        // $this->myfunction($this->disposisiDetail["1"]['lanjutan'], "2", null);
    }

    function myfunction($products, $field, $value)
    {
        foreach ($products as $key => $value) {
            // dd($value);
            $value['lanjutan'] = "TEST";
            dd($value);
        }
        dd($products);
        // foreach($products as $key => $product)
        // {
        //     if ( $product[$field] === $value )
        //     return $key;
        // }
        // return false;
    }

    
}
