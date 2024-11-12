<x-app-layout>
  <div class="h-screen md:flex md:flex-row">
    {{-- Left Side --}}
    <div class="h-full md:w-7/12 bg-black flex items-center">
      <img src="{{asset('storage')}}/{{$post->image}}" alt={{$post->description}} class="max-h-screen object-cover mx-auto">
    </div>
    {{-- Right Side --}}
    <div class="flex w-full flex-col bg-white md:w-5/12">
      {{-- Top Section --}}
      <div class="border-b-2">
        <div class="flex items-center p-5">
          <img src="{{$post->user->image}}" alt="{{$post->user->username}}" class="mr-5 h-10 w-10 rounded-full">
          <a href="/{{$post->user->username}}" class="font-bold">
            {{$post->user->username}}
          </a>
        </div>
      </div>
      {{-- Middle --}}
      <div class="grow overflow-y-auto">
        <div class="flex items-start p-5">
          <img src="{{$post->user->image}}" alt="{{$post->user->username}}" class="mr-5 h10 w-10 rounded-full">
          <div>
            <a href="{{$post->user->username}}">{{$post->user->username}}</a>
            {{$post->description}}
          </div>
        </div>
        {{-- Comments --}}
        <div>
          @foreach ($post->comments as $comment)
          <div class="flex items-start px-5 py-2">
            <img src="{{$comment->user->image}}" alt="{{$comment->user->username}}" class="mr-5 h10 w-10 rounded-full">
            <div class="flex flex-col items-start ">
              <div class="flex items-center justify-content-between w-full">
                <a href="/{{$comment->user->username}}" class="font-bold">{{$comment->user->username}}</a>
                <p class="px-2 text-sm font-bold text-gray-400">
                  {{$comment->created_at->shortAbsoluteDiffForHumans()}}
                </p>
              </div>
              <div>
                  {{$comment->body}}
              </div>
            </div>
          </div>
          @endforeach
        </div>
        {{-- Add Comment Form --}}
      </div>
      <div class="border-t-2 p-5">
        <form action="{{route('storeComment',$post->slug)}}" method="POST">
          @csrf
          <div class="flex flex-row">
            <textarea name="body" id="comment_body" placeholder="Add a Comment..." 
            class="h-5 grow resize-none overflow-hidden border-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
            <button type="submit" class="ml-5 border-none bg-white text-blue-500">Post</button>
          </div>
        </form>
      </div>
      {{-- Bottom --}}

    </div>
  </div>
</x-app-layout>