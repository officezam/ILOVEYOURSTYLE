<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\VoiceController;
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


Route::get('/', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');

/* Route Contacts */
Route::group(['prefix' => 'contacts'], function () {
    //Route::get('', [ContactsController::class,'contact'])->name('contact');
    Route::get('all-contacts', [ContactsController::class,'FetchAll'])->name('all-contacts');
    Route::get('add-contact', [ContactsController::class,'ShowAddContact'])->name('add-contact');
    Route::post('save-contact', [ContactsController::class,'Store'])->name('save-contact');
    Route::get('update-contact/{id}', [ContactsController::class,'Edit'])->name('update-contact');
    Route::post('update-save', [ContactsController::class,'Update'])->name('update-save');
    Route::get('delete-contact/{id}', [ContactsController::class,'Delete'])->name('delete-contact');
    Route::get('contact-detail/{id}', [ContactsController::class,'Detail'])->name('contact-detail');

    Route::get('allList', [ContactsController::class,'FetchAlllist'])->name('allList');
    Route::get('add-list', [ContactsController::class,'Addlist'])->name('add-list');
    Route::post('save-contact-list', [ContactsController::class,'StoreList'])->name('save-contact-list');
    Route::get('contact-list-detail/{id}', [ContactsController::class,'ContactListDetail'])->name('contact-list-detail');


});
/* Route contacts */


/* Route SMS */
Route::group(['prefix' => 'sms'], function () {
    Route::get('', [ SMSController::class,'FetchAll'])->name('sms-list');
    Route::get('sms-list', [SMSController::class,'FetchAll'])->name('sms-list');
    Route::get('new-sms', [SMSController::class,'ShowNewSMS'])->name('new-sms');
    Route::post('sms-send', [SMSController::class,'StoreSMS'])->name('sms-send');
    Route::get('delete-sms/{id}', [SMSController::class,'Delete'])->name('delete-sms');

    Route::get('bulk-sms', [SMSController::class,'ShowBulkSms'])->name('bulk-sms');
    Route::post('bulk-sms-send', [SMSController::class,'StorebulkSMS'])->name('bulk-sms-send');
});
/* Route SMS */

/* Route Voice */
Route::group(['prefix' => 'voice'], function () {

    Route::get('send-voice', [VoiceController::class,'initiateCall'])->name('send-voice');


    Route::get('', [ CallController::class,'initiateCall'])->name('call-list');
    Route::get('call-list', [CallController::class,'FetchAll'])->name('call-list');
    Route::get('make-call', [CallController::class,'makeCall'])->name('make-call');

});
/* Route Voice */


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

