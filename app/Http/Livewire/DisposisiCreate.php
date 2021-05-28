<?php

namespace App\Http\Livewire;

use App\Models\Jabatan;
use App\Models\JabatanDisposisi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DisposisiCreate extends Component
{
    public $jabatan_dituju = [];
    public $disposisi_user = [];

    public $user_disposisi = '';
    public $catatan = '';

    public $disposisi = [];

    public function mount() {
        $jabatan_dituju = Auth::user()->jabatan->disposisi->pluck('jabatan_dituju')->toArray();
        $disposisi_user = User::whereIn('jabatan_id', $jabatan_dituju)->get();
        $this->jabatan_dituju = $jabatan_dituju;
        $this->disposisi_user = $disposisi_user;
    }

    public function render()
    {
        return view('livewire.disposisi-create');
    }

    public function tambahDisposisi()
    {
        try {
            $user = User::with('jabatan')->findOrFail($this->user_disposisi);
            $jabatan = JabatanDisposisi::where('jabatan_id', Auth::user()->jabatan_id)->where('jabatan_dituju', $user->jabatan_id)->firstOrFail();
            $data = [ 
                'nama' => $user->nama,
                'jabatan' => $user->jabatan->nama,
                'catatan' => $this->catatan,
            ];

            $this->emit('reset');
            $this->reset(['catatan', 'user_disposisi']);

            $this->disposisi[$user->id] = $data;
            $this->emit('success', 'Tujuan Disposisi di-Tambahkan !');
        } catch (\Throwable $th) {
            $this->emit('error', 'Terjadi Kesalahan !');
        }
    }

    public function hapusDisposisi($id)
    {
        if (array_key_exists($id, $this->disposisi)) {
            unset($this->disposisi[$id]);
            $this->emit('warning', 'Tujuan Disposisi di-Hapus !');
        }
    } 
}
