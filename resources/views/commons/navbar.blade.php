<header class="mb-4 sticky top-0 z-50 bg-black text-white shadow-md">
    <nav class="navbar text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1><a class="btn btn-ghost hover:bg-black/40 normal-case text-3xl text-white" href="/">Blog</a></h1>
        </div>

        <div class="flex-none">
            <div class="dropdown dropdown-end">
                @if (Auth::check())
                <div tabindex="0" role="button" class="btn btn-ghost btn-square avatar">
                    <div class="w-10 rounded-full mr-4">
                        <img src="{{ $user->avatar_path ?? asset('default-avatar.png') }}">
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        {{-- ユーザー一覧ページへのリンク --}}
                        <li><a class="text-black {{ request()->routeIs('login') ? 'bg-black/80 backdrop-blur-md shadow-xl font-semibold' : 'hover:bg-blue-100'}}" href="{{ route('users.index') }}">Users</a></li>
                        {{-- ユーザー詳細ページへのリンク --}}
                        <li><a class="text-black {{ request()->routeIs('login') ? 'bg-black/80 backdrop-blur-md shadow-xl font-semibold' : 'hover:bg-blue-100'}}" href="{{ route('users.edit', Auth::user()->id) }}">{{ Auth::user()->name }}&#39;s profile</a></li>
                        <li class="divider lg:hidden"></li>
                        {{-- ログアウトへのリンク --}}
                        <li><a class="text-black {{ request()->routeIs('login') ? 'bg-black/80 backdrop-blur-md shadow-xl font-semibold' : 'hover:bg-blue-100'}}" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
                    </ul>
                </form>
                @else
                <div class="flex items-center space-x-6">
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-success btn-lg text-white border-white px-6 py-2 text-lg{{ request()->routeIs('register') ? 'text-white bg-black/40 backdrop-blur-md shadow-xl font-semibold' : 'text-white hover:bg-black/40'}}" href="{{ route('register') }}">
                        Signup
                    </a>

                    {{-- ログインページへのリンク --}}
                    <a class="btn btn-outline btn-lg text-white border-white px-6 py-2 text-lg{{ request()->routeIs('login') ? 'text-white bg-black/40 backdrop-blur-md shadow-xl font-semibold' : 'text-white hover:bg-black/40'}}" href="{{ route('login') }}">
                        Login
                    </a>
                </div>
                @endif
            </div>
        </div>
    </nav>
</header>