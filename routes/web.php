<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    echo 'This is Home page';
});

Route::get('/about', function() {
    return view('about');
});

Route::get('/contact-asdf-mpofkf', [ContactController::class, 'index'])->name('con');

//Category Routes

Route::get('/category/all', [CategoryController::class, 'allCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCat']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCat']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'pdeleteCat']);

//Brand Routes

Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand']);

//Multi Routes
Route::get('/multi/image', [BrandController::class, 'multiPic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'addMulti'])->name('store.image');





Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // $users = User::all();
        $users = DB::table('users')->get();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});
