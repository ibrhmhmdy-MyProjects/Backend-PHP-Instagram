<?php

namespace App\View\Components;

use App\Models\Post as ModelsPost;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Post extends Component
{
    
    public $post;

    public function __construct(ModelsPost $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post');
    }
}
