<div
    class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-3">
    @if ($users)
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
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="p-4 border-b border-blue-gray-50">
                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                        {{ $user['name'] }}
                    </p>
                </td>
                <td class="p-4 border-b border-blue-gray-50">
                    <a class="block font-sans text-sm antialiased font-normal leading-normal 
         text-blue-gray-900 hover:text-blue-500"
                        href="{{ route('user.show', $user['username']) }}">
                        {{ $user['username'] }}
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
        User Not Found
    </p>
    @endif
</div>