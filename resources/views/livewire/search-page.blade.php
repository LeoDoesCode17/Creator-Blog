<div>
    <div>
        <input type="text" name="search" id="search" placeholder="Search User" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" wire:model.live.debounce.300ms="search">
    </div>
    @livewire('users-list')
</div>