@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-8">
        @forelse ($blogs as $blog)
            <div class="card bg-base-100 shadow mb-4">
                <div class="card-body">
                    <h3 class="font-semibold">{{ $blog->user->name ?? 'who?' }}</h3>
                    <p class="break-words">{{ $blog->body }}</p>
                    @if ($blog->image_path)
                        <img src="{{ $blog->image_path }}" class="w-64 h-64 object-cover mt-2 rounded">
                    @endif
                </div>
            </div>
        @empty
            <p>Nothing here!</p>
        @endforelse
    </div>
@endsection