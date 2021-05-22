<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('nama', 'ASC')->get();
        return view('pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::get();
        return view('pengguna.create', compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        try {
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
            
            $user = User::firstOrCreate($request->except(['_token', 'email_confirmation', 'password_confirmation']));

            session()->flash('success', 'Data Pengguna di-Tambahkan !');
            return redirect(route('pengguna.index'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect(route('pengguna.create'))->withInput($request->validated());
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
    public function edit(User $pengguna)
    {
        $jabatan = Jabatan::get();
        return view('pengguna.edit', compact('pengguna', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, User $pengguna)
    {
        try {
            $password = Hash::make($request->password);
            $check = Hash::check($pengguna->password, $password);

            if ($check) {
                $request->merge([
                    'password' => $pengguna->password
                ]);
            } else {
                $request->merge([
                    'password' => $password
                ]);
            }

            $pengguna->update($request->except(['_token', 'email_confirmation', 'password_confirmation']));

            session()->flash('success', 'Data Pengguna di-Ubah !');
            return redirect(route('pengguna.index'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect(route('pengguna.create'))->withInput($request->validated());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        try {
            $pengguna->delete();

            session()->flash('warning', 'Data Pengguna di-Hapus !');
            return redirect(route('pengguna.index'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect(route('pengguna.index'));
        }
    }
}
