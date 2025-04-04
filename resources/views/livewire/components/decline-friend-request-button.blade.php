<div>
    <button
        class="px-4 py-2 rounded-md transition text-white
               bg-yellow-600 hover:bg-yellow-800
               disabled:bg-yellow-400 disabled:cursor-not-allowed"
        wire:click="declineFriendRequest"
        wire:loading.attr="disabled">
        Decline
    </button>
    <span wire:loading>Sending...</span>
</div>