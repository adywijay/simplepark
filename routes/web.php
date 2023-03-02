<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\General;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [General::class, 'index']);
Route::prefix('base')->group(

    function () {

        Route::get('/', [General::class, 'index']);
        Route::get('/parkir', [General::class, 'getParkir'])->name('parkir_all');

        Route::post('/parkiradd', [General::class, 'addParkir'])->name('addparkir');
        Route::put('/parkirkalkulasi/{id}', [General::class, 'parkirKalkulasi']);
        Route::get('/kalkulasipark', [General::class, 'getTotalBayarParkir'])->name('kalkulasi_parkir');
    }
);
