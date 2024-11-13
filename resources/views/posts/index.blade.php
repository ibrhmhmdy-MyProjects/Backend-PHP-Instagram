<x-app-layout>
  <div class="flex flex-row max-w-3xl gap-8 mx-auto">
    {{-- Left side --}}
    <div class="w-[30rem] mx-auto lg:w-[95rem]">
      @forelse ($posts as $post)
        <x-post :post="$post"/>
      @empty
        <div class="max-w-2xl gap-8 mx-auto">
          {{ __('Start Following Your Friends and Enjoy.')}}  
        </div>  
      @endforelse
    </div>
    {{-- Right side --}}
    <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
      <div class="flex flex-row text-sm">
        <div class="mr-5">
          <a href="{{route('userProfile',auth()->user()->username)}}">
            <img src="{{auth()->user()->image ? asset('storage/' . auth()->user()->image) : auth()->user()->image}}" alt="{{auth()->user()->username}}"
            class="border border-gray-300 rounded-full w-12 h-12">
          </a>
        </div>
        <div class="flex flex-col">
          <a href="{{route('userProfile',auth()->user()->username)}}" class="font-bold">{{auth()->user()->username}}</a>
          <div class="text-gray-500 text-sm">{{auth()->user()->name}}</div>
        </div>
      </div>
      <div class="mt-5">
        <h3 class="text-gray-500 font-bold">{{__('Suggested For You')}}</h3>
        <ul>
          @foreach ($suggested_users as $user)
              <li class="flex flex-row my-5 text-sm justify-items-center">
                <div class="mr-5">
                  <a href="{{route('userProfile',$user->username)}}">
                    <img src="{{$user->image}}" class="border border-gray-300 rounded-full w-9 h-9">
                  </a>
                </div>
                <div class="flex flex-col grow">
                  <a href="{{route('userProfile',$user->username)}}" class="font-bold">{{$user->username}}</a>
                  <div class="text-gray-500 text-sm">{{$user->name}}</div>
                </div>
              </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</x-app-layout>