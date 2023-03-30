@section('BodyHeader')
    <div class="header-div">
        <div class="header-page-title-div">{{ __("messages.header.$page_title") }}</div>
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="LanguageButton" data-bs-toggle="dropdown" aria-expanded="false">
              {{ __('messages.language_switch') }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="LanguageButton">
              <li><a class="dropdown-item" href="{{ url('/tw/playlists/new-hits') }}">{{ __('messages.tw') }}</a></li>
              <li><a class="dropdown-item" href="{{ url('/en/playlists/new-hits') }}">{{ __('messages.en') }}</a></li>
            </ul>
        </div>
    </div>
@stop


