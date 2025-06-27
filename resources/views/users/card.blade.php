<div class="card-body bg-base-200 text-xl">
    <h2 class="card-title">{{ $user->name }}</h2>
    <figure class="px-6 pt-6">
        <img src="{{ $user->avatar_path ?? asset('default-avatar.png') }}" alt="Avatar" class="rounded-lg border object-cover w-36 h-36"/> 
    </figure>
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')
