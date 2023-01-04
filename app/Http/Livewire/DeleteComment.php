<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DeleteComment extends Component
{
    public $showDiv = false;

    public $comment_id;

    public function render()
    {
        return view('livewire.delete-comment');
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
