<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Tag') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Delete a tag using Administrator privileges") }}
        </p>
    </header>

    <form method="POST" action="{{ route('delete_tag') }}" class="mt-6 space-y-6">
        @csrf
        @method('DELETE')

        <div>
            <select 
                class="form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                name="tag_id"
            >
                @foreach (App\Models\Tag::all() as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}} ({{ $tag->id }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Delete') }}</x-primary-button>

            @if (session('status') === 'tag-deleted')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Deleted.') }}</p>
            @endif
        </div>
    </form>
</section>
