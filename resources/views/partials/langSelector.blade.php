@php $locale = \App::currentLocale(); @endphp
<div class="dropdown" id="langSelector">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        @switch($locale)
        @case('en')
        <img src="{{asset('img/flags/4x3/gb.svg')}}" style="height:20px;">
        @break
        @case('fr')
        <img src="{{asset('img/flags/4x3/fr.svg')}}" style="height:20px;">
        @break
        @default
        <img src="{{asset('img/flags/4x3/gb.svg')}}" style="height:20px;">
        @endswitch
        <span class="caret"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{route('set.language', ['lang' => 'en'])}}">
            <img src="{{asset('img/flags/4x3/gb.svg')}}" style="height:15px;" class="mr-2">English</a>
        <a class="dropdown-item" href="{{route('set.language', ['lang' => 'fr'])}}">
            <img src="{{asset('img/flags/4x3/fr.svg')}}" style="height:15px;" class="mr-2">Français</a>
    </div>
</div>
