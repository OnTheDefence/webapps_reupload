@if ($showDiv)
<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        <div style="font-size: 1.75rem;">
                            {{ "Create Post" }}
                        </div>
                        <form method="post" action="{{ route('post_store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                    
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                    
                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <x-text-input id="content" name="content" type="text" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            </div>

                            <div style="float:right;">
                                <input type="file" name="image">
                            </div>
                    
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                <button type="button" wire:click="openDiv" class="float-right">{{'Cancel'}}</button>
                    
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
                </div>
            </div>
        </div>       
    </div>
</div>
@else
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <button type="button" wire:click="openDiv">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 bg-gray-200">
                    <div class="text-base text-white" style="font-size: 1.75rem;">
                        Create Post
                    </div>
                </div>
            </div>
        </button>
    </div>   
</div>
@endif