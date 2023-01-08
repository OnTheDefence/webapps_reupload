<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class LikeComment extends Component
{
    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.like-comment');
    }

    public function like(){
        Comment::find($this->comment->id)->like();
    }

    public function unlike(){
        Comment::find($this->comment->id)->unlike();
    }

    public function getLikes()
    {
        return Comment::find($this->comment->id)->likeCount;
    }
}
