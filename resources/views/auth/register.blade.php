@extends('layouts.app')

@section('bodyClass', 'overflow-hidden')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class = "bg-white p-8 rounded-lg shadow-lg w-1/2 max-w-2xl  bg-white/30 backdrop-blur border border-white/20">
        <div class="prose mx-auto text-center">
            <h2>Sign up</h2>
        </div>

        <div class="flex justify-center">
            <form method="POST" action="{{ route('register') }}" class="w-1/2">
                @csrf

                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="email" class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="password" class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered w-full">
                </div>

                <div class="form-control my-4">
                    <label for="password_confirmation" class="label">
                        <span class="label-text">Confirmation</span>
                    </label>
                    <input type="password" name="password_confirmation" class="input input-bordered w-full">
                </div>

                <button type="submit" class="btn btn-primary btn-block normal-case">Sign up</button>
            </form>
        </div>
    </div>
</div>
@endsection