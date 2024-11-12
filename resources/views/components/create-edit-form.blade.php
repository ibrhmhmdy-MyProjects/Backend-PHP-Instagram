
      <input type="file" name="image" id="input_image" class="w-full border border-gray-50 block focus:outline-none rounded-xl">
      <p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="input_image_help">PNG,JPG,GIF</p>

      <textarea 
          name="description" 
          rows="5" 
          class="mt-5 w-full border border-gray-200 rounded-xl" 
          placeholder="{{__('Write a Description...')}}">{{$post->description??""}}</textarea>
