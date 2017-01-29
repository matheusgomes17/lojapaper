<ul class="dropdown-menu" aria-labelledby="lang">
        @foreach (array_keys(config('locale.languages')) as $lang)
                @if ($lang != App::getLocale())
                        <li><a href="{{ url('lang/'.$lang) }}"><img src="{{ asset('img/frontend/flag/'.$lang.'.jpg') }}" alt=""> {{ trans('menus.language-picker.langs.'.$lang) }} </a></li>
                @endif
        @endforeach
</ul>