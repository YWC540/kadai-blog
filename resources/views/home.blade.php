@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-10">
        {{--feature-cards--}}
        @include('homepage.feature-cards')

        {{--profile-editor--}}
        @include('homepage.profile-editor')

        {{--like-ranking + BLOG List--}}
        <div class="grid grid-cols-12 gap-6 px-4 pt-6">
            {{--like-ranking--}}
            <div class="col-span-2">
                @include('homepage.like-ranking')
            </div>
            <div class="col-span-10">
                @if ($blogs->isEmpty())
                    <p class="text-gray-500">There is no blog yet~</p>
                @else
                    @foreach ($blogs as $blog)
                        @include('homepage.blog-list', ['blog' => $blog])
                    @endforeach

                    <div class="mt-6 flex justify-center">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
