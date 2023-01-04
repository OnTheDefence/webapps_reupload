<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateComment extends Component
{
    public $showDiv = false;

    public $user_id;
    public $post_id;
    
    public function render()
    {
        return view('livewire.create-comment');
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
