<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SuplayerController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/',function(){
    return redirect('/login');
});

Route::get('/login',[AuthController::class,'login']);
Route::post('/storelogin',[AuthController::class,'storelogin'])->name('storelogin');
Route::middleware(['cektoken'])->group(function () {
    Route::prefix('operasi')->group(function(){
        Route::post('/getspesifikbarangfisik',[HomeController::class,'getSpesifikBarangFisik']);
        Route::post('/searchbarang',[HomeController::class,'searchBarang']);
    
        Route::get('/barangkeluar',[HomeController::class,'indexBarangKeluar'])->name('indexbarangkeluarnonauth');
        Route::post('/barangkeluar',[HomeController::class,'barangKeluar'])->name('barangkeluarnonauth');
    
        Route::get('/barangmodalkeluar',[HomeController::class,'indexBarangModalKeluar'])->name('indexbarangmodalkeluarnonauth');
        Route::post('/barangmodalkeluar',[HomeController::class,'barangModalKeluar'])->name('barangmodalkeluarnonauth');
    
        Route::get('/bonpinjam',[HomeController::class,'indexBarangModalPinjam'])->name('indexbarangmodalpinjamnonauth');
        Route::post('/barangmodalpinjam',[HomeController::class,'barangModalPinjam'])->name('barangmodalpinjamnonauth');
    });    
});


Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::prefix('admin/dashboard')->middleware('cektoken')->group(function () {
    Route::get('/',[HomeController::class,'index'])->name('indexDashboard');
    Route::prefix('master')->group(function(){
        Route::prefix('barang')->group(function(){
            Route::post('/getbarangwithkagetgori',[BarangController::class,'getBarangWithKagetgori']);
            Route::get('/getallbarang',[BarangController::class,'getAllBarang']);
            Route::get('/',[BarangController::class,'index'])->name('indexbarang');
            Route::get('/create',[BarangController::class,'create'])->name('createbarang');
            Route::post('/store',[BarangController::class,'store'])->name('storebarang');
            Route::post('/search',[BarangController::class,'search'])->name('searchbarang');

            Route::get('/fisik',[BarangController::class,'indexBarangFisik'])->name('indexbarangfisik');
            Route::post('/previouspagebarangfisik',[BarangController::class,'previouspagebarangfisik'])->name('previouspagebarangfisik');
            Route::post('/nextpagebarangfisik',[BarangController::class,'nextpagebarangfisik'])->name('nextpagebarangfisik');

            Route::get('/indexbarangmasuk',[BarangController::class,'indexBarangMasuk'])->name('indexbarangmasuk');
            Route::get('/addbarangmasuk',[BarangController::class,'addBarangMasuk'])->name('addbarangmasuk');
            Route::post('/barangmasuk',[BarangController::class,'barangMasuk'])->name('barangmasuk');
            Route::post('/previouspagebarangmasuk',[BarangController::class,'previouspagebarangmasuk'])->name('previouspagebarangmasuk');
            Route::post('/nextpagebarangmasuk',[BarangController::class,'nextpagebarangmasuk'])->name('nextpagebarangmasuk');

            Route::get('/indexbarangkeluar',[BarangController::class,'indexBarangKeluar'])->name('indexbarangkeluar');
            Route::get('/addbarangkeluar',[BarangController::class,'addBarangKeluar'])->name('addbarangkeluar');
            Route::post('/barangkeluar',[BarangController::class,'barangKeluar'])->name('barangkeluar');
            Route::post('/filterbarangkeluar',[BarangController::class,'filterBarangKeluar'])->name('filterbarangkeluar');
            Route::get('/confirmbarangkeluar/{id}',[BarangController::class,'confirmBarangKeluar'])->name('confirmbarangkeluar');
            Route::get('/getinputbarangkeluar',[BarangController::class,'getInputBarangKeluar'])->name('getInputBarangKeluar');
            Route::post('/previouspagebarangkeluar',[BarangController::class,'previouspagebarangkeluar'])->name('previouspagebarangkeluar');
            Route::post('/nextpagebarangkeluar',[BarangController::class,'nextpagebarangkeluar'])->name('nextpagebarangkeluar');

            Route::get('/indexbarangmodalkeluar',[BarangController::class,'indexBarangModalKeluar'])->name('indexbarangmodalkeluar');
            Route::get('/addbarangmodalkeluar',[BarangController::class,'addBarangModalKeluar'])->name('addbarangmodalkeluar');
            Route::post('/barangmodalkeluar',[BarangController::class,'barangModalKeluar'])->name('barangmodalkeluar');
            Route::get('/confirmbarangmodalkeluar/{id}',[BarangController::class,'confirmBarangModalKeluar'])->name('confirmbarangmodalkeluar');
            Route::post('/previouspagebarangmodalkeluar',[BarangController::class,'previouspagebarangmodalkeluar'])->name('previouspagebarangmodalkeluar');
            Route::post('/nextpagebarangmodalkeluar',[BarangController::class,'nextpagebarangmodalkeluar'])->name('nextpagebarangmodalkeluar');

            Route::get('/indexbarangmodalpinjam',[BarangController::class,'indexBarangModalPinjam'])->name('indexbarangmodalpinjam');
            Route::get('/addbarangmodalpinjam',[BarangController::class,'addBarangModalPinjam'])->name('addbarangmodalpinjam');
            Route::post('/barangmodalpinjam',[BarangController::class,'barangModalPinjam'])->name('barangmodalpinjam');
            Route::get('/confirmbarangmodalpinjam/{id}',[BarangController::class,'confirmBarangModalPinjam'])->name('confirmbarangmodalpinjam');
            Route::post('/previouspagebarangmodalpinjam',[BarangController::class,'previouspagebarangmodalpinjam'])->name('previouspagebarangmodalpinjam');
            Route::post('/nextpagebarangmodalpinjam',[BarangController::class,'nextpagebarangmodalpinjam'])->name('nextpagebarangmodalpinjam');

            Route::get('/indexbarangmodalkembali',[BarangController::class,'indexBarangModalKembali'])->name('indexbarangmodalkembali');
            Route::get('/addbarangmodalkembali',[BarangController::class,'addBarangModalKembali'])->name('addbarangmodalkembali');
            Route::get('/barangmodalkembali/id={id}',[BarangController::class,'barangModalKembali'])->name('barangmodalkembali');
            Route::post('/previouspagebarangmodalkembali',[BarangController::class,'previouspagebarangmodalkembali'])->name('previouspagebarangmodalkembali');
            Route::post('/nextpagebarangmodalkembali',[BarangController::class,'nextpagebarangmodalkembali'])->name('nextpagebarangmodalkembali');

            Route::get('/edit/{id}',[BarangController::class,'edit'])->name('editbarang');
            Route::post('/update/{id}',[BarangController::class,'update'])->name('updatebarang');
            Route::get('/delete/{id}',[BarangController::class,'destroy'])->name('deletebarang');
            Route::get('/exportexcel',[BarangController::class,'exportexcel'])->name('exportexcel');
            Route::post('/importexcel',[BarangController::class,'importexcel'])->name('importexcel');
            Route::get('/downloadexcel',[BarangController::class,'downloadexcel'])->name('downloadexcel');

            Route::post('/getspesifikbarangfisik',[BarangController::class,'getSpesifikBarangFisik'])->name('getspesifikbarangfisik');
            Route::post('/getbarangsesuaikategori',[BarangController::class,'getBarangSesuaiKategori'])->name('getbarangsesuaikategori');

            Route::post('/previouspage',[BarangController::class,'previouspage'])->name('previouspagebarang');
            Route::post('/nextpage',[BarangController::class,'nextpage'])->name('nextpagebarang');
        });
        Route::prefix('kategori')->group(function(){
            Route::get('/',[KategoriController::class,'index'])->name('indexkategori');
            Route::get('/create',[KategoriController::class,'create'])->name('createkategori');
            Route::post('/store',[KategoriController::class,'store'])->name('storekategori');
            Route::get('/edit/{id}',[KategoriController::class,'edit'])->name('editkategori');
            Route::post('/update/{id}',[KategoriController::class,'update'])->name('updatekategori');
            Route::get('/delete/{id}',[KategoriController::class,'destroy'])->name('deletekategori');
            Route::post('/search',[KategoriController::class,'search'])->name('searchkategori');

            Route::post('/previouspage',[KategoriController::class,'previouspage'])->name('previouspagekategori');
            Route::post('/nextpage',[KategoriController::class,'nextpage'])->name('nextpagekategori');
        });
        Route::prefix('unitkerja')->group(function(){
            Route::get('/',[UnitKerjaController::class,'index'])->name('indexunitkerja');
            Route::get('/create',[UnitKerjaController::class,'create'])->name('createunitkerja');
            Route::post('/store',[UnitKerjaController::class,'store'])->name('storeunitkerja');
            Route::get('/edit/{id}',[UnitKerjaController::class,'edit'])->name('editunitkerja');
            Route::post('/update/{id}',[UnitKerjaController::class,'update'])->name('updateunitkerja');
            Route::get('/delete/{id}',[UnitKerjaController::class,'destroy'])->name('deleteunitkerja');
            Route::post('/search',[UnitKerjaController::class,'search'])->name('searchunitkerja');

            Route::post('/previouspage',[UnitKerjaController::class,'previouspage'])->name('previouspageunitkerja');
            Route::post('/nextpage',[UnitKerjaController::class,'nextpage'])->name('nextpageunitkerja');
        });
        Route::prefix('pengaturan')->group(function(){
            Route::get('/',[PengaturanController::class,'index'])->name('indexpengaturan');
            Route::get('/create',[PengaturanController::class,'create'])->name('createpengaturan');
            Route::post('/store',[PengaturanController::class,'store'])->name('storepengaturan');
            Route::get('/edit/{id}',[PengaturanController::class,'edit'])->name('editpengaturan');
            Route::post('/update/{id}',[PengaturanController::class,'update'])->name('updatepengaturan');
            Route::get('/delete/{id}',[PengaturanController::class,'destroy'])->name('deletepengaturan');
            Route::post('/search',[PengaturanController::class,'search'])->name('searchpengaturan');

            Route::post('/previouspage',[PengaturanController::class,'previouspage'])->name('previouspagepengaturan');
            Route::post('/nextpage',[PengaturanController::class,'nextpage'])->name('nextpagepengaturan');
        });
        Route::prefix('ruang')->group(function(){
            Route::get('/',[RuangController::class,'index'])->name('indexruang');
            Route::get('/create',[RuangController::class,'create'])->name('createruang');
            Route::post('/store',[RuangController::class,'store'])->name('storeruang');
            Route::get('/edit/{id}',[RuangController::class,'edit'])->name('editruang');
            Route::post('/update/{id}',[RuangController::class,'update'])->name('updateruang');
            Route::get('/delete/{id}',[RuangController::class,'destroy'])->name('deleteruang');
            Route::post('/search',[RuangController::class,'search'])->name('searchruang');

            Route::post('/previouspage',[RuangController::class,'previouspage'])->name('previouspageruang');
            Route::post('/nextpage',[RuangController::class,'nextpage'])->name('nextpageruang');
        });
        Route::prefix('suplayer')->group(function(){
            Route::get('/',[SuplayerController::class,'index'])->name('indexsuplayer');
            Route::get('/create',[SuplayerController::class,'create'])->name('createsuplayer');
            Route::post('/store',[SuplayerController::class,'store'])->name('storesuplayer');
            Route::get('/edit/{id}',[SuplayerController::class,'edit'])->name('editsuplayer');
            Route::post('/update/{id}',[SuplayerController::class,'update'])->name('updatesuplayer');
            Route::get('/delete/{id}',[SuplayerController::class,'destroy'])->name('deletesuplayer');
            Route::post('/search',[SuplayerController::class,'search'])->name('searchsuplayer');

            Route::post('/previouspage',[SuplayerController::class,'previouspage'])->name('previouspagesuplayer');
            Route::post('/nextpage',[SuplayerController::class,'nextpage'])->name('nextpagesuplayer');
        });
        Route::prefix('user')->group(function(){
            Route::get('/',[UserController::class,'index'])->name('indexuser');
            Route::get('/create',[UserController::class,'create'])->name('createuser');
            Route::post('/store',[UserController::class,'store'])->name('storeuser');
            Route::get('/edit/{id}',[UserController::class,'edit'])->name('edituser');
            Route::post('/update/{id}',[UserController::class,'update'])->name('updateuser');
            Route::get('/delete/{id}',[UserController::class,'destroy'])->name('deleteuser');
            Route::post('/search',[UserController::class,'search'])->name('searchuser');

            Route::post('/importexcel',[UserController::class,'importexcel'])->name('userimportexcel');
            Route::get('/downloadexcel',[UserController::class,'downloadexcel'])->name('userdownloadexcel');
            Route::get('/exportexcel',[UserController::class,'exportexcel'])->name('userexportexcel');
            
            Route::post('/previouspage',[UserController::class,'previouspage'])->name('previouspageuser');
            Route::post('/nextpage',[UserController::class,'nextpage'])->name('nextpageuser');
        });
    });
    Route::prefix('pengaturan')->group(function(){
        Route::get('/',[HomeController::class,'indexPengaturan'])->name('pengaturan');
        Route::post('/update/{id}',[HomeController::class,'updatePengaturan'])->name('updatepengaturandashboard');
    });
});
