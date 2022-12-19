<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'ApiSite', 'namespace' => 'ApiSite'], function () {
    Route::group(['prefix' => 'new-hits-playlists', 'namespace' => 'Playlists'], function () {
        Route::match(array('GET'), '', ['uses' => 'NewHitsPlaylists@entrance']);
    });
});
