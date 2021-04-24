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
    <link href="{{ mix('css/all-logout.css') }}" rel="stylesheet">
</head>

<body class="text-center">
    @include('partials.langSelector')

    @yield('content')

    <script src="{{ mix('js/all-logout.js') }}"></script>
    <script>
        @error('email')
        toastErrors.push("{{ $message }}");
        @enderror
        @error('password')
        toastErrors.push("{{ $message }}");
        @enderror
        @if(Session::has('error'))
        toastErrors.push("{{ Session::get('error') }}");
        @endif
        @if(Session::has('message'))
        toastMessages.push("{{ Session::get('message') }}");
        @endif
        @if(Session::has('success'))
        toastSuccess.push("{{ Session::get('message') }}");
        @endif
    </script>
</body>

</html>
