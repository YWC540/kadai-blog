<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite('resources/css/app.css')
    </head>

    <body class = "m-0 p-0 overflow-x-hidden w-full min-h-screen w-screen bg-gradient-to-r from-blue-500 to-purple-600 @yield('bodyClass')">
        
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')
        <div class="flex flex-col">
            @yield('content')
        </div>

    </body>
</html>

<script>
    function toggleLike(postId) {
        const component = event.target.closest('[x-data]');

        const liked = component.__x.$data.liked;

        const url = `/post/${postId}/like`;
        const method = liked ? 'DELETE' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            component.__x.$data.liked = data.liked;
            component.__x.$data.liked = data.likes_count;
        });
    }
</script>