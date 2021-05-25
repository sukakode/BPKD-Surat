<?php

use App\Models\JabatanDisposisi;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [$loc . MainController::class, 'index'])->name('main');

Route::resource('jabatan', $loc . JabatanController::class);
Route::resource('jabatan/{jabatan}/jabatan-disposisi', $loc . JabatanDisposisiController::class);

Route::resource('pengguna', $loc . Usercontroller::class);

Route::resource('surat-masuk', $loc . SuratMasukController::class);
Route::put('/surat-masuk/file/getFile', [$loc . SuratMasukController::class, 'getFiles'])->name('surat-masuk.getFiles');
Route::get('/surat-masuk/{surat_masuk}/file', [$loc . SuratMasukController::class, 'files'])->name('surat-masuk.files');
Route::post('/surat-masuk/{surat_masuk}/file', [$loc . SuratMasukController::class, 'addFile'])->name('surat-masuk.addFile');
Route::delete('/surat-masuk/{surat_masuk}/file/{file}', [$loc . SuratMasukController::class, 'deleteSurat'])->name('surat-masuk.deleteSurat');