<div>
    @php
        use App\Enums\FriendshipStatus;
    @endphp
    {{ $user->name }}
    @if (!$friendship)
        <!-- not found any friendship request from authed user nor from visited user -->
        <p>Send friend request to {{ $user->name }}</p>
        @livewire('components.add-friend-button', ['receiverId' => $user->id])
    @else
        <!-- found friendship request from authed user or from visited user -->
        @if ($friendship->status == FriendshipStatus::ACCEPTED->value)
            <p>You're friends with {{ $user->name }}</p>
        @elseif ($friendship->status == FriendshipStatus::DECLINED->value)
            <p>Send friend request to {{ $user->name }}</p>
            @livewire('components.add-friend-button', ['receiverId' => $user->id])
        @elseif ($friendship->status == FriendshipStatus::BLOCKED->value)
            @if ($isSender)
                <p>You've been blocked by {{ $user->name }}</p>
            @else
                <p>You've blocked {{ $user->name }}</p>
            @endif
        @else
            @if ($isSender)
                <p>Wait for {{ $user->name }} to accept your friend request</p>
            @else
                <br>
                <br>
                @livewire('components.accept-friend-request-button', ['user' => $user])
                <br>
                @livewire('components.decline-friend-request-button', ['user' => $user])
                <br>
                @livewire('components.block-friend-request-button', ['user' => $user])
            @endif
        @endif
    @endif
</div>