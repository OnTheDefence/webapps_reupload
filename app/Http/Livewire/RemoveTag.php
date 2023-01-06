<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RemoveTag extends Component
{
    public $showDiv = false;

    public $post_id;
    public $tag_id;

    public function render()
    {
        return view('livewire.remove-tag');
    }
    
    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
