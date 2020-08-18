<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@redirecPage');
Route::prefix('gift-of-sight/')->group(function () {
    Route::get('/', 'HomeController@index')->name('home-page');
    Route::post('/payment', [
        'as' => 'stripe.payment'
        ,'uses' => 'HomeController@stripePayment'
    ]);

    Route::post('payment/stripe/webhook', [
        'as' => 'stripe.payment.webhook'
        ,'uses' => 'HomeController@stripe_payment_webhook'
    ]); //add this route in VerifyCsrfToken middleware, otherwise will fail due to csrf token check

    Route::get('/successfully/registration', [
        'as' => 'successfull-registration'
        ,'uses' => 'HomeController@successfullRegistration'
    ]);
    Route::get('/upload/photography', [
        'as' => 'upload.photography'
        ,'uses' => 'HomeController@uploadPhotography'
    ]);
    
    Route::post('/upload-photography', [
        'as' => 'photography'
        ,'uses' => 'HomeController@createPhotography'
    ]);
    Route::get('/success', [
        'as' => 'success'
        ,'uses' => 'HomeController@successRoute'
    ]);
    Route::get('/contestant-emailvalidation', 'HomeController@checkPaymentStatus')->name('email_check');
    Route::get('/cancel', [
        'as' => 'cancel'
        ,'uses' => 'HomeController@cancelRoute'
    ]);

    Route::get('/contestant-list', [
        'as' => 'contestant_list'
        ,'uses' => 'AdminController@contestantList'
    ])->middleware(['auth']);
    Route::get('/contestant-details/{id}', [
        'as' => 'contestant_details'
        ,'uses' => 'AdminController@contestantDetails'
    ])->middleware(['auth']);
    Route::get('/update_photo_gallery', [
        'as' => 'update_photo_gallery'
        ,'uses' => 'AdminController@updatePhotoGallery'
    ])->middleware(['auth']);
    Route::post('/delete_photo_gallery', [
        'as' => 'delete.photo_gallery'
        ,'uses' => 'AdminController@deletePhotoGallery'
    ])->middleware(['auth']);
    
    Route::get('/admin', [
        'as' => 'admin.login.from'
        ,'uses' => 'AdminController@loginFrom'
    ]);

    Route::post('delete','AdminController@removedContestant')->name('removed_contestant');

    Route::get('/entity-submission-validity', 'HomeController@entitySubmissionValidity')->name('submission_validity');


});
Auth::routes(['register' => false]);

