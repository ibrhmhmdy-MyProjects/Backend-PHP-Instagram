<x-app-layout>
  <div class="my-5">
    {{$posts->links()}}
  </div>
  <div class="grid grid-cols-3 gap-1 md:gap-5 mt-8">
    @foreach ($posts as $post)
        <div>
          <a href="{{route('showPost',$post)}}">
            <img src="{{asset('storage')}}/{{$post->image}}" class="w-full aspect-square object-cover">
          </a>
        </div>
    @endforeach
  </div>
  <div class="py-5">
    {{$posts->links()}}
  </div>
</x-app-layout>