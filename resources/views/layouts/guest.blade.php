@props(['title', 'description', 'image', 'keywords', 'author'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="index, follow">
    <title>{{ isset($title) ? $title . '' : ''}}</title>
    <meta property="og:title" content="{{ isset($title) ? $title . '' : ''}}" />
    <meta property="og:description" content="{{ isset($description) ? $description . '' : ''}}" />
    <meta property="og:type" content="website.event" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ isset($image) ? $image . '' : ''}}" />
    <meta property="og:site_name" content="Spherevent" />
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
    <meta name="keywords" content="{{ isset($keywords) ? $keywords . '' : ''}}">
    <meta name="author" content="{{ isset($author) ? $author . '' : ''}}">

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-x3O-VakMxjcQYZMM"></script>

    <!-- Style -->
    <style>
        .hs-leaflet.leaflet-touch .leaflet-control-layers,
        .hs-leaflet.leaflet-touch .leaflet-bar {
            border-width: 0px;
        }

        .hs-leaflet.leaflet-touch .leaflet-bar a {
            line-height: 1.5;
            background-color: rgba(255, 255, 255, .8);
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        }

        .hs-leaflet.leaflet-touch .leaflet-bar a:first-child,
        .hs-leaflet.leaflet-touch .leaflet-bar a:last-child {
            border-radius: 8px;
        }

        .hs-leaflet .leaflet-control-zoom-in,
        .hs-leaflet .leaflet-control-zoom-out {
            font-weight: 400;
            font-size: 18px;
            color: #1f2937;
            text-indent: 0px;
        }

        .hs-leaflet .leaflet-bar {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .hs-leaflet .leaflet-bar a {
            border-width: 0;
        }

        .hs-leaflet .leaflet-bar a:hover,
        .hs-leaflet .leaflet-bar a:focus {
            background-color: #e5e7eb;
        }

        .hs-leaflet .leaflet-popup-content-wrapper,
        .hs-leaflet .leaflet-popup-tip {
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        .hs-leaflet .leaflet-popup-tip {
            border-radius: 4px;
        }

        .hs-leaflet.leaflet-container a.leaflet-popup-close-button {
            top: -10px;
            right: -10px;
            border-radius: 9999px;
            background-color: #f3f4f6;
            color: #1f2937;
            font-size: 14px;
            line-height: 1.6;
        }

        .hs-leaflet.leaflet-container a.leaflet-popup-close-button:hover {
            background-color: #f3f4f6;
        }

        .hs-leaflet-unstyled-popover .leaflet-popup-content-wrapper {
            display: flex;
        }

        .hs-leaflet-unstyled-popover .leaflet-popup-content {
            padding: 0;
            margin: 0;
            background: none;
            line-height: normal;
            border-radius: 0;
            font-size: inherit;
            min-height: auto;
        }
    </style>
    <x-rich-text::styles theme="richtextlaravel" data-turbo-track="false" />
</head>

<body class="font-sans text-gray-900 antialiased">
    @include('components.navbar')
    {{ $slot }}
    @include('components.footer')
</body>

</html>