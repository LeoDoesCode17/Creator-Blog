<div>
    <button
        class="px-4 py-2 rounded-md transition text-white
               bg-red-600 hover:bg-red-800
               disabled:bg-red-400 disabled:cursor-not-allowed"
        wire:click="blockFriendRequest"
        wire:loading.attr="disabled">
        Block
    </button>
    <span wire:loading>Sending...</span>
</div>