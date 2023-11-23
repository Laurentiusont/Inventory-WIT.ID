<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\HistoryPemakaianController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/historyPemakaian', [HistoryPemakaianController::class, 'index'])->name('historyPemakaian');
	Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('inventory', function () {
		return view('inventory');
	})->name('inventory');

	Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
	Route::get('/inventory/detail/{inventory}', [InventoryController::class, 'detail'])->name('detailInventory');
	Route::get('/inventory/edit/{inventory}', [InventoryController::class, 'edit'])->name('editInventory');
	Route::post('/inventory/edit/{inventory}', [InventoryController::class, 'update'])->name('updateInventory');
	Route::post('/inventory/editDetail/{inventory}', [InventoryController::class, 'updateDetail'])->name('updateDetailInventory');
	Route::get('/inventory/create', [InventoryController::class, 'create'])->name('createInventory');
	Route::post('/inventory/create', [InventoryController::class, 'store'])->name('storeInventory');
	Route::get('/inventory/delete/{inventory}', [InventoryController::class, 'destroy'])->name('deleteInventory');



	Route::get('karyawan', function () {
		return view('karyawan');
	})->name('karyawan');

	Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
	Route::get('/karyawan/detail/{karyawan}', [KaryawanController::class, 'detail'])->name('detailKaryawan');
	Route::get('/karyawan/edit/{karyawan}', [KaryawanController::class, 'edit'])->name('editKaryawan');
	Route::post('/karyawan/edit/{karyawan}', [KaryawanController::class, 'update'])->name('updateKaryawan');
	Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('createKaryawan');
	Route::post('/karyawan/create', [KaryawanController::class, 'store'])->name('storeKaryawan');
	Route::delete('/karyawan/delete/{karyawan}', [KaryawanController::class, 'destroy'])->name('deleteKaryawan');




	Route::get('kategori', function () {
		return view('kategori');
	})->name('kategori');

	Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
	Route::get('/kategori/edit/{kategori}', [KategoriController::class, 'edit'])->name('editKategori');
	Route::post('/kategori/edit/{kategori}', [KategoriController::class, 'update'])->name('updateKategori');
	Route::get('/kategori/create', [KategoriController::class, 'create'])->name('createKategori');
	Route::post('/kategori/create', [KategoriController::class, 'store'])->name('storeKategori');
	Route::delete('/kategori/delete/{kategori}', [KategoriController::class, 'destroy'])->name('deleteKategori');


	Route::get('ruangan', function () {
		return view('ruangan');
	})->name('ruangan');

	Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
	Route::get('/ruangan/edit/{ruangan}', [RuanganController::class, 'edit'])->name('editRuangan');
	Route::post('/ruangan/edit/{ruangan}', [RuanganController::class, 'update'])->name('updateRuangan');
	Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('createRuangan');
	Route::post('/ruangan/create', [RuanganController::class, 'store'])->name('storeRuangan');
	Route::delete('/ruangan/delete/{ruangan}', [RuanganController::class, 'destroy'])->name('deleteRuangan');


	Route::get('kantor', function () {
		return view('kantor');
	})->name('kantor');

	Route::get('/kantor', [KantorController::class, 'index'])->name('kantor');
	Route::get('/kantor/edit/{kantor}', [KantorController::class, 'edit'])->name('editKantor');
	Route::post('/kantor/edit/{kantor}', [KantorController::class, 'update'])->name('updateKantor');
	Route::get('/kantor/create', [KantorController::class, 'create'])->name('createKantor');
	Route::post('/kantor/create', [KantorController::class, 'store'])->name('storeKantor');
	Route::delete('/kantor/delete/{kantor}', [KantorController::class, 'destroy'])->name('deleteKantor');


	Route::get('perbaikan', function () {
		return view('perbaikan');
	})->name('perbaikan');


	Route::get('/perbaikan', [PerbaikanController::class, 'index'])->name('perbaikan');
	Route::get('/perbaikan/editDetail/{kode_aset}', [PerbaikanController::class, 'editDetail'])->name('editDetailPerbaikan');
	Route::get('/perbaikan/edit/{perbaikan?}/{kode_aset?}', [PerbaikanController::class, 'edit'])->name('editPerbaikan');
	Route::post('/perbaikan/fetchPerbaikan', [PerbaikanController::class, 'fetchPerbaikan'])->name('fetchPerbaikan');
	Route::post('/perbaikan/fetchPemakai', [PerbaikanController::class, 'fetchPemakai'])->name('fetchPemakai');
	Route::post('/perbaikan/edit/{perbaikan?}/{kode_aset?}', [PerbaikanController::class, 'update'])->name('updatePerbaikan');
	Route::get('/perbaikan/create/{kode_aset?}', [PerbaikanController::class, 'create'])->name('createPerbaikan');
	Route::post('/perbaikan/create/{kode_aset?}', [PerbaikanController::class, 'store'])->name('storePerbaikan');
	Route::delete('/perbaikan/delete/{perbaikan}', [PerbaikanController::class, 'destroy'])->name('deletePerbaikan');
	Route::get('/perbaikan/delete-perbaikan/{perbaikan}', [PerbaikanController::class, 'destroySpes'])->name('deletePerbaikanPart');





	Route::get('pemakaian', function () {
		return view('pemakaian');
	})->name('pemakaian');

	Route::get('/historyPemakaian', [HistoryPemakaianController::class, 'index'])->name('historyPemakaian');
	// Route::get('/pemakaian/edit/{pemakaian}', [PemakaianController::class, 'edit'])->name('editPemakaian');
	// Route::post('/pemakaianuku/edit/{pemakaian}', [PemakaianController::class, 'update'])->name('updatePemakaian');
	// Route::get('/pemakaian/create', [PemakaianController::class, 'create'])->name('createPemakaian');
	// Route::post('/pemakaian/create', [PemakaianController::class, 'store'])->name('storePemakaian');
	// Route::get('/pemakaian/delete/{pemakaian}', [PemakaianController::class, 'destroy'])->name('deletePemakaian');

	Route::get('/pemakaian/edit/{pemakaian}', [PemakaianController::class, 'edit'])->name('editPemakaian');
	Route::post('/pemakaian/edit/{pemakaian}/{kodeAset?}', [PemakaianController::class, 'update'])->name('updatePemakaian');
	// Route::get('/pemakaian/create', [PemakaianController::class, 'create'])->name('createPemakaian');
	// Route::post('/pemakaian/create', [PemakaianController::class, 'store'])->name('storePemakaian');
	// Route::get('/pemakaian/delete/{pemakaian}', [PemakaianController::class, 'destroy'])->name('deletePemakaian');



	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
