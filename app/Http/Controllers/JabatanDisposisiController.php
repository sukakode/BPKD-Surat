<?php

namespace App\Http\Controllers;

use App\Http\Requests\JabatanDisposisiStore;
use App\Models\Jabatan;
use App\Models\JabatanDisposisi;
use Illuminate\Http\Request;

class JabatanDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Jabatan $jabatan)
    {
        $data = Jabatan::get();
        return view('jabatan_disposisi.create', compact('data', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Jabatan $jabatan)
    {
        $data = Jabatan::get();
        return view('jabatan_disposisi.create', compact('data', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JabatanDisposisiStore $request, Jabatan $jabatan)
    {
        try {
            $jabatan_disposisi = JabatanDisposisi::firstOrCreate([
                'jabatan_id' => $jabatan->id,
                'jabatan_dituju' => $request->jabatan_dituju
            ]);

            session()->flash('success', 'Data Jabatan di-Tambah !');
            return redirect(route('jabatan-disposisi.index', $jabatan->id));
        } catch (\Exception $e) {
            return redirect(route('jabatan-disposisi.create', $jabatan->id));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan, JabatanDisposisi $jabatanDisposisi)
    {
        try {
            $jabatanDisposisi->delete();

            session()->flash('warning', 'Jabatan Disposisi di-Hapus !');
            return redirect(route('jabatan-disposisi.index')); 
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect(route('jabatan-disposisi.index', $jabatan->id));
        }
    }
}
