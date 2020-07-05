@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = 'en', ///'locale' => $locale = app()->getLocale(),
        'locales' => config('app.locales'),
        'spClientId' =>env('SENDPULSE_CLIET_ID'),
        'apiUrl'=>url('api'),
    ];
@endphp

<html id="spi" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
</div>
<script>
    window.config = @json($config);
</script>

<script src="{{ asset('js/app.js') }}"></script>
