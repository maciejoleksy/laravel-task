<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\User;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('home', [
            'users' => $users
        ]);
    }

    public function uploadAvatar(UploadRequest $request, User $user)
    {
        $avatar = $request->file('avatar');
        $filename = $user->id . time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(80, 80)->save(public_path('avatars/' . $filename));

        $user->update([
            'avatar' => $filename,
        ]);

        return redirect()->back();
    }
}
