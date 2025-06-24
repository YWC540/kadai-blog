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
                @include('homepage.blog-list', ['blogs' => $blogs])
            </div>
        </div>
    </div>
@endsection
