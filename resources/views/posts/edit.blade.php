<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div style="font-size: 2.25rem;">
                {{ "Editing post with title: " . $post->title }}
            </div>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        <form method="post" action="{{ route('post_edit', ['id' => $post->id]) }}" class="mt-6 space-y-6">
                            @csrf
                
                            <div>
                                <x-input-label for="content" :value="__('Post content')" />
                                <x-text-input id="content" name="content" type="text" class="mt-1 block w-full" :value="old('content', $post->content)" required autofocus autocomplete="{{$post->content}}" />
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            </div>

                
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                
                                @if (session('status') === 'post-edited')
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
                </div>
            </div>
        </div>       
    </div>

</x-app-layout>
