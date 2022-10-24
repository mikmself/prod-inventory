<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SuplayerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/',function(){
  return redirect('/login');
});

Route::get('/login',[AuthController::class,'login']);
Route::post('/storelogin',[AuthController::class,'storelogin'])->name('storelogin');

Route::prefix('operasi')->group(function(){
  Route::post('/getspesifikbarangfisik',[HomeController::class,'getSpesifikBarangFisik']);
  Route::post('/searchbarang',[HomeController::class,'searchBarang']);

  Route::get('/barangkeluar',[HomeController::class,'indexBarangKeluar'])->name('indexbarangkeluarnonauth');
  Route::post('/barangkeluar',[HomeController::class,'barangKeluar'])->name('barangkeluarnonauth');

  Route::get('/barangmodalkeluar',[HomeController::class,'indexBarangModalKeluar'])->name('indexbarangmodalkeluarnonauth');
  Route::post('/barangmodalkeluar',[HomeController::class,'barangModalKeluar'])->name('barangmodalkeluarnonauth');

  Route::get('/barangmodalpinjam',[HomeController::class,'indexBarangModalPinjam'])->name('indexbarangmodalpinjamnonauth');
  Route::post('/barangmodalpinjam',[HomeController::class,'barangModalPinjam'])->name('barangmodalpinjamnonauth');

});

Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::prefix('admin/dashboard')->middleware('cektoken')->group(function () {
  Route::get('/',[HomeController::class,'index'])->name('indexDashboard');
  Route::prefix('master')->group(function(){
      Route::prefix('barang')->group(function(){
          Route::post('/getbarangwithkagetgori',[BarangController::class,'getBarangWithKagetgori']);
          Route::get('/getallbarang',[BarangController::class,'getAllBarang']);

          Route::get('/',[BarangController::class,'index'])->name('indexbarang');
          Route::get('/fisik',[BarangController::class,'indexBarangFisik'])->name('indexbarangfisik');

          Route::get('/create',[BarangController::class,'create'])->name('createbarang');
          Route::post('/store',[BarangController::class,'store'])->name('storebarang');

          Route::get('/indexbarangmasuk',[BarangController::class,'indexBarangMasuk'])->name('indexbarangmasuk');
          Route::get('/addbarangmasuk',[BarangController::class,'addBarangMasuk'])->name('addbarangmasuk');
          Route::post('/barangmasuk',[BarangController::class,'barangMasuk'])->name('barangmasuk');

          Route::get('/indexbarangkeluar',[BarangController::class,'indexBarangKeluar'])->name('indexbarangkeluar');
          Route::get('/addbarangkeluar',[BarangController::class,'addBarangKeluar'])->name('addbarangkeluar');
          Route::post('/barangkeluar',[BarangController::class,'barangKeluar'])->name('barangkeluar');
          Route::post('/filterbarangkeluar',[BarangController::class,'filterBarangKeluar'])->name('filterbarangkeluar');
          Route::get('/confirmbarangkeluar/{id}',[BarangController::class,'confirmBarangKeluar'])->name('confirmbarangkeluar');
          Route::get('/getinputbarangkeluar',[BarangController::class,'getInputBarangKeluar'])->name('getInputBarangKeluar');

          Route::get('/indexbarangmodalkeluar',[BarangController::class,'indexBarangModalKeluar'])->name('indexbarangmodalkeluar');
          Route::get('/addbarangmodalkeluar',[BarangController::class,'addBarangModalKeluar'])->name('addbarangmodalkeluar');
          Route::post('/barangmodalkeluar',[BarangController::class,'barangModalKeluar'])->name('barangmodalkeluar');
          Route::get('/confirmbarangmodalkeluar/{id}',[BarangController::class,'confirmBarangModalKeluar'])->name('confirmbarangmodalkeluar');

          Route::get('/indexbarangmodalpinjam',[BarangController::class,'indexBarangModalPinjam'])->name('indexbarangmodalpinjam');
          Route::get('/addbarangmodalpinjam',[BarangController::class,'addBarangModalPinjam'])->name('addbarangmodalpinjam');
          Route::post('/barangmodalpinjam',[BarangController::class,'barangModalPinjam'])->name('barangmodalpinjam');
          Route::get('/confirmbarangmodalpinjam/{id}',[BarangController::class,'confirmBarangModalPinjam'])->name('confirmbarangmodalpinjam');

          Route::get('/indexbarangmodalkembali',[BarangController::class,'indexBarangModalKembali'])->name('indexbarangmodalkembali');
          Route::get('/addbarangmodalkembali',[BarangController::class,'addBarangModalKembali'])->name('addbarangmodalkembali');
          Route::get('/barangmodalkembali/id={id}',[BarangController::class,'barangModalKembali'])->name('barangmodalkembali');

          Route::get('/edit/{id}',[BarangController::class,'edit'])->name('editbarang');
          Route::post('/update/{id}',[BarangController::class,'update'])->name('updatebarang');
          Route::get('/delete/{id}',[BarangController::class,'destroy'])->name('deletebarang');
          Route::get('/exportexcel',[BarangController::class,'exportexcel'])->name('exportexcel');
          Route::post('/importexcel',[BarangController::class,'importexcel'])->name('importexcel');
          Route::get('/downloadexcel',[BarangController::class,'downloadexcel'])->name('downloadexcel');

          Route::post('/getspesifikbarangfisik',[BarangController::class,'getSpesifikBarangFisik'])->name('getspesifikbarangfisik');
          Route::post('/getbarangsesuaikategori',[BarangController::class,'getBarangSesuaiKategori'])->name('getbarangsesuaikategori');
      });
      Route::prefix('karyawan')->group(function(){
          Route::get('/',[KaryawanController::class,'index'])->name('indexkaryawan');
          Route::get('/create',[KaryawanController::class,'create'])->name('createkaryawan');
          Route::post('/store',[KaryawanController::class,'store'])->name('storekaryawan');
          Route::get('/edit/{id}',[KaryawanController::class,'edit'])->name('editkaryawan');
          Route::post('/update/{id}',[KaryawanController::class,'update'])->name('updatekaryawan');
          Route::get('/delete/{id}',[KaryawanController::class,'destroy'])->name('deletekaryawan');
      });
      Route::prefix('kategori')->group(function(){
          Route::get('/',[KategoriController::class,'index'])->name('indexkategori');
          Route::get('/create',[KategoriController::class,'create'])->name('createkategori');
          Route::post('/store',[KategoriController::class,'store'])->name('storekategori');
          Route::get('/edit/{id}',[KategoriController::class,'edit'])->name('editkategori');
          Route::post('/update/{id}',[KategoriController::class,'update'])->name('updatekategori');
          Route::get('/delete/{id}',[KategoriController::class,'destroy'])->name('deletekategori');
      });
      Route::prefix('pengaturan')->group(function(){
          Route::get('/',[PengaturanController::class,'index'])->name('indexpengaturan');
          Route::get('/create',[PengaturanController::class,'create'])->name('createpengaturan');
          Route::post('/store',[PengaturanController::class,'store'])->name('storepengaturan');
          Route::get('/edit/{id}',[PengaturanController::class,'edit'])->name('editpengaturan');
          Route::post('/update/{id}',[PengaturanController::class,'update'])->name('updatepengaturan');
          Route::get('/delete/{id}',[PengaturanController::class,'destroy'])->name('deletepengaturan');
      });
      Route::prefix('ruang')->group(function(){
          Route::get('/',[RuangController::class,'index'])->name('indexruang');
          Route::get('/create',[RuangController::class,'create'])->name('createruang');
          Route::post('/store',[RuangController::class,'store'])->name('storeruang');
          Route::get('/edit/{id}',[RuangController::class,'edit'])->name('editruang');
          Route::post('/update/{id}',[RuangController::class,'update'])->name('updateruang');
          Route::get('/delete/{id}',[RuangController::class,'destroy'])->name('deleteruang');
      });
      Route::prefix('suplayer')->group(function(){
          Route::get('/',[SuplayerController::class,'index'])->name('indexsuplayer');
          Route::get('/create',[SuplayerController::class,'create'])->name('createsuplayer');
          Route::post('/store',[SuplayerController::class,'store'])->name('storesuplayer');
          Route::get('/edit/{id}',[SuplayerController::class,'edit'])->name('editsuplayer');
          Route::post('/update/{id}',[SuplayerController::class,'update'])->name('updatesuplayer');
          Route::get('/delete/{id}',[SuplayerController::class,'destroy'])->name('deletesuplayer');
      });
      Route::prefix('user')->group(function(){
          Route::get('/',[UserController::class,'index'])->name('indexuser');
          Route::get('/create',[UserController::class,'create'])->name('createuser');
          Route::post('/store',[UserController::class,'store'])->name('storeuser');
          Route::get('/edit/{id}',[UserController::class,'edit'])->name('edituser');
          Route::post('/update/{id}',[UserController::class,'update'])->name('updateuser');
          Route::get('/delete/{id}',[UserController::class,'destroy'])->name('deleteuser');
      });
  });
  Route::prefix('pengaturan')->group(function(){
      Route::get('/',[HomeController::class,'indexPengaturan'])->name('pengaturan');
  });
});
