<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div style="font-size: 2.25rem;">
                {{ $post->title }}

                <div class="text-gray-400 text-base py-1" style="float:right;">
                    <div style="float:right;">
                        <a href="{{route('my_posts', ['id' => $post->user->id ])}}">
                            {{ $post->user->name }}

                            @if ($post->user->image != null)
                                <div style="margin-left:2rem;padding-bottom:1.75rem;width:4rem;height:4rem;float:right;">
                                    <img class="image" src="{{ asset('/images/'.$post->user->image->url) }}" alt="{{$post->user->name}}'s profile picture">
                                </div>
                            @else
                                <div style="margin-left:2rem;padding-bottom:1.75rem;width:4rem;height:4rem;float:right;">
                                    <img class="image" src="{{ asset('/images/user.png') }}" alt="Default Profile Picture">
                                </div>
                            @endif
                        </a>
                    </div>
                </div>
                
                <div class="text-gray-400 text-sm py-1">
                    {{ "Tags:" }}
                    @foreach ($post->tags as $tag)
                        {{ $tag->name . ","}}
                    @endforeach
                </div>
            </div>

            <div class="text-base" style="float:right;padding-bottom:1rem;">
                @if (Auth::User()->id === $post->author_id or Auth::User()->role == 'admin')
                    @livewire('delete-post', ['post_id' => $post->id])
                @endif
            </div>
        </h2>
    </x-slot>

    @if (Auth::User()->id === $post->author_id or Auth::User()->role == 'admin')
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-xl">               
                            @livewire('add-tag', ['post_id' => $post->id])
                            <div class="pt-4">
                                @livewire('remove-tag', ['post_id' => $post->id])
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    @endif



    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-xl">
                        {{ $post->content }}

                        @if ($post->image != null)
                            <div style="float:right;padding-bottom:1.75rem;max-width:50rem;background-size:contain;">
                                <img class="image" src="{{ asset('/images/'.$post->image->url) }}" alt="{{$post->user->name}}'s post's image">
                            </div>
                        @endif
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
                                <div style="width:15rem;">
                                {{ $comment->user->name }}
                                </div>

                                @if ($post->user->image != null)
                                    <div style="margin-left:2rem;margin-bottom:2rem;padding-bottom:1.75rem;width:4rem;height:4rem;float:right;">
                                        <img class="image" src="{{ asset('/images/'.$post->user->image->url) }}" alt="{{$post->user->name}}'s profile picture">
                                    </div>
                                @else
                                    <div style="margin-left:2rem;margin-bottom:2rem;padding-bottom:1.75rem;width:4rem;height:4rem;float:right;">
                                        <img class="image" src="{{ asset('/images/user.png') }}" alt="Default Profile Picture">
                                    </div>
                                @endif
                            </a>

                            <div class="text-sm" style="padding-bottom:1.25rem;">
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
