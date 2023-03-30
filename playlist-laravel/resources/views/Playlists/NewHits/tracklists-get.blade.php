@extends('Layout.main')
@extends('Layout.header')
@extends('Layout.content')
@extends('Layout.footer')

@section('HeadContent')
    <script src="{{ asset('public/js/playlists/new-hits/new-hits-tracklists.js') }}"></script>
@stop

@section('BodyContent')
    
    <div class="body-content-div">
        <button type="button" class="button-previous">
            <a class="a" href="{{ action('Playlists\NewHits\NewHitsPlaylists@entrance', ['show' => 'show']) }}">
                {{ __('messages.back_to_list') }}
            </a>
        </button>
        @if(!$data['new_hits_playlists_track']->isEmpty())
            <ol class="list-group list-group-numbered bootstrap-list-ol">
                @foreach ($data['new_hits_playlists_track'] as $new_hits_playlists_track_value)
                    <li class="list-group-item d-flex justify-content-between align-items-start bootstrap-list-ol-li track-li">
                        <div class="bootstrap-list-ol-li-div-1">
                            <div class="ms-2 me-auto bootstrap-list-ol-li-div-1-1">
                                <div class="fw-bold" name="title">
                                    {{ $new_hits_playlists_track_value['title'] }}
                                </div>
                                <div name="description">
                                    {{ $new_hits_playlists_track_value['description'] }}
                                </div>
                                <div class="bootstrap-list-ol-li-div-1-1-3" id="annotation{{ $new_hits_playlists_track_value['new_hits_playlists_track_id'] }}" name="annotation">
                                    {{ $new_hits_playlists_track_value['annotation'] }}
                                </div>
                            </div>
                            <div class="bootstrap-list-ol-li-div-1-2">
                                <div class="bootstrap-list-ol-li-div-1-2-1">
                                    <button type="button" class="btn btn-primary modify-annotation-button" data-bs-toggle="modal" data-bs-target="#modifyAnnotationModal">
                                        {{ __('messages.modify_annotation') }}
                                    </button>
                                    <button type="button" class="btn btn-danger delete-track-button">
                                        {{ __('messages.cancel_track') }}
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $new_hits_playlists_track_value['new_hits_playlists_track_id'] }}">
                        </div>
                        <div class="bootstrap-list-ol-li-div-2">
                            <img name="image" src="{!! $new_hits_playlists_track_value['image_url'] !!}">
                        </div>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>

    <div class="modal fade" id="modifyAnnotationModal" tabindex="-1" aria-labelledby="modifyAnnotationModalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyAnnotationModalTitle"></h5>
                    <button id="modifyAnnotationModalCloseButton" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modifyAnnotationModaldescription"></p>
                    <hr>
                    <h5>{{ __('messages.annotation') }}</h5>
                    <p><input type="text" name="" id="modifyAnnotationModalAnnotation"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="button" id="modifyAnnotationModalButton" class="btn btn-primary">{{ __('messages.modify') }}</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="modifyAnnotationModalId" value="">
        <input type="hidden" id="modifyAnnotationModalImageUrl" value="">
    </div>
@stop
