<?php

namespace App\Http\Livewire;

use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisposisiDetail extends Component
{
    public $no = 1;
    public $disposisi = [];
    public $disposisiDetail = [];

    protected $listeners = [
        'get-data' => 'getData', 
    ];

    public function render()
    {
        return view('livewire.disposisi-detail');
    }

    public function hm()
    {
        $this->no++;
        dd($this->disposisiDetail);
    }

    
    public function getData($id)
    {
        $array = [];
        $array2 = [];
        $array3 = [];
        try {
            $this->disposisiDetail = $this->getDetail($id);
            $this->disposisi = Disposisi::with('penginput')->with('penginput.jabatan')->where('penginput_id', Auth::user()->id)->where('id', $id)->firstOrFail()->toArray();
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

            $this->emit('showModal', 'show');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function getDetail($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        return $disposisi->toArray();
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
