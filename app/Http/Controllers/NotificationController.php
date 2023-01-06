<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Notification;
use App\Notifications\NewCommentOnPost;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notifications');
    }

    public function ReadNotification($user_id, $id, $post_id){

        $user = User::find($user_id);
        $user->unreadNotifications->where('id', $id)->markAsRead();

        return redirect()->route('single_post', ['id' => $post_id]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function NewCommentOnPost($id) {
        $post = Post::find($id);

        $postData = [
            'post_id' => $id,
            'post_title' => $post->name,
        ];

        Notification::send($post->user, new NewCommentOnPost($postData));
        return redirect()->route('single_post', ['id' => $id]);
    }
}
