@if ($showDiv)
<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        <div style="font-size: 1.25rem;">
                            {{ "Make a comment" }}
                        </div>
                        <form wire:submit.prevent="create" class="mt-6 space-y-6">
                            @csrf
                    
                            <div>
                                <x-input-label for="content" :value="__('Content')" />
                                <x-text-input type="text" wire:model="content" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('content')" />
                            </div>
                    
                            <div class="flex items-center gap-4">
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    {{'Save'}}
                                </button>
                                <button type="button" wire:click="openDiv" class="float-right">{{'Cancel'}}</button>
                    
                                @if (session('status') === 'comment created')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>

                            
                            {{ csrf_field() }}
                            <input type='hidden' name='author_id' value={{$user_id}}>
                            <input type='hidden' name='post_id' value={{$post_id}}>
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
                    <div class="text-base text-white" style="font-size: 1.25rem;">
                        {{ "Make a comment" }}
                    </div>
                </div>
            </div>
        </button>
    </div>   
</div>
@endif