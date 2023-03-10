<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function uploadProfilePicture(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required',
        ]);
        $url = $request->file('image')->store('', ['disk' => 'images']);
            
        $image = new Image;
        $image->url = $url;
        $user = User::find($request->user_id);

        if ($user->image != null){
            $user->image()->delete();
        }
        
        $user->image()->save($image);

        return redirect()->route('profile.edit')->with('status', 'profile picture updated');
    }

    public function updateRole(Request $request){
        $user = User::where('email', $request->user_email)->first();
        $user->role = $request->role;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'role-updated');
    }


    public function posts($id)
    {
        $user = User::find($id);
        $posts = collect($user->posts)->paginate(5);

        return view('posts.index', ['posts' => $posts, 'user' => $user]);
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
