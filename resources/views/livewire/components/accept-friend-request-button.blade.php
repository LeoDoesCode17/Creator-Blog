<div>
    <button
        class="px-4 py-2 rounded-md transition text-white
               bg-green-600 hover:bg-green-800
               disabled:bg-green-400 disabled:cursor-not-allowed"
        wire:click="acceptFriendRequest"
        wire:loading.attr="disabled">
        Accept
    </button>
    <span wire:loading>Sending...</span>
</div>