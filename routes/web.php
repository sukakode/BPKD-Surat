<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$loc = 'App\Http\Controllers\\';

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false, 
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () use ($loc) {
    Route::get('/home', [$loc . MainController::class, 'index'])->name('main');
    Route::resource('jabatan', $loc . JabatanController::class);
    Route::resource('jabatan/{jabatan}/jabatan-disposisi', $loc . JabatanDisposisiController::class);
    
    Route::resource('pengguna', $loc . UserController::class);
    
    Route::resource('surat-masuk', $loc . SuratMasukController::class);
    Route::put('/surat-masuk/file/getFile', [$loc . SuratMasukController::class, 'getFiles'])->name('surat-masuk.getFiles');
    Route::get('/surat-masuk/{surat_masuk}/file', [$loc . SuratMasukController::class, 'files'])->name('surat-masuk.files');
    Route::post('/surat-masuk/{surat_masuk}/file', [$loc . SuratMasukController::class, 'addFile'])->name('surat-masuk.addFile');
    Route::delete('/surat-masuk/{surat_masuk}/file/{file}', [$loc . SuratMasukController::class, 'deleteSurat'])->name('surat-masuk.deleteSurat');
    Route::get('/surat-masuk/{surat_masuk}/disposisi', [ $loc . SuratMasukController::class, 'disposisi'])->name('surat-masuk.disposisi');
    Route::post('/surat-masuk/{surat_masuk}/disposisi', [ $loc . SuratMasukController::class, 'disposisiCreate'])->name('surat-masuk.disposisi.create');
    
    // Route::resource('/disposisi', $loc . DisposisiController::class);
    Route::get('/disposisi', [$loc . DisposisiController::class, 'index'])->name('disposisi.index');
    Route::post('/disposisi/{disposisi}/terima', [$loc . DisposisiController::class , 'terima'])->name('disposisi.terima');
    Route::get('/disposisi/{disposisi}/create', [$loc . DisposisiController::class, 'create'])->name('disposisi.create');
    Route::post('/disposisi/{disposisi}/store', [$loc . DisposisiController::class, 'store'])->name('disposisi.store');
    Route::get('/disposisi/{disposisi}/surat', [$loc . DisposisiController::class, 'surat'])->name('disposisi.surat');
    Route::put('/disposisi/{disposisi}/selesai', [$loc . DisposisiController::class, 'selesai'])->name('disposisi.selesai');
    Route::get('/all-disposisi', [$loc . DisposisiController::class, 'indexAdmin'])->name('disposisi.index.admin');
});
