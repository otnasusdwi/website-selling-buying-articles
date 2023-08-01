<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Penulis;
use App\Http\Controllers\Pembeli;
use App\Http\Controllers\Auth;;
use Ramsey\Uuid\Uuid;

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
    return redirect('/login');
});

Route::get('/uuid', function () {
    return Uuid::uuid4()->getHex();
});

Route::get('/register/penulis', [Auth\RegisterController::class, 'penulis'])->name('register.penulis');
Route::post('/register/penulis', [Auth\RegisterController::class, 'penulisStore'])->name('store.register.penulis');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('redirects', 'App\Http\Controllers\HomeController@index');


Route::get('download/{file}', 'App\Http\Controllers\DownloadController@index')->name('download');

// Route::get('/admin/dashboard', function () {
//     return 'Admin Page';
// })->middleware('auth', 'admin');

// Route::get('pembeli', function () {
//     return 'Pembeli Page';
// })->middleware('auth', 'pembeli');

// Route::get('penulis', function () {
//     return 'Penulis Page';
// })->middleware('auth', 'penulis');


Route::get('/check-overtime', 'App\Http\Controllers\ToolsController@checkOvertime')->name('checkOvertime');
Route::get('/check-available-upload', 'App\Http\Controllers\ToolsController@checkAvailableUpload')->name('checkAvailableUpload');

Route::middleware('auth', 'admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/order/verifikasi', [Admin\OrderController::class, 'index'])->name('admin.order.verifikasi');
        Route::post('/order/verifikasi/artikel/{id}/{status}', [Admin\OrderController::class, 'verifikasiArtikel'])->name('admin.order.verifikasi.artikel');
        Route::post('/order/verifikasi/payment/{id}/{status}', [Admin\OrderController::class, 'verifikasiPayment'])->name('admin.order.verifikasi.payment');

        Route::get('/artikel', [Admin\OrderController::class, 'indexArtikel'])->name('admin.artikel');
		Route::post('/artikel/edit', [Admin\OrderController::class, 'x'])->name('admin.artikel.edit');
		Route::post('/artikel/update', [Admin\OrderController::class, 'updateArtikel'])->name('admin.artikel.update');

        Route::get('/invoice', [Admin\PaymentController::class, 'index'])->name('admin.invoice');
        Route::get('/invoice/detail/{id}', [Admin\PaymentController::class, 'invoiceDetail'])->name('admin.invoice.detail');
        Route::post('/invoice/paid', [Admin\PaymentController::class, 'paidInvoice'])->name('admin.invoice.paid');

        Route::get('/penulis', [Admin\PenulisController::class, 'index'])->name('admin.penulis');
        Route::post('/penulis/update/{id}/{status}/{penulis_id}', [Admin\PenulisController::class, 'update'])->name('admin.penulis.update');

        Route::get('/fee', [Admin\PaymentController::class, 'fee'])->name('admin.fee');
        Route::get('/fee/edit/{id}', [Admin\PaymentController::class, 'feeDetail'])->name('admin.fee.edit');
        Route::post('/fee/update', [Admin\PaymentController::class, 'feeUpdate'])->name('admin.fee.update');
    });
});

Route::middleware('auth', 'penulis')->group(function () {
    Route::prefix('penulis')->group(function () {
        Route::get('/dashboard', [Penulis\DashboardController::class, 'index'])->name('penulis.dashboard');
        Route::post('/dashboard', [Penulis\DashboardController::class, 'resubmit'])->name('penulis.dashboard.resubmit');

        Route::get('/joblist', [Penulis\JobListController::class, 'index'])->name('penulis.joblist');
        Route::post('/joblist/ambil', [Penulis\JobListController::class, 'ambil'])->name('penulis.joblist.ambil');

        Route::get('/progress', [Penulis\ProgressController::class, 'index'])->name('penulis.progress');
		Route::post('/progress/edit', [Penulis\ProgressController::class, 'edit'])->name('penulis.progress.edit');
		Route::post('/progress/update', [Penulis\ProgressController::class, 'update'])->name('penulis.progress.update');

        Route::get('/payment', [Penulis\PaymentController::class, 'index'])->name('penulis.payment');
        Route::get('/payment/claim', [Penulis\PaymentController::class, 'claim'])->name('penulis.payment.claim');

        Route::get('/invoice', [Penulis\PaymentController::class, 'invoice'])->name('penulis.invoice');
        Route::get('/invoice/detail/{id}', [Penulis\PaymentController::class, 'invoiceDetail'])->name('penulis.invoice.detail');
    });
});

Route::middleware('auth', 'pembeli')->group(function () {
    Route::prefix('pembeli')->group(function () {
        Route::get('/dashboard', [Pembeli\DashboardController::class, 'index'])->name('pembeli.dashboard');

        Route::get('/artikel', [Pembeli\ArticleController::class, 'index'])->name('pembeli.artikel');
        Route::get('/artikel/order', [Pembeli\ArticleController::class, 'create'])->name('pembeli.order');
        Route::post('/artikel/order', [Pembeli\ArticleController::class, 'store'])->name('pembeli.order.store');
        Route::post('/artikel/order/pricing/{articletype_id}', [Pembeli\ArticleController::class, 'pricing'])->name('pembeli.order.pricing');
		Route::post('/artikel/order/edit', [Pembeli\ArticleController::class, 'edit'])->name('pembeli.order.edit');
		Route::post('/artikel/order/update', [Pembeli\ArticleController::class, 'update'])->name('pembeli.order.update');

        Route::get('/progress', [Pembeli\ProgressController::class, 'index'])->name('pembeli.progress');

        Route::get('/payment', [Pembeli\PaymentController::class, 'index'])->name('pembeli.payment');
    });
});