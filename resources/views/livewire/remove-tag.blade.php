<div>
    @if ($showDiv)
        <button 
            type="button" 
            wire:click="openDiv" 
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{'Cancel'}}
        </button> 
        <form method="POST" action="{{ route('detach_tag', ['id' => $post_id])}}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Tag Name')" />
                <select 
                    class="form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                    name="tag_id"
                >
                    @foreach (App\Models\Post::find($post_id)->tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>

            <input type='hidden' name='post_id' value={{$post_id}}>

            <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Remove Selected Tag') }}</x-primary-button>
            

                @if (session('status') === 'tag-removed')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Tag removed.') }}</p>
                @endif 
            </div>
        </form>


    @else
        <button 
            type="button" 
            wire:click="openDiv" 
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{'Remove a tag'}}
        </button>
    @endif
</div>