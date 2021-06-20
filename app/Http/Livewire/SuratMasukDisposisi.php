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

    public function getData($id)
    {
        $array = [];
        $array2 = [];
        $array3 = [];
        try {
            $this->disposisiDetail = $this->getDetail($id);
            if ($this->disposisiDetail['disposisi_selanjutnya'] != null) {
                $ex = explode(',', $this->disposisiDetail['disposisi_selanjutnya']);
                if (count($ex) > 0) {
                    foreach ($ex as $key => $value) {
                        $detail = $this->getDetail($value);
                        $array[$value] = $detail;
                    }
                    $this->disposisiDetail['lanjutan'] = $array;

                    if (count($this->disposisiDetail['lanjutan']) > 0) {
                        foreach ($this->disposisiDetail['lanjutan'] as $key2 => $value2) {
                            if ($value2['disposisi_selanjutnya'] != null) {
                                $ex2 = explode(',', $value2['disposisi_selanjutnya']);
                                if (count($ex2) > 0) {
                                    foreach ($ex2 as $key3 => $value3) {
                                        $detail2 = $this->getDetail($value3);
                                        $array2[$value3] = $detail2;
                                    }
    
                                    $this->disposisiDetail['lanjutan'][$value2['id']]['lanjutan'] = $array2;
                                    
                                    if (count($this->disposisiDetail['lanjutan'][$value2['id']]['lanjutan']) > 0) {
                                        foreach ($this->disposisiDetail['lanjutan'][$value2['id']]['lanjutan'] as $key4 => $value4) {
                                            if ($value4['disposisi_selanjutnya'] != null) {
                                                $ex3 = explode(',', $value4['disposisi_selanjutnya']);
                                                if (count($ex3) > 0) {
                                                    foreach ($ex3 as $key5 => $value5) {
                                                        $detail3 = $this->getDetail($value5);
                                                        $array3[$value5] = $detail3;
                                                    }

                                                    $this->disposisiDetail['lanjutan'][$value2['id']]['lanjutan'][$value4['id']]['lanjutan'] = $array3;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getDetail($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        return $disposisi->toArray();
    }

    public function setData()
    {
        //
    }

    public function getTest()
    {
        // dd(Hash::make("test"));
        // dd($this->disposisiAktif);
        // $this->myfunction($this->disposisiDetail["1"]['lanjutan'], "2", null);

        foreach ($this->disposisiAktif as $key => $value) {
            if($value['id'] === 8) {
                dd($key);
            }
        }
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
