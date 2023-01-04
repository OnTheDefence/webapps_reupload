<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div class="pb-4" style="font-size: 2.25rem;">
                {{ $post->title }}

                <div class="text-gray-400 text-base pb-4" style="float:right;">
                    {{ $post->user->name }}
                </div>
            </div>

            <div class="text-base py-4">
                {{ $post->content }}
            </div>

        </h2>
    </x-slot>

    @foreach ($post->comments as $comment)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        {{ $comment->content }}
                        <div class="text-xs text-gray-400" style="float:right;">
                            {{ $comment->user->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    @endforeach

</x-app-layout>
