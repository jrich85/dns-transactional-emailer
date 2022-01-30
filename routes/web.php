<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreviewController;

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

Route::get('/invoice', 'CsvController@promptForInvoiceCsv');
Route::get('/receipt', 'CsvController@promptForReceiptCsv');

Route::get('/preview/pdf/invoice', 'PreviewController@previewInvoicePDF')->name('preview-invoice');
Route::get('/preview/pdf/receipt', 'PreviewController@previewReceiptPDF')->name('preview-receipt');
Route::get('/preview/email/invoice', 'PreviewController@previewInvoiceEmail')->name('preview-invoice');
Route::get('/preview/email/invoice/{isLate}', 'PreviewController@previewInvoiceEmail')->name('preview-invoice');
Route::get('/preview/email/receipt', 'PreviewController@previewReceiptEmail')->name('preview-receipt');
