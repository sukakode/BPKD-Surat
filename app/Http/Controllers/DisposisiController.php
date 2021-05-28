<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disposisiMasuk = Disposisi::where('diteruskan', Auth::user()->id)->where('status_penginput', 1)->get(); 
        $disposisiKeluar = Disposisi::where('penginput_id', Auth::user()->id)->get(); 
        return view('disposisi.index', compact('disposisiMasuk', 'disposisiKeluar'));
    }

    public function indexAdmin()
    {
        $disposisi = Disposisi::get();
        return view('disposisi.indexAdmin', compact('disposisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Disposisi $disposisi)
    {
        $suratMasuk = $disposisi->surat;
        $hashRead = Hash::make('readPdf');
        $hashDownload = Hash::make('downloadPdf');
        return view('disposisi.create', compact('disposisi', 'suratMasuk', 'hashRead', 'hashDownload'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Disposisi $disposisi)
    {
        $this->validate($request, [
            'disposisi_user_id' => 'required',
            'disposisi_user_id.*' => 'numeric|exists:users,id',
            'disposisi_catatan' => 'nullable',
            'disposisi_catatan.*' => 'nullable|string|max:100',
        ], [
            'required' => ':attribute tidak boleh kosong !',
            'string' => 'Format isian harus berupa String !',
            'max' => ':attribute tidak boleh lebih dari :max karakter !',
            'exists' => ':attribute data tidak sesuai !',
        ], [
            'disposisi_user_id' => 'Tujuan Disposisi',
            'disposisi_user_id.*' => 'Tujuan Disposisi',
            'disposisi_catatan' => 'Catatan Disposisi',
            'disposisi_catatan.*' => 'Catatan Disposisi',
        ]);
        
        try {
            DB::beginTransaction();

            $selanjutnya = "";

            foreach ($request->disposisi_user_id as $key => $value) {
                $disposisiBaru = Disposisi::firstOrCreate([
                    'surat_id' => $disposisi->surat_id,
                    'penginput_id' => Auth::user()->id,
                    'diteruskan' => $value,
                    'catatan' =>  $request->disposisi_catatan[$key],
                    'status_penginput' => 1,
                    'status_penerima' => 0,
                    'disposisi_sebelumnya' => $disposisi->id,
                    'disposisi_selanjutnya' => null,
                ]); 

                $selanjutnya = $selanjutnya . $disposisiBaru->id . ",";
            }

            
            $disposisiSelanjutnya = substr($selanjutnya, 0, -1);

            $disposisi->update([
                'status_penerima' => 2,
                'disposisi_selanjutnya' => $disposisiSelanjutnya,
            ]);

            DB::commit();

            session()->flash('success', 'Disposisi di-Buat !');
            return redirect(route('disposisi.create', $disposisi->id));

        } catch (\Throwable $th) {
            DB::rollback();
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect(route('disposisi.create', $disposisi->id));
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
    public function destroy($id)
    {
        //
    }

    public function terima($id)
    {
        try {
            $disposisi = Disposisi::findOrFail($id);
            $disposisi->update([
                'status_penerima' => 1
            ]);

            session()->flash('success', 'Disposisi di-Terima !');
            return redirect(route('disposisi.index'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect(route('disposisi.index'));
        }
    }

    public function surat(Disposisi $disposisi)
    {
        $suratMasuk = $disposisi->surat;
        $hashRead = Hash::make('readPdf');
        $hashDownload = Hash::make('downloadPdf');
        return view('disposisi.show-surat', compact('disposisi', 'suratMasuk', 'hashRead', 'hashDownload'));
    }
    
    public function selesai(Disposisi $disposisi)
    {
        try {
            if ($disposisi->status_penerima == 2 || $disposisi->status_penerima == 0) {
                session()->flash('error', 'Terjadi Kesalahan !');
                return redirect(route('disposisi.index'));
            } 

            $disposisi->update([
                'status_penerima' => 3
            ]);

            session()->flash('success', 'Disposisi Surat Selesai !');
            return redirect(route('disposisi.index'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect(route('disposisi.index'));
        }
    }
}
