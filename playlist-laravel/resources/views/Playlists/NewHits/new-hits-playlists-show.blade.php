@extends('Layout.main')
@extends('Layout.header')
@extends('Layout.content')
@extends('Layout.footer')

@section('HeadContent')
    <script src="{{ asset('public/js/playlists/new-hits/new-hits-playlists.js') }}"></script>
@stop

@section('BodyContent')
    <div class="body-content-div">
        <button type="button" class="button-previous">
            <a class="a" href="{{ action('Playlists\NewHits\NewHitsPlaylists@entrance') }}">
                {{ __('messages.back_to_search_page') }}
            </a>
        </button>
        <button type="button" class="button-track-list">
            <a class="a" href="{{ action('Playlists\NewHits\Tracklists@entrance') }}">
                {{ __('messages.track_list') }}
            </a>
        </button>
        @if(!empty($data['new_hits_playlists']))
            <ol class="list-group list-group-numbered bootstrap-list-ol">
                @foreach ($data['new_hits_playlists'] as $new_hits_playlists_value)
                    <li class="list-group-item d-flex justify-content-between align-items-start bootstrap-list-ol-li track-li">
                        <div class="bootstrap-list-ol-li-div-1">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold" name="title">
                                    {{ $new_hits_playlists_value['title'] }}
                                </div>
                                <div name="description">
                                    {{ $new_hits_playlists_value['description'] }}
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary track-button track-button{{ $new_hits_playlists_value['id'] }}" data-bs-toggle="modal" data-bs-target="#trackingListModal" {{ $new_hits_playlists_value['tracked'] ? 'disabled' : '' }}>
                                {{ $new_hits_playlists_value['tracked'] ? __('messages.tracked') : __('messages.track') }}
                            </button>
                            <input type="hidden" name="id" value="{{ $new_hits_playlists_value['id'] }}">
                        </div>
                        <div class="bootstrap-list-ol-li-div-2">
                            <img name="image" src="{!! $new_hits_playlists_value['images'][0]['url'] !!}">
                        </div>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
    <div class="modal fade" id="trackingListModal" tabindex="-1" aria-labelledby="trackingListModalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingListModalTitle"></h5>
                    <button id="trackingListModalCloseButton" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="trackingListModaldescription"></p>
                    <hr>
                    <h5>{{ __('messages.annotation') }}</h5>
                    <p><input type="text" name="" id="trackingListModalAnnotation"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                    <button type="button" id="trackingListModalButton" class="btn btn-primary">{{ __('messages.track') }}</button>
                </div>
            </div>
        </div>
        <input type="hidden" id="trackingListModalId" value="">
        <input type="hidden" id="trackingListModalImageUrl" value="">
    </div>
@stop
