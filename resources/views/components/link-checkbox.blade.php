@props(['page','title','access'])
<div>
    <div class="form-control">
        <label class="cursor-pointer">
            <input type="checkbox" wire:click='changeAccess({{ $page }})'
                @if (in_array($page,$access))
                    checked="checked"
                @endif
                class="checkbox checkbox-info" />
            <span class="pl-1 label-text">{{ $title }}</span>
        </label>
    </div>
</div>
