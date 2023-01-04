<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class DeletePost extends Component
{
    public $showDiv = false;

    public $post_id;

    public function render()
    {
        return view('livewire.delete-post');
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
