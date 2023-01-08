<div>
    @foreach ($post->comments as $comment)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        {{ $comment->content }}

                        @if (Auth::User()->id === $comment->author_id or Auth::User()->role == 'admin')
                            <div class="text-red-400 text-sm py-1">
                                <a href="{{route('comment_show_edit', ['id' => $comment->id])}}">
                                    {{ "Edit comment" }}
                                </a>
                            </div>
                        @endif

                        <div class="text-sm text-gray-400" style="float:right;">
                            <a href="{{route('my_posts', ['id' => $comment->user->id ])}}">
                                <div style="width:15rem;">
                                {{ $comment->user->name }}
                                </div>

                                @if ($comment->user->image != null)
                                    <div style="margin-left:2rem;margin-bottom:2rem;padding-bottom:1.75rem;width:4rem;height:4rem;max-width:4rem;max-height:4rem;float:right;">
                                        <img class="image" src="{{ asset('/images/'.$comment->user->image->url) }}" alt="{{$comment->user->name}}'s profile picture">
                                    </div>
                                @else
                                    <div style="margin-left:2rem;margin-bottom:2rem;padding-bottom:1.75rem;width:4rem;height:4rem;max-width:4rem;max-height:4rem;float:right;">
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

                        <div class="pt-6"> 
                            @livewire('like-comment', ['comment' => $comment])
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    @endforeach
</div>
