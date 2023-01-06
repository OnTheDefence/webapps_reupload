<div>
    @if ($showDiv === false)
        <form method="POST" action="{{ route('attach_tag', ['id' => $post_id])}}" class="space-b-6">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Tag Name')" />
                <select 
                    class="mt-2 form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                    name="tag_id">

                    @foreach (App\Models\Tag::all() as $tag)
                        @if (!$tag->posts->contains(App\Models\Post::find($post_id)))
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <input type='hidden' name='post_id' value={{$post_id}}>

            <div class="flex items-center gap-4 pt-2">
                <x-primary-button>{{ __('Add Selected Tag') }}</x-primary-button>
                <button 
                    type="button" 
                    wire:click="openDiv" 
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{'Create a different Tag'}}
                </button> 

                @if (session('status') === 'tag-added')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Tag added.') }}</p>
                @endif 
             </div>
        </form>


    @else
        <form method="post" action="{{ route('create_tag', $post_id) }}" class="space-b-6">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Tag Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-2 block w-xl"/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <input type='hidden' name='post_id' value={{$post_id}}>

            <div class="flex items-center gap-4 pt-2">
                <x-primary-button>{{ __('Create this Tag') }}</x-primary-button>

            <button 
                type="button" 
                wire:click="openDiv" 
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{'Attach a different Tag'}}
            </button>

                @if (session('status') === 'post created')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    @endif
</div>