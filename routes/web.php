<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::middleware('isGuest')->group(function(){
    Route::get('/', [PostController::class, 'index']);
    Route::get('/register', [PostController::class, 'register']);
    // untuk menyimpan data menggunakan database
    Route::post('/register/input', [PostController::class, 'registerAccount'])->name('register.input');
    Route::post('/login/auth', [PostController::class, 'auth'])->name('login.auth');
});


Route::get('/logout', [PostController::class, 'logout']);
// Route::get('/todo', [PostController::class, 'todo']);



// membuat route dengan child
Route::middleware('isLogin')->prefix('/todo')->group(function(){
    Route::get('/', [PostController::class, 'todo'])->name('todo.index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    // Route::get('/completed/{id}', [PostController::class, 'completed'])->name('completed');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/selesai', [PostController::class, 'selesai']);

    //Route path yang menggunakan {} berarti dia berperan sebagai parameter route
    //parameter ini bentuknya data dinamis(data yang dikirim ke route untuk di ambil di parameter function controller terkait)
    Route::get('/edit/{id}',[PostController::class, 'edit'])->name('edit');

    // dari kak fema
    //route delete berguna untuk menghapus data di database
    Route::delete('/delete/{id}', [PostController::class, 'destroy']);

    Route::patch('/completed/{id}', [PostController::class, 'updateCompleted'])->name('update-completed');
    
    // Route::get('/delete/{id}', [PostController::class, 'destroy']);

    //method patch berguna untuk mengubah/mengganti isi database
    Route::patch('/update/{id}', [PostController::class, 'update'])->name('update');
});
