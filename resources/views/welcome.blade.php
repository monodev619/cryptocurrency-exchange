@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = app()->getLocale(),
        'locales' => config('app.locales'),
        'githubAuth' => config('services.github.client_id'),
    ];

    $polyfills = [
        'Promise',
        'Object.assign',
        'Object.values',
        'Array.prototype.find',
        'Array.prototype.findIndex',
        'Array.prototype.includes',
        'String.prototype.includes',
        'String.prototype.startsWith',
        'String.prototype.endsWith',
    ];
@endphp

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app"></div>
{{-- Global configuration object --}}
<script>window.config = @json($config);</script>

{{-- Polyfill JS features via polyfill.io --}}
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features={{ implode(',', $polyfills) }}"></script>

{{-- Load the application scripts --}}
@if (app()->isLocal())
    <script src="{{ mix('js/app.js') }}"></script>
@else
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
@endif
</body>
</html>