@extends('Layout.main')
@extends('Layout.header')
@extends('Layout.content')
@extends('Layout.footer')

@section('BodyContent')
    <button class="button-search" type="button">
        <a class="a" href="{{ action('Playlists\NewHits\NewHitsPlaylists@entrance', ['show' => 'show']) }}">{{ __('messages.search') }}</a>
    </button>
@stop
