<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratMasukFileAdd;
use App\Http\Requests\SuratMasukStore;
use App\Http\Requests\SuratMasukUpdate;
use App\Models\Surat;
use App\Models\SuratFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Surat::get();
        return view('surat_masuk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat_masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratMasukStore $request)
    {
        // dd($request->validated());
        try {
            DB::beginTransaction();

            $request->merge([
                'user_id' => auth()->user()->id
            ]);

            $surat = Surat::firstOrCreate($request->except(['_token', 'surat_file']));

            if ($request->file('surat_file')) {
                $dataFile = $request->file('surat_file');
                foreach ($dataFile as $key => $value) {
                    $namaFile = Carbon::now()->format('Ymd')."_".$key."_".$surat->id."_surat_masuk".".".$value->getClientOriginalExtension();
                    $path = "uploads\pdf_file\\" . $namaFile;
                    $moveFile = $value->storeAs('pdf_file', $namaFile, 'uploads');

                    $suratFile = SuratFile::firstOrCreate([
                        'surat_id' => $surat->id,
                        'nama_file' => $namaFile,
                        'lokasi_file' => $path,
                    ]);
                }
            } else {
                DB::rollback();
                return redirect(route('surat-masuk.create'))->withInput($request->all());
            }

            DB::commit();

            session()->flash('success', 'Data Surat di-Tambahkan !');
            return redirect(route('surat-masuk.index'));
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $suratMasuk)
    {
        $hashRead = Hash::make('readPdf');
        $hashDownload = Hash::make('downloadPdf');
        return view('surat_masuk.show', compact('suratMasuk', 'hashRead', 'hashDownload'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $suratMasuk)
    {
        $hashRead = Hash::make('readPdf');
        $hashDownload = Hash::make('downloadPdf');
        return view('surat_masuk.edit', compact('suratMasuk', 'hashRead', 'hashDownload'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratMasukUpdate $request, Surat $suratMasuk)
    {
        try {
            $suratMasuk->update($request->validated());

            session()->flash('info', 'Data Surat di-Ubah !');
            return redirect(route('surat-masuk.index'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect(route('surat-masuk.edit', $suratMasuk->id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surat $suratMasuk)
    {
        try {
            $suratMasuk->delete();
            if ($suratMasuk->files()->count() > 0) {
                $suratMasuk->files()->delete();
            }

            session()->flash('warning', 'Data Surat di-Hapus !');
            return redirect(route('surat-masuk.index'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi Kesalahan !');
            return redirect(route('surat-masuk.index'));
        }
    }

    public function getFiles(Request $request)
    {
        $hashRead = 'readPdf';
        $hashDownload = 'downloadPdf';

        $checkRead = Hash::check($hashRead, $request->action);
        $checkDownload = Hash::check($hashDownload, $request->action);
        $id = (int) substr($request->dataPdf, 2);
        // dd(strlen($id));
        if ($id > 0) {
            $id = (int) substr($id,0, -3);
        } else {
            abort(404);
        }
        
        $id = (int) ($id / 12) - 30 - 1999;
        if ($id > 0) {
            if ($checkRead) {
                try {
                    $file = SuratFile::findOrFail($id);
                } catch (\Throwable $th) {
                    abort(404);
                }
                return response()->file(storage_path($file->lokasi_file));
            } else if ($checkDownload) {
                try {
                    $file = SuratFile::findOrFail($id);
                } catch (\Throwable $th) {
                    abort(404);
                }
                
                $headers = array(
                    'Content-Type: application/pdf',
                );
                return response()->download(storage_path($file->lokasi_file, $file->surat->namafile, $headers));
            } else {
                return view('close');
            }
        } else {
            abort(404);
        }
    }

    public function files(Surat $suratMasuk)
    {
        $hashRead = Hash::make('readPdf');
        $hashDownload = Hash::make('downloadPdf');
        return view('surat_masuk.file', compact('suratMasuk', 'hashRead', 'hashDownload'));
    }

    public function addFile(SuratMasukFileAdd $request, Surat $suratMasuk)
    {
        try {
            if ($request->file('surat_file')) {
                $dataFile = $request->file('surat_file');
                foreach ($dataFile as $key => $value) {
                    $namaFile = Carbon::now()->format('Ymd')."_".time()."_".$suratMasuk->id.rand(10,99).".".$value->getClientOriginalExtension();
                    $path = "uploads\pdf_file\\" . $namaFile;
                    $moveFile = $value->storeAs('pdf_file', $namaFile, 'uploads');
    
                    $suratFile = SuratFile::firstOrCreate([
                        'surat_id' => $suratMasuk->id,
                        'nama_file' => $namaFile,
                        'lokasi_file' => $path,
                    ]);
                }
            } else {
                return redirect(route('surat-masuk.files', $suratMasuk->id))->withInput($request->all());
            }

            session()->flash('info', 'Data Surat di-Tambhakan !');
            return redirect(route('surat-masuk.files', $suratMasuk->id));
        } catch (\Throwable $th) {
            return redirect(route('surat-masuk.files', $suratMasuk->id))->withInput($request->all());
        }
    }

    public function deleteSurat(Surat $suratMasuk, SuratFile $file)
    {
        $count = $suratMasuk->files()->count();
        if ($count > 1) {
            try {
                $file->delete();
    
                // Storage::delete();
                session()->flash('warning', 'File Surat di-Hapus !');
                return redirect(route('surat-masuk.files', $file->surat->id));
            } catch (\Throwable $th) {
                session()->flash('error', 'Terjadi Kesalahan !');
                return redirect(route('surat-masuk.files', $file->surat->id));
            }
        } else {
            session()->flash('error', 'Surat Harus Memiliki File !');
            return redirect(route('surat-masuk.files', $file->surat->id));
        }
    }
}
