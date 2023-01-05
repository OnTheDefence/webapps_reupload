<x-app-layout>
    @if (Route::currentRouteName() === "my_posts")
        <x-slot name="header">
            <h2 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight float-left" style="font-size: 2.25rem;">
                {{ __($user->name . "'s Posts") }}
            </h2>

        </x-slot>
    @else
        <x-slot name="header">
            <h2 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight float-left" style="font-size: 2.25rem;">
                {{ __('Posts') }}
            </h2>

        </x-slot>
    @endif

    @if (Route::currentRouteName() === "posts" or (Route::currentRouteName() === "my_posts" && Auth::User()->id === $user->id))
        @livewire('create-post')
    @endif
    @if ($posts->total() > 5)
        @foreach ($posts as $post)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="/posts/{{$post->id}}">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="text-base">
                                {{ $post->title }}
                                <div class="text-xs text-gray-400" style="float:right;">
                                    <a href="{{route('my_posts', ['id' => $post->user->id ])}}">
                                        {{ $post->user->name }}
                                    </a>
                                </div>
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
    @elseif ($posts->total() > 0)
        @foreach ($posts as $post)
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a href="/posts/{{$post->id}}">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="text-base">
                                    {{ $post->title }}
                                    <div class="text-xs text-gray-400" style="float:right;">
                                        <a href="{{route('my_posts', ['id' => $post->user->id ])}}">
                                            {{ $post->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>       
            </div>
        @endforeach
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
