<div>
    <button
        class="px-4 py-2 rounded-md transition text-white
               bg-gray-600 hover:bg-gray-800
               disabled:bg-gray-400 disabled:cursor-not-allowed"
        wire:click="addFriend"
        wire:loading.attr="disabled">
        Add Friend
    </button>
    <span wire:loading>Sending...</span>
</div>