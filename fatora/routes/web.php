<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoicesReportControllers;
USE App\Http\Controllers\AdminController;
USE App\Http\Controllers\FatoraController;
USE App\Http\Controllers\SectionsController;
USE App\Http\Controllers\InovicesController;
USE App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
USE App\Http\Controllers\InvoicesDetailsController;
USE App\Http\Controllers\InvoiceAttachmentsController;
USE App\Http\Controllers\InvoiceAchiveController;
USE App\Http\Controllers\CustomersReportControllers;
USE App\Http\Controllers\DashboardController;



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
    return view('auth.login');
});
Route::get('/dashboard', [DashboardController ::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::resource('invoices', FatoraController::class);
Route::resource('Sections', SectionsController::class);
Route::resource('invoice', InovicesController::class);


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

Route::get('invoices_report', [InvoicesReportControllers ::class, 'index']);
Route::post('Search_invoices', [InvoicesReportControllers::class, 'Search_invoices']);
Route::get('customers_report', [CustomersReportControllers ::class, 'index'])->name("customers_report");
Route::post('Search_customers', [CustomersReportControllers::class, 'Search_customers']);
Route::get('MarkAsRead_all', [FatoraController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');
Route::get('unreadNotifications_count', [FatoraController::class, 'unreadNotifications_count'])->name('unreadNotifications_count');
Route::get('unreadNotifications', [FatoraController::class, 'unreadNotifications'])->name('unreadNotifications');



Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
Route::resource('Archive', InvoiceAchiveController::class);
Route::get('/section/{id}', [FatoraController::class, 'getproducts']);

Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
Route::get('/edit_invoice/{id}', [FatoraController::class, 'edit']);
Route::get('/Status_show/{id}', [FatoraController::class, 'show'])->name('Status_show');

Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);
Route::get('Print_invoice/{id}', [FatoraController::class, 'Print_invoice']);

Route::get('Invoice_Paid', [FatoraController::class, 'Invoice_Paid']);
Route::get('Invoice_UnPaid', [FatoraController::class, 'Invoice_UnPaid']);
Route::get('Invoice_Partial', [FatoraController::class, 'Invoice_Partial']);

Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
Route::post('/Status_Update/{id}', [FatoraController::class, 'Status_Update'])->name('Status_Update');
Route::get('/{page}', [AdminController::class, 'index']);

Route::get('fatora/export/', [FatoraController::class, 'export']);
