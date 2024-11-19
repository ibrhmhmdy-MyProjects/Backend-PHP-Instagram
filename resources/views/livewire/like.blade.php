<div>
    <div class="p-3">
        <a href="{{route('likePost',$post->slug)}}">
            @if ($post->liked(auth()->user()))
            <i class="bx bxs-heart text-2xl text-red-600 hover:text-gray-400 cursor-pointer mr-3"></i>
            @else
            <i class="bx bx-heart text-2xl hover:text-gray-400 cursor-pointer mr-3"></i>
            @endif
        </a>
    </div>
</div>
