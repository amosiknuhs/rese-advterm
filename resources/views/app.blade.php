<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rese</title>
    <link rel="shortcut icon" href="{{ asset('/img/favicon.svg') }}">
    <link rel="stylesheet" href="{{ mix('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/style.css') }}">
</head>

<body>
    <div id="app">
        <header-component></header-component>
        {{-- @if (Auth::guard('admin')->check())
        @elseif (Auth::guard('owner')->check())
        @else
        @endif --}}
        <router-view></router-view>
    </div>
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
