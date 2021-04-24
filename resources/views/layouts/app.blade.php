<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Aurélien DIPPE - SIWEI">
    <title>{{ config('app.name', 'Siwei') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    <!-- Styles -->
    <link href="{{ mix('css/all.css') }}" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">{{ config('app.name', 'Siwei') }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="{{__('siwei.search')}}"
            aria-label="Search">
        <div class="dropdown mr-2">
            <a id="userMenuDropDown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="icofont-navigation-menu"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-user" aria-labelledby="userMenuDropDown">
                <li class="dropdown-item dropdown-userName dropdown-withBorder">
                    <i class="icofont-ui-user mr-2"></i>
                    {{Auth::user()->name}}
                </li>
                <li class="dropdown-item">
                    <a href="#">
                        <i class="icofont-ui-messaging mr-2"></i>
                        {{__('siwei.menuMessaging')}}
                    </a>
                </li>
                <li class="dropdown-item dropdown-withBorder">
                    <a href="#">
                        <i class="icofont-ui-settings mr-2"></i>
                        {{__('siwei.menuSettings')}}
                    </a>
                </li>
                <li class="dropdown-item dropdown-withBorder">
                    <a href="{{route('set.language', ['lang' => 'en'])}}">
                        <img src="{{asset('img/flags/4x3/gb.svg')}}" style="height:15px;" class="mr-2"></a>
                    <a href="{{route('set.language', ['lang' => 'fr'])}}">
                        <img src="{{asset('img/flags/4x3/fr.svg')}}" style="height:15px;" class="mr-2"></a>
                </li>
                <li class="dropdown-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="icofont-ui-power mr-2"></i>
                        {{__('siwei.menuLogOut')}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                @include('partials.menu')
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
                <div class="d-flex border-bottom breadcrumb">
                    @yield('breadcrumb')
                </div>
                <div id="mainContent">
                    @yield('actionBar')
                    <div id="pageContent" style="display:block; overflow-y:auto;">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>


    <div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lgd">
            <div class="modal-content">
                <div class="modal-body row">
                    <div class="col-2">
                        <i class="alertIcon"></i>
                    </div>
                    <div class="col-10 alertContent">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">
                        <i class="icofont-ui-check"></i> {{__('siwei.btnOk')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('i18n/'.App::getLocale().'.js')}}"></script>
    <script src="{{ mix('js/all.js') }}"></script>
    @stack('scripts')

    <script>
        let toastErrors = [];
        @if($errors->any())
        {!! implode('', $errors->all('toastErrors.push(":message"); ')) !!}
        @endif
        let toastMessages = [];
        @if(Session::has('message'))
        toastMessages.push("{{ Session::get('message') }}");
        @endif
        let toastSuccess = [];
        @if(Session::has('success'))
        toastSuccess.push("{{ Session::get('message') }}");
        @endif
    </script>
</body>

</html>
