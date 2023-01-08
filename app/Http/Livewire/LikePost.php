<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class LikePost extends Component
{
    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function like(){
        Post::find($this->post->id)->like();
    }

    public function unlike(){
        Post::find($this->post->id)->unlike();
    }

    public function getLikes()
    {
        return Post::find($this->post->id)->likeCount;
    }
}
