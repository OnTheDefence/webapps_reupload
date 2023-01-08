<div>
    @if ($comment->liked())
        <button type="button" wire:click="unlike" class="float-right">{{"Unlike (" . $this->getLikes() . ")"}}</button>
    @else
        <button type="button" wire:click="like" class="float-right">{{"Like (" . $this->getLikes() . ")"}}</button>
    @endif
</div>