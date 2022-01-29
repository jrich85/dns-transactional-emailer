<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/preview/pdf/invoice', 'Controller@previewInvoicePDF')->name('preview-invoice');
Route::get('/preview/pdf/receipt', 'Controller@previewReceiptPDF')->name('preview-receipt');
Route::get('/preview/email/invoice', 'Controller@previewInvoiceEmail')->name('preview-invoice');
Route::get('/preview/email/invoice/{isLate}', 'Controller@previewInvoiceEmail')->name('preview-invoice');
Route::get('/preview/email/receipt', 'Controller@previewReceiptEmail')->name('preview-receipt');
