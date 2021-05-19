<?php

namespace App\Http\Controllers;

use App\Http\Requests\JabatanStore;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jabatan::orderBy('created_at', 'ASC')->get();
        return view('jabatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JabatanStore $request)
    {
        try {
            $jabatan = Jabatan::firstOrCreate($request->validated());

            session()->flash('success', 'Data Jabatan di-Tambahkan !');
            return redirect(route('jabatan.index'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect(route('jabatan.create'))->withInput($request->validated());
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
        return redirect(route('main'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JabatanStore $request, Jabatan $jabatan)
    {
        try {
            $jabatan->update($request->validated());

            session()->flash('info', 'Data Jabatan di-Ubah !');
            return redirect(route('jabatan.index'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect(route('jabatan.create'))->withInput($request->validated());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        try {
            $jabatan->delete();

            session()->flash('warning', 'Data Jabatan di-Hapus !');
            return redirect(route('jabatan.index'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect(route('jabatan.index'));
        }
    }
}
