<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    public $showDiv = false;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
