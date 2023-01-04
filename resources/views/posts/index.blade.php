<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight float-left">
            {{ __('Posts') }}
        </h2>

        <div class="float-right">
            <button>
        </div>
    </x-slot>

    @if ($posts->total() > 0)
        @foreach ($posts as $post)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="/posts/{{$post->id}}">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="text-base">
                                {{ $post->title }}
                            </div>

                            <div class="text-xs">
                                {{ $post->user->name }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>       
        </div>
        @endforeach

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">
                        <div class="text-base text-white">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    @else
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-100">
                        <div class="text-base text-white">
                            {{ ('Please make a post!') }}
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    @endif

</x-app-layout>
