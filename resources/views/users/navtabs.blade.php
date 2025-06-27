<div class="tabs tabs-lifted">
    {{-- フォロー一覧タブ --}}
    <a href="{{ route('users.followings', $user->id) }}" class="tab grow {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}">
        Followings
        <div class="badge badge-neutral ml-1">{{ $user->followings_count }}</div>
    </a>
    {{-- フォロワー一覧タブ --}}
    <a href="{{ route('users.followers', $user->id) }}" class="tab grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
        Followers
        <div class="badge badge-neutral ml-1">{{ $user->followers_count }}</div>
    </a>
</div>