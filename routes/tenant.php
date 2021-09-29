<?php

use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\OwnerOnly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::group([
    'middleware' => ['tenant', PreventAccessFromCentralDomains::class], // See the middleware group in Http Kernel
    'as' => 'tenant.',
], function () {
    Route::redirect('/', '/home');

    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name('impersonate');

    Auth::routes();

    Route::post('/ploi/webhook/certificateIssued', 'PloiWebhookController@certificateIssued')->name('ploi.certificate.issued');
    Route::post('/ploi/webhook/certificateRevoked', 'PloiWebhookController@certificateRevoked')->name('ploi.certificate.revoked');

    Route::middleware(['auth', CheckSubscription::class])->group(function () {
        Route::redirect('/home', '/posts')->name('home');

        Route::get('/posts', 'PostController@index')->name('posts.index');
        Route::post('/posts', 'PostController@store')->name('posts.store');
        Route::get('/posts/create', 'PostController@create')->name('posts.create');
        Route::get('/posts/{post}', 'PostController@show')->name('posts.show');

        Route::get('/settings/user', 'UserSettingsController@show')->name('settings.user');
        Route::post('/settings/user/personal', 'UserSettingsController@personal')->name('settings.user.personal');
        Route::post('/settings/user/password', 'UserSettingsController@password')->name('settings.user.password');

        Route::middleware(OwnerOnly::class)->group(function () {
            Route::get('/settings/application', 'ApplicationSettingsController@show')->name('settings.application');
            Route::post('/settings/application/configuration', 'ApplicationSettingsController@storeConfiguration')->name('settings.application.configuration');
            Route::get('/settings/application/invoice/{id}/download', 'DownloadInvoiceController')->name('invoice.download');
        });
    });
});
