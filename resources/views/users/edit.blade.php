<x-app-layout>
<form action="{{route('updateProfile',$user->username)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
  <div class="flex flex-col mx-auto px-8">
    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-900/10">{{__('Profile')}}</h2>
    <p class="mt-1 text-sm/6 text-gray-600">{{__('This information will be displayed publicly so be careful what you share.')}}</p>

    <div class="mt-8 grid grid-cols-1 gap-6">
      <div class="col-span-full">
        <label for="username" class="block text-sm/6 font-medium text-gray-900">{{__('UserName')}}</label>
        <div class="mt-2">
          <input type="text" name="username" value="{{$user->username}}" id="username" placeholder="{{__('UserName')}}" autocomplete="username" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          @error('username')
            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
          @enderror
        </div>
      </div>

      <div class="col-span-full">
        <label for="bio" class="block text-sm/6 font-medium text-gray-900">{{__('Bio')}}</label>
        <div class="mt-2">
          <textarea id="bio" name="bio" rows="3" placeholder="{{__('Write a few sentences about yourself.')}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">{{$user->bio}}</textarea>
        </div>
      </div>

      <div class="col-span-full">
        <label for="image" class="block text-sm/6 font-medium text-gray-900">{{__('Photo')}}</label>
        <div class="mt-2 flex items-center gap-x-3">
          <img src="{{$user->image ? asset('storage/' . $user->image) : $user->image}}" alt="" class="rounded-full bg-gray-300 border-gray-600 w-12 h-12">
          <div class="flex flex-col items-center justify-content-between gap-3">
            <input type="file" name="image" id="image" class="rounded-full bg-transparent px-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"/>
            <p class="text-xs/5 text-gray-600">Supported [PNG, JPG, GIF] </p>
          </div>
        </div>
      </div>

      <div class="col-span-full">
        <div class="flex items-start">
          <div class="flex items-center h-5">
            <input type="checkbox" name="private_account" id="private_account"
            class="focus:ring-neutral-500 w-4 h-4 text-neutral-600 border-gray-300 rounded" 
            {{$user->private_account ? 'checked' : ''}}>
          </div>
          <div class="ml-3 text-sm">
            <label for="private_account" class="font-medium text-gray-700">{{__('Private Account')}}</label>
          </div>
        </div>
      </div>
    </div>
    
    <div class="border-b border-gray-900/10 pb-4 py-6 mt-6">
      <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-900/10">{{__('Personal Information')}}</h2>
      <p class="mt-1 text-sm/6 text-gray-600">{{__('Use a permanent address where you can receive mail.')}}</p>
      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 pb-4">
        <div class="col-span-full">
          <label for="name" class="block text-sm/6 font-medium text-gray-900">{{__('FullName')}}</label>
          <div class="mt-2">
            <input type="text" name="name" id="name" value="{{$user->name}}" placeholder="{{__('FullName')}}" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>
        <div class="col-span-full">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">{{__('Email address')}}</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" value="{{$user->email}}" autocomplete="email" placeholder="{{__('Email address')}}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
          </div>
        </div>
        <div class="col-span-full">
          <label for="password" class="block text-sm/6 font-medium text-gray-900">{{__('Password')}}</label>
          <div class="mt-2">
            <input type="password" name="password" id="password" placeholder="{{__('Password')}}" autocomplete="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            @error('password')
            <div class="text-sm text-red-600">{{$message}}</div>
        @enderror
          </div>
        </div>
        <div class="col-span-full">
          <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">{{__('Password Confirm')}}</label>
          <div class="mt-2">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{__('Password Confirm')}}" autocomplete="password-confirm" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            @error('password_confirmation')
                <div class="text-sm text-red-600">{{$message}}</div>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="mt-6 pb-6 flex items-center justify-end gap-x-6">
      <button type="submit" class="rounded-md bg-neutral-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{__('Save')}}</button>
    </div>
  </div>
</form>
</x-app-layout>