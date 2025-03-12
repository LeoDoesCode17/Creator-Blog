<div>
    This is search page
    <div
        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-3">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            Name
                        </p>
                    </th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                            Username
                        </p>
                    </th>
                    <th class="p-4 border-b border-blue-gray-100 bg-blue-gray-50">
                        <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">Friend Status</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if(auth()->user()->getFriendshipStatus($user) !== 'blocked')
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $user->name }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $user->username }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                @if (auth()->user()->getFriendshipStatus($user) == 'accepted')
                                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        Friend
                                    </p>
                                @else
                                    <a href="#" class="block font-sans text-sm antialiased font-medium leading-normal text-blue-gray-900 hover:underline">
                                        Add Friends
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>