<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\WilayahController;


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
Route::get('/Dependent', [DropdownController::class, 'index'])->name('Dependent.index');
Route::post('/Dependent', [DropdownController::class, 'store'])->name('Dependent.store');
Route::get('/Dependent/{id}/edit', [DropdownController::class, 'edit'])->name('Dependent.edit');
Route::post('/Dependent/Update', [DropdownController::class, 'update'])->name('Dependents.update');
Route::delete('/Dependent/{id}/delete', [DropdownController::class, 'destroy'])->name('Dependent.destroy');
// sampe sini
Route::get('Kabupaten/{id}', [WilayahController::class, 'kabupaten']);
Route::get('Kecamatan/{id}', [WilayahController::class, 'Kecamatan']);
Route::get('Kelurahaan/{id}', [WilayahController::class, 'keldes']);

// Route::get('Kabupaten/{id}', function ($id) {
//     $kabupaten = App\Models\kabkota::where('id_provinsi',$id)->get();
//     return response()->json($kabupaten);
// });
// Route::get('Kecamatan/{id}', function ($id) {
//     $Kecamatan = App\Models\Kecamatan::where('id_kabkota',$id)->get();
//     return response()->json($Kecamatan);
// });
// Route::get('Kelurahaan/{id}', function ($id) {
//     $kelurahaan = App\Models\keldes::where('id_kecamatan',$id)->get();
//     return response()->json($kelurahaan);
// });
