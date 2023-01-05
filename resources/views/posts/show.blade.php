<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div style="font-size: 2.25rem;">
                {{ $post->title }}

                <div class="text-gray-400 text-base py-1" style="float:right;">
                    <div style="float:right;">
                        {{ $post->user->name }}
                    </div>
                </div>

                

                
            </div>

            <div class="text-base" style="float:right;padding-bottom:1rem;">
                @if (Auth::User()->id === $post->author_id)
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
                            {{ $comment->user->name }}

                            <div class="text-sm" style="float:left;padding-top: 1.75rem;padding-bottom:1.25rem;">
                                @if (Auth::User()->id === $comment->author_id ?? Auth::User()->role === 'admin')
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
