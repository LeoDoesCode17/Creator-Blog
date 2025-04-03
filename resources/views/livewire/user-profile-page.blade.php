<div>
    @php
        use App\Enums\FriendshipStatus;
    @endphp

    {{ $user->name }}
    @if (!$friendship)
        <p>Send friend request to {{ $user->name }}</p>
        @livewire('components.add-friend-button')
    @else
        @if ($friendship->status == FriendshipStatus::PENDING->value)
            <p>Wait for {{ $user->name }} to accept your friend request</p>
        @elseif ($friendship->status == FriendshipStatus::ACCEPTED->value)
            <p>You and {{ $user->name }} are friends</p>
        @elseif ($friendship->status == FriendshipStatus::DECLINED->value)
            <p>Send friend request to {{ $user->name }}</p>
            @livewire('components.add-friend-button')
        @else
            <!-- this condition, the receiver($user) blocks the sender(auth()->user()) request -->
            <p></p>
        @endif
    @endif

</div>