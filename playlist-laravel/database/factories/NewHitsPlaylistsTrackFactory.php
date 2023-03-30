<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(NewHitsPlaylistsTrack::class, function (Faker $faker) {
    return [
        'id' => Str::random(18),
        'title' => $faker->text($maxNbChars = 30),
        'description' => $faker->text($maxNbChars = 100),
        'image_url' => $faker->url,
        'annotation' => $faker->text($maxNbChars = 20),
    ];
});
