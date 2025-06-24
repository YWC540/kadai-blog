@if ($blogs->isEmpty())
    <p class="text-gray-500">There is no blog yet~</p>
@else
    @foreach ($blogs as $blog)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p class="font-semibold">{{ $blog->user->name ?? 'anonymous'}}</p>
            <p class="text-gray-600 text-sm">{{ $blog->created_at->diffForHumans() }}</p>
            <p class="mt-2">{{ $blog->content }}</p>
            @if ($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" class="mt-2 rounded">
            @endif
        </div>
    @endforeach
@endif