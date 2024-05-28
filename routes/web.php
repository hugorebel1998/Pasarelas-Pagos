<?php

use App\Http\Controllers\V1\Pagos\PagosController;
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

Route::get('/', function () {
    return response()->json(['success' => true, 'Bienvenido' => 'Pasarela pagos V2'], 200);
});

Route::get('/paypal/success', [PagosController::class, 'success'])->name('pago.success');
Route::get('/paypal/error', [PagosController::class, 'error'])->name('pago.error');