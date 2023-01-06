<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div style="font-size: 2.25rem;">
                {{ $post->title }}

                <div class="text-gray-400 text-base py-1" style="float:right;">
                    <div style="float:right;">
                        <a href="{{route('my_posts', ['id' => $post->user->id ])}}">
                            {{ $post->user->name }}
                        </a>
                    </div>
                </div>

                <div class="text-gray-400 text-sm py-1">
                    @foreach ($post->tags as $tag)
                        {{ $tag->name }}
                    @endforeach
                </div>

                <form method="post" action="{{ route('create_tag', $post->id) }}" class="mt-6 space-y-6">
                    @csrf
            
                    <div>
                        <x-input-label for="name" :value="__('Tag Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"/>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
            
                    <input type='hidden' name='post_id' value={{$post->id}}>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
            
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

                
            </div>

            <div class="text-base" style="float:right;padding-bottom:1rem;">
                @if (Auth::User()->id === $post->author_id or Auth::User()->role == 'admin')
                    @livewire('delete-post', ['post_id' => $post->id])
                @endif
            </div>
        </h2>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-xl">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </div>       
    </div>
    @livewire('create-comment', ['post_id' => $post->id, 'user_id' => Auth::User()->id])
    @foreach ($post->comments as $comment)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        {{ $comment->content }}
                        <div class="text-sm text-gray-400" style="float:right;">
                            <a href="{{route('my_posts', ['id' => $comment->user->id ])}}">
                                {{ $comment->user->name }}
                            </a>

                            <div class="text-sm" style="float:left;padding-top: 1.75rem;padding-bottom:1.25rem;">
                                @if (Auth::User()->id === $comment->author_id or Auth::User()->role == 'admin')
                                    @livewire('delete-comment', ['comment_id' => $comment->id])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    @endforeach

</x-app-layout>
