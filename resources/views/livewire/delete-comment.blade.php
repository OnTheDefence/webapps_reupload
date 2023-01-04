<div>
    @if ($showDiv)
    <div class="float-right">
        <form method="POST" action="{{ route('delete_comment', ['id' => $comment_id])}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4" 
                style="tw-text-opacity: 1;color: rgba(248, 113, 113, var(--tw-text-opacity));">
                {{'Delete'}}
            </button>


            <button type="button" wire:click="openDiv" class="text-white">{{'Cancel'}}</button>  
        </form>
    </div> 
    @else
        <button type="button" wire:click="openDiv" class="float-right"
            style="tw-text-opacity: 1;color: rgba(248, 113, 113, var(--tw-text-opacity));">
            {{'Delete Comment'}}
        </button>
    @endif
</div>
