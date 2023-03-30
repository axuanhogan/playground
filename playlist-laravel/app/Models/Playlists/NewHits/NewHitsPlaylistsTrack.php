<?php

namespace App\Models\Playlists\NewHits;

use Illuminate\Database\Eloquent\Model;

class NewHitsPlaylistsTrack extends Model
{
    protected $table = 'new_hits_playlists_track';
    protected $primaryKey = 'new_hits_playlists_track_id';
    protected $fillable = [
        'id',
        'title',
        'description',
        'image_url',
        'annotation',
    ];
    public $timestamps = false;
}
