<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <div style="font-size: 2.25rem;">
                {{ Auth::User()->name . "'s Notifications" }}
            </div>
        </h2>
    </x-slot>

    @foreach (App\Models\User::find(Auth::User()->id)->unreadNotifications as $notification)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-base">
                        <a href="{{route('read_notification', ['user_id' => Auth::User()->id,'id' => $notification->id, 'post_id' => $notification->data['post_id']])}}">
                            {{ "Someone has commented on your post: ". App\Models\Post::find($notification->data['post_id'])->title}}
                        </a>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    @endforeach

</x-app-layout>
