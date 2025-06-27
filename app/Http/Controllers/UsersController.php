<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザー一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        // ユーザー一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function show($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user) 
    {
        if ($user->id !== \Auth::id()) {
            abort(403);
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('SUPABASE_API_KEY'),
                'apikey' => env('SUPABASE_API_KEY'),
            ])->attach(
                'file', file_get_contents($file), $filename
            )->post(env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $filename);

            if ($response->failed()) {
                return back()->with('error', 'Avatar upload failed.');
            }
            
            $user->avatar_path = env('SUPABASE_URL') . '/storage/v1/object/' . env('SUPABASE_BUCKET') . '/' . $filename;
            $user->save();
        }

        return redirect()->route('users.edit', $user->id)->with('success', 'Profile updated.');
    }

    /**
     * ユーザーのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザーのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
}
