<?php

use App\Http\Controllers\AssignmentUserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadExcelController;
use App\Http\Controllers\KomputerController;
use App\Http\Controllers\LabKomController;
use App\Http\Controllers\LaporanPemakaianController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\PemakaianController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/','index')->name('home');
});
Route::controller(AuthenticationController::class)->group(function(){
    Route::get('/login','LoginView')->middleware('guest')->name('login');
    Route::post('/login/authenticate', 'authenticate')->middleware('guest')->name('authenticate');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
    Route::get('/register','RegisterView')->middleware('guest')->name('register');
    Route::post('/register','register')->middleware('guest')->name('registeraction');
});
// !admin route start
Route::controller(LabKomController::class)->middleware(['auth','role:admin'])->group(function(){
    Route::get('/management-labor-komputer','index')->name('admin.labkom.index');
    Route::post('/management-labor-komputer/store','store')->name('admin.labkom.store');
    Route::patch('/management-labor-komputer/patch','update')->name('admin.labkom.update');
    Route::delete('/management-labor-komputer/{laborkom}/delete','destroy')->name('admin.labkom.destroy');
});
Route::controller(ManagementUserController::class)->middleware(['auth','role:admin'])->group(function(){
    Route::get('/management-user','index')->name('admin.manajemenUser.index');
    Route::post('/manajement-user/store','store')->name('admin.manajemenUser.store');
    Route::patch('/manajement-user/patch','update')->name('admin.manajemenUser.update');
    Route::delete('/manajement-user/{user}/delete','destroy')->name('admin.manajemenUser.destroy');
});
Route::controller(AssignmentUserController::class)->middleware(['auth','role:admin'])->group(function(){
    Route::get('/assignment-user','index')->name('admin.assignmentUser.index');
    Route::post('/assignment-user/store','store')->name('admin.assignmentUser.store');
    Route::delete('/assigment-user/{id}/delete','destroy')->name('admin.assignmentUser.destroy');
});
// !admin route end
// !teknisi route start
Route::controller(KomputerController::class)->middleware(['auth', 'role:Teknisi LabKom'])->group(function(){
    Route::get('/management-komputer','index')->name('teknisi.komputer.index');
    Route::post('/mangement-komputer/store','store')->name('teknisi.komputer.store');
    Route::patch('/mangement-komputer/patch', 'update')->name('teknisi.komputer.update');
    Route::delete('/mangement-komputer/{komputer}/delete','destroy')->name('teknisi.komputer.destroy');
});
Route::controller(LaporanPemakaianController::class)->middleware(['auth', 'role:Teknisi LabKom'])->group(function(){
    Route::get('/laporan-pemakaian-komputer','index')->name('teknisi.laporan.index');
});
Route::controller(DownloadExcelController::class)->middleware(['auth', 'role:Teknisi LabKom'])->group(function(){
    Route::post('/laporan-pemakaian-komputer/download-excel', 'teknisiExcel')->name('teknisi.laporan.download');
});
// !telnisi route end
// !peminjam route start
Route::controller(PemakaianController::class)->middleware(['auth','role:Peminjam'])->group(function(){
    Route::get('/pemakaian-komputer','index')->name('peminjam.pemakaian.index');
    Route::post('/pemakaian-komputer/pilih-komputer','pilihLabor')->name('peminjam.pilihLabor');
    Route::post('/pemakaian-komputer/mulai-pencatatan','mulaiPencatatan')->name('peminjam.mulai');
    Route::get('/pemakaian-komputer/berhentikan-pencatatan','stopPencatatanView')->name('peminjam.viewStop');
    Route::post('/pemakaian-komputer/berhentikan-pencatatan','stopPencatatan')->name('peminjam.stop');
});
// !peminjam route end
