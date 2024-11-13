<x-app-layout>
  <div class="grid grid-cols-4">
    {{-- User Image --}}
    <div class="px-4 col-span-1 order-1">
      <img src="{{$user->image ?? asset('storage') .'/'. $user->image}}" alt="{{$user->username}} Profile"
      class="rounded-full w-20 md:w-40 border border-neutral-300">
    </div>
    {{-- Username & Buttons --}}
    <div class="flex flex-col order-2 col-span-2 md:col-span-3 md:ml-0 px-4">
      <div class="text-3xl mb-3">{{$user->username}}</div>
        @if ($user->id === auth()->id())
            <a href="{{route('editProfile',$user->username)}}" 
              class="w-44 border text-sm font-bold py-1 rounded-md border-neutral-300 text-center">
              {{__('Edit Profile')}}
            </a>
        @endif
    </div>
    {{-- User Info --}}
    <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
      <p class="font-bold">{{$user->name}}</p>
      {!! nl2br(e($user->bio)) !!}
    </div>
    {{-- User Stats --}}
    <div class="col-span-4 my-5 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
      <ul class="flex flex-row justify-around md:justify-start text-md md:space-x-10 md:text-xl">
        <li class="flex flex-col md:flex-row text-center">
          <div class="md:mr-1 font-bold md:font-normal">
            {{$user->posts->count()}}
          </div>
          <span class="text-neutral-500 md:text-black">{{$user->posts->count() > 1 ? ' Posts' : 'Post'}}</span>
        </li>
      </ul>
      {{-- Bottom --}}
    </div>
  </div>
  @if ($user->posts()->count() > 0 and ($user->private_account == false or auth()->id() == $user->id))
      <div class="grid grid-cols-3 gap-1 my-5">
        @foreach ($user->posts as $post)
            <a href="{{route('showPost',$post->slug)}}" class="aspect-square block w-full">
              <img src="{{asset('storage')}}/{{$post->image}}" alt="{{$post->description}}" 
              class="w-full aspect-square object-cover">
            </a>
        @endforeach
      </div>
  @else
      <div class="w-full text-center mt-20">
        @if ($user->private_account == true and $user->id == auth()->id())
          {{__('This account is Private. Follow to see their photos.')}}
        @else
          {{__('This user does\'t have any post')}}
        @endif
      </div>
  @endif
</x-app-layout>