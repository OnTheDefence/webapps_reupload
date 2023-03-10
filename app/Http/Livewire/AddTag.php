<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddTag extends Component
{
    public $showDiv = false;

    public $post_id;
    public $tag_id;

    public function render()
    {
        return view('livewire.add-tag');
    }
    
    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
