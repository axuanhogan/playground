<?php

$language = [
    'tw',
    'en'
];

$locale = Request::segment(1);
if (in_array($locale, $language)) {
    app()->setLocale($locale);
} elseif ($locale == null) { # This is for unittest
    $locale = '{locale?}';
} else {
    $locale = 'tw';
    app()->setLocale('tw');
}

Route::group(['prefix' => $locale], function () {
    Route::match(['GET'], '/', function () {
        return view('welcome');
    });

    Route::group(['prefix' => 'playlists', 'namespace' => 'Playlists'], function () {
        Route::group(['prefix' => 'new-hits', 'namespace' => 'NewHits'], function () {
            Route::match(['GET'], '{show?}', ['uses' => 'NewHitsPlaylists@entrance']);
            Route::group(['prefix' => 'show/track'], function () {
                Route::match(['GET', 'POST', 'PUT', 'DELETE'], '', ['uses' => 'Tracklists@entrance']);
            });
        });
    });
});
