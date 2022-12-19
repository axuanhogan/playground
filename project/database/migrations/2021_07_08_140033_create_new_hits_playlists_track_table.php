<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewHitsPlaylistsTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_hits_playlists_track', function (Blueprint $table) {
            $table->increments('new_hits_playlists_track_id')->comment('流水編號');
            $table->string('id', 20)->comment('編號');
            $table->string('title', 30)->comment('標題');
            $table->text('description')->comment('內容');
            $table->string('image_url', 100)->comment('圖片');
            $table->string('annotation', 20)->comment('註解');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_hits_playlists_track');
    }
}
