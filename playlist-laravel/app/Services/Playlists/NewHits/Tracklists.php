<?php

namespace App\Services\Playlists\NewHits;

use Validator;
use DB;

//Models
use NewHitsPlaylistsTrack;

class Tracklists
{
    public function getTrackLists()
    {
        return NewHitsPlaylistsTrack::orderBy('new_hits_playlists_track_id', 'desc')->get();
    }

    public function postValidator($request)
    {
        $id          = $request->input('id', '');
        $title       = $request->input('title', '');
        $description = $request->input('description', '');
        $image_url   = $request->input('image_url', '');
        $annotation  = $request->input('annotation', '');

        $validatorArray1 = [
            'id'          => $id,
            'title'       => $title,
            'description' => $description,
            'image_url'   => $image_url,
            'annotation'  => $annotation,
        ];
        $validatorArray2  =  [
            'id'          => 'required',
            'title'       => 'required|max:30',
            'description' => 'required',
            'image_url'   => 'required|max:100',
            'annotation'  => 'max:100',
        ];

        $validator = Validator::make($validatorArray1, $validatorArray2);
        
        return $validator;
    }

    public function putValidator($request)
    {
        $id         = $request->input('id', '');
        $annotation = $request->input('annotation', '');

        $validatorArray1 = [
            'id'         => $id,
            'annotation' => $annotation,
        ];
        $validatorArray2 =  [
            'id'         => 'required|numeric',
            'annotation' => 'max:100',
        ];

        $validator = Validator::make($validatorArray1, $validatorArray2);
        
        return $validator;
    }

    public function deleteValidator($request)
    {
        $id = $request->input('id', '');

        $validatorArray1 = [
            'id' => $id,
        ];
        $validatorArray2  =  [
            'id' => 'required|numeric',
        ];

        $validator = Validator::make($validatorArray1, $validatorArray2);
        
        return $validator;
    }

    public function repeatValidator($id)
    {
        $result = NewHitsPlaylistsTrack::find($id);
        if (!empty($result)) {
            $return_data = true;
        } else {
            $return_data = false;
        }

        return $return_data;
    }

    public function firstOrCreate($request)
    {
        $db_result = DB::transaction(function () use ($request) {
            $result = NewHitsPlaylistsTrack::firstOrCreate([
                'id' => $request->input('id')
            ], [
                'id'          => !empty($request->input('id')) ? $request->input('id') : '',
                'title'       => !empty($request->input('title')) ? $request->input('title') : '',
                'description' => !empty($request->input('description')) ? $request->input('description') : '',
                'image_url'   => !empty($request->input('image_url')) ? $request->input('image_url') : '',
                'annotation'  => !empty($request->input('annotation')) ? $request->input('annotation') : '',
            ]);

            return $result;
        });

        return $db_result;
    }

    public function update($request)
    {
        $db_result = DB::transaction(function () use ($request) {
            $result = NewHitsPlaylistsTrack::find($request->input('id'))
                                            ->update([
                                                'annotation' => $request->input('annotation'),
                                            ]);
            return $result;
        });
        
        return $db_result;
    }

    public function delete($request)
    {
        $db_result = DB::transaction(function () use ($request) {
            $result = NewHitsPlaylistsTrack::find($request->input('id'))->delete();
            return $result;
        });
        
        return $db_result;
    }
}
