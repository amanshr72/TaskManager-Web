<x-app-layout>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-12 py-3">
                        Message
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Assigned to
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Assignd by
                    </th>
                    <th scope="col" class="px-4 py-3">
                        sttaus
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $notification->message }}
                        </th>
                        <td class="px-6 py-4">
                            {{ getUserNameById($notification->user_id) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ getUserNameById($notification->from_user_id) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($notification->read == 1)
                                <p class="font-semibold text-green-600">Unread</p>
                            @else
                                <p class="font-semibold text-red-600">Read</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('notifications.markAsRead', ['notification' => $notification->id]) }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                        <path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr colspan="4">No notifications yet</tr>
                @endforelse
            </tbody>
        </table>
        <div class="justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
            {{ $notifications->links() }}
        </div>
    </div>

</x-app-layout>