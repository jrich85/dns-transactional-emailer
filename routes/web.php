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

Route::get('/invoice', 'CsvController@promptForInvoiceCsv')->name('prompt-invoices');
Route::get('/invoice-reminders', 'CsvController@promptForInvoiceReminderCsv')->name('prompt-invoice-reminders');
Route::post('/invoices/import', 'CsvController@importInvoices')->name('import-invoices');
Route::get('/receipt', 'CsvController@promptForReceiptCsv')->name('prompt-receipts');
Route::post('/receipts/import', 'CsvController@importReceipts')->name('import-receipts');

Route::get('/preview/pdf/invoice', 'PreviewController@previewInvoicePDF')->name('preview-invoice-pdf');
Route::get('/preview/pdf/receipt', 'PreviewController@previewReceiptPDF')->name('preview-receipt-pdf');
Route::get('/preview/email/invoice', 'PreviewController@previewInvoiceEmail')->name('preview-invoice-email');
Route::get('/preview/email/invoice/reminder', 'PreviewController@previewInvoiceReminderEmail')->name('preview-invoice-reminder-email');
Route::get('/preview/email/receipt', 'PreviewController@previewReceiptEmail')->name('preview-receipt-email');
