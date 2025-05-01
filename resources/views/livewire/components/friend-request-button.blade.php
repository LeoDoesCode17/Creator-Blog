<div>
    <button
        class="px-4 py-2 rounded-md transition text-white
               bg-{{ $color }}-600 hover:bg-{{ $color }}-800
               disabled:bg-{{ $color }}-400 disabled:cursor-not-allowed"
        wire:click="callAction"
        wire:loading.attr="disabled">
        {{ $label }}
    </button>
    <span wire:loading>Sending...</span>
</div>
