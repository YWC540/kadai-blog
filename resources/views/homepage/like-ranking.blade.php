<div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold text-lg mb-3">Like Ranking</h3> 
    <ul class="space-y-2 text-sm">
        @foreach ($likeRanking as $post)
            <li>
                {{ $post->user->name ?? 'Anonymous' }}:
                「{{ Str::limit($post->body, 30) }}」
                👍 {{ $post->likes_count }}
            </li>
        @endforeach
    </ul>
</div>