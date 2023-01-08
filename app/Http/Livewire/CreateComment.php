<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CreateComment extends Component
{
    public $showDiv = false;

    public $user_id;
    public $post_id;
    public $content;

    protected $rules = [
        'content' => 'required',
    ];
    
    public function render()
    {
        return view('livewire.create-comment');
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }

    public function create(){
        $this->validate();

        $a = new Comment;
        $a->content = $this->content;
        $a->author_id = $this->user_id;
        $a->post_id = $this->post_id;
        $a->save();

        $this->emitTo('show-comments', '$refresh');

        session()->flash('message', 'comment created');
    }
}
