<div class="bg-white p-4 rounded shadow mb-4">
    <p class="font-semibold">{{ $blog->user->name ?? 'anonymous'}}</p>
    <p class="text-gray-600 text-sm">{{ $blog->created_at->diffForHumans() }}</p>
    <p class="mt-2">{{ $blog->body }}</p>

    @if ($blog->image_path)
        <img src="{{ $blog->image_path }}" class="w-64 h-64 object-cover mt-2 rounded">
    @endif

    <div 
        x-data="{
            liked: {{ $blog->likes->where('user_id', auth()->id())->count() ? 'true' : 'false' }},
            count: {{ $blog->likes->count() }},
            toggleLike() {
                fetch('{{ route('posts.toggleLike', $blog->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.liked = data.liked;
                    this.count = data.likes_count;
                });
            }
        }"
        class="mt-2 flex items-center gap-2"
    >
        <button
            @click.prevent="toggleLike"
            class="btn btn-sm text-white flex items-center gap-2"
            :class="liked ? 'btn-error' : 'btn-primary'"
        >
            <span x-text="liked ? 'unlike' : 'like'"></span>
            <span class="badge badge-neutral" x-text="count"></span>
        </button>
    </div>
</div>
        