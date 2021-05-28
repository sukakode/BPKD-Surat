<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisposisiAktif extends Component
{
    public $disposisi = [];
    public $disposisiAktif = [];

    public function mount(Disposisi $disposisi)
    {
        $this->disposisi = $disposisi;
        $selanjutnya = $disposisi->disposisi_selanjutnya;
        if ($selanjutnya != null) {
            $exploded = explode(',', $selanjutnya);
            $data = [];
            foreach ($exploded as $key => $value) {
                $dipsosisiAktif = Disposisi::where('penginput_id', Auth::user()->id)
                    ->where('status_penginput', 1)
                    ->where('disposisi_sebelumnya', $disposisi->id)
                    ->with('diteruskanUser')
                    ->with('diteruskanUser.jabatan')
                    ->first();
    
                array_push($data, $dipsosisiAktif->toArray());
            }
            $this->disposisiAktif = $data;
        }
    }

    public function render()
    {
        return view('livewire.disposisi-aktif');
    }
}
