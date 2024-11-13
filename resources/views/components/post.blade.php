<div class="card">
    {{-- Card Header --}}
    <div class="card-header">
        <img src="{{$post->user->image}}" class="w-9 h-9 rounded-full mr-3">
        <a href="{{route('userProfile',$post->user->username)}}" class="font-bold">{{$post->user->username}}</a>
    </div>
    {{-- Card Body --}}
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <a href="{{route('showPost',$post->slug)}}">
                <img src="{{asset('storage')}}/{{$post->image}}" alt="" class="h-auto w-full object-cover">
            </a>
        </div>
        <div class="p-3">
            <a href="{{route('likePost',$post->slug)}}">
                @if ($post->liked(auth()->user()))
                <i class="bx bxs-heart text-2xl text-red-600 hover:text-gray-400 cursor-pointer mr-3"></i>
                @else
                <i class="bx bx-heart text-2xl hover:text-gray-400 cursor-pointer mr-3"></i>
                @endif
            </a>
        </div>
        <div class="p-3">
            <a href="{{route('userProfile',$post->user->username)}}" class="mr-1 font-bold">{{$post->user->username}}</a>
            <p class="text-gray-600">{{$post->description}}</p>
        </div>
        @if ($post->comments()->count() > 0)
            <a href="/post/{{$post->slug}}/show" class="p-3 font-bold text-sm text-gray-500">
                {{__('View all ' . $post->comments()->count() . ' comments')}}
            </a>
        @endif

        <div class="p-3 text-gray-400 uppercase text-xs">
            {{$post->created_at->diffForHumans()}}
        </div>
    </div>
    {{-- Card Footer --}}
    <div class="card-footer">
        <form action="/post/{{$post->slug}}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" placeholder="{{__('Add a comment...')}}" autocomplete="off" autocorrect="off"
                class="grow border-none resize-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400"></textarea>
                <button type="submit" class="bg-white border-none text-blue-500 ml-5">{{__('POST')}}</button>
            </div>
        </form>
    </div>
</div>