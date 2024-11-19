<?php

namespace App\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.like');
    }

    public function toggle_likes(){
        auth()->user()->likes()->toggle($this->post);
    }

}
