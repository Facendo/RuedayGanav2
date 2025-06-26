
<?php
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SorteoController;
use App\Models\Pago;
use Illuminate\Support\Facades\Route;

Route::get('/', [SorteoController::class, 'index'])->name('sorteo.index');
Route::get('/admin/sorteos/create', [SorteoController::class, 'create'])->name('sorteo.create');
Route::post('/sorteos/store', [SorteoController::class, 'store'])->name('sorteo.store')->middleware('auth');
Route::get('/admin/sorteos/{sorteo}/edit', [SorteoController::class, 'edit'])->name('sorteo.edit');
Route::put('/admin/sorteos/{sorteo}', [SorteoController::class, 'update'])->name('sorteo.update');
Route::delete('/admin/sorteos/{sorteo}', [SorteoController::class, 'destroy'])->name('sorteo.destroy')->middleware('auth');