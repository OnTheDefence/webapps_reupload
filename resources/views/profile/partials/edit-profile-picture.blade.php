<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" style="padding-bottom:2.75rem;">
            {{ __('Change Your Profile Picture') }}
        </h2>
    </header>

    @if ($user->image != null)
        <div style="padding-bottom:1.75rem;width:6rem;height:6rem;max-width:6rem;max-height:6rem;background-size:contain;">
            <img class="image" src="{{ asset('/images/'.App\Models\User::find(Auth::User()->id)->image->url) }}" alt="{{Auth::User()->name}}'s profile picture">
        </div>
    @else
        <div style="padding-bottom:1.75rem;max-width:5rem;max-height:5rem;background-size:contain;">
            <img class="image" src="{{ asset('/images/user.png') }}" alt="Default Profile Picture">
        </div>
    @endif

    <form method="post" action="{{ route('update_profile_picture') }}" class="space-y-6" enctype="multipart/form-data" style="padding-top:1.75rem;">
        @csrf
        {{csrf_field()}}

        <input type="file" name="image">

        <input type='hidden' name='user_id' value={{Auth::User()->id}}>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>

            @if (session('status') === 'profile picture updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Updated.') }}</p>
            @endif
        </div>
    </form>
</section>
