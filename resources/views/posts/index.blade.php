<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    @foreach ($posts as $post)
    <a href="">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-base">
                            {{ $post->title }}
                        </div>

                        <div class="text-xs">
                            {{ $post->author_id }}
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </a>
    @endforeach

</x-app-layout>
