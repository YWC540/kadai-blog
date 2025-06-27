<div class="tabs tabs-lifted">
    {{-- ユーザー詳細タブ --}}
        <a href="{{ route('home') }}" class="tab grow {{ Request::routeIs('users.show') ? 'tab-active' : '' }}">
            TimeLine
        </a>
        {{-- フォロー一覧タブ --}}
        <a href="{{ route('users.followings', $user->id) }}" class="tab grow {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}">
            Followings
        </a>
        {{-- フォロワー一覧タブ --}}
        <a href="{{ route('users.followers', $user->id) }}" class="tab grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
            Followers
        </a>
        <a href="{{ route('my.likes') }}" class="tab grow {{ Request::routeIs('my.likes') ? 'tab-active' : '' }}">
            Like
        </a>
</div>