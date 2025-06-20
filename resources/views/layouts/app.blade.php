<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
    </head>

    <body class = "m-0 p-0 overflow-hidden container mx-auto h-screen w-screen bg-gradient-to-r from-blue-500 to-purple-600">
        {{-- ナビゲーションバー --}}
            @include('commons.navbar')
        <div class="min-h-screen flex flex-col justify-center items-center">
            
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

    </body>
</html>