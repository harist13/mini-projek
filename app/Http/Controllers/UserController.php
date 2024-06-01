<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\Friendship;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

  public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255|unique:users',
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::create([
        'username' => $request->username,
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('user');

    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
}


    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

  public function profile()
{
    $user = Auth::user();
    $posts = $user->posts()->latest()->get(); // Mengambil postingan terbaru dari pengguna
    return view('user.profile', compact('user', 'posts'));
}


public function editProfileForm()
{
    $user = Auth::user();
    return view('user.editprofile', compact('user'));
}

public function confirmPassword(Request $request)
{
    $user = Auth::user();
    if (Hash::check($request->password, $user->password)) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Incorrect password.']);
    }
}


public function updateProfile(Request $request)
{
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'nama' => 'required|string|max:255',
        'bio' => 'nullable|string|max:1000',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user->username = $request->username;
    $user->nama = $request->nama;
    $user->bio = $request->bio;

    if ($request->hasFile('photo')) {
        // Delete the old photo if exists
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }
        $path = $request->file('photo')->store('public/profile');
        $user->photo = basename($path);
    }

    $user->save();

    return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
}



     public function upload(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $path = $request->file('image')->store('public/posts');

        $post = new Post();
        $post->user_id = $user->id;
        $post->content = $request->description;
        $post->image_path = Storage::url($path);
        $post->save();

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }
    
     public function showPostForm()
    {
        return view('user.posting');
    }
    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        return view('user.dashboard', compact('posts'));
    }
  public function home1()
{
    $posts = Post::latest()->get();
    $users = User::where('id', '!=', Auth::id())->get(); // Fetch all users except the logged-in user
    return view('home', compact('posts', 'users'));
}

 public function like(Post $post)
    {
        $user = Auth::user();

        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();
        }

        return response()->json(['likes_count' => $post->likes()->count()]);
    }

    public function unlike(Post $post)
    {
        $user = Auth::user();

        $like = $post->likes()->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
        }

        return response()->json(['likes_count' => $post->likes()->count()]);
    }
    public function bookmark(Post $post)
{
    $user = Auth::user();

    if (!$post->bookmarks()->where('user_id', $user->id)->exists()) {
        $bookmark = new Bookmark();
        $bookmark->user_id = $user->id;
        $bookmark->post_id = $post->id;
        $bookmark->save();
    }

    return response()->json(['bookmarks_count' => $post->bookmarks()->count()]);
}

public function unbookmark(Post $post)
{
    $user = Auth::user();

    $bookmark = $post->bookmarks()->where('user_id', $user->id)->first();
    if ($bookmark) {
        $bookmark->delete();
    }

    return response()->json(['bookmarks_count' => $post->bookmarks()->count()]);
}

public function showBookmarks()
{
    $user = Auth::user();
    $bookmarks = Bookmark::with('post')->where('user_id', $user->id)->get();

    return view('User.bookmark', compact('bookmarks'));
}

 public function follow(User $user)
    {
        $authUser = Auth::user();

        if (!$authUser->following()->where('friend_id', $user->id)->exists()) {
            $authUser->following()->attach($user->id);
        }

        return redirect()->back()->with('success', 'Followed ' . $user->username);
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();

        if ($authUser->following()->where('friend_id', $user->id)->exists()) {
            $authUser->following()->detach($user->id);
        }

        return redirect()->back()->with('success', 'Unfollowed ' . $user->username);
    }

    public function followingPosts()
{
    $user = Auth::user();

    // Get the list of users the current user is following
    $followingIds = $user->following()->pluck('friend_id');

    // Get posts from users the current user is following
    $posts = Post::whereIn('user_id', $followingIds)->latest()->get();

    return view('following', compact('posts'));
}

// app/Http/Controllers/UserController.php

public function followers(User $user)
{
    $followers = $user->followers()->get();
    return view('user.followfollowing', compact('followers'))->with('type', 'followers');
}

public function following(User $user)
{
    $following = $user->following()->get();
    return view('user.followfollowing', compact('following'))->with('type', 'following');
}



}
