<x-app-layout>
    <x-slot name="header"></x-slot>
    
    <div class="text-left">
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
    </div>

    <div class="mx-auto max-w-screen-xl">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required="">
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Task Name</th>
                            <th scope="col" class="px-4 py-3">Task Category</th>
                            <th scope="col" class="px-4 py-3">Assigned By</th>
                            <th scope="col" class="px-4 py-3">Start Date</th>
                            <th scope="col" class="px-4 py-3">End Date</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Time Left</th>
                            <th scope="col" class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($tasks as $task)
                            <tr class="border-b dark:border-gray-700">
                                <tr class="border-b background-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $task->title }}</th>
                                    <td class="px-4 py-3">{{ $task->category->name ?? '' }}</td>
                                    <td class="px-4 py-3">{{ getUserNameById($task->assigned_by) }}</td>
                                    <td class="px-4 py-3">{{ $task->start_date }}</td>
                                    <td class="px-4 py-3">{{ $task->end_date }}</td> 
                                    <td class="px-4 py-3">{{ $task->status }}</td> 
                                    <td scope="col" class="px-4 py-3">
                                        <p class="countdown" data-start="{{ $task->start_date }}" data-end="{{ $task->end_date }}"></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-around">
                                            <a href="{{ route('task.markImportant',['task' => $task->id]) }}" class="hover:bg-gray-200 px-1.5 pt-0.5 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="30"  width="30" viewBox="0 -960 960 960">
                                                    <path d="M160-400v-80h280v80H160Zm0-160v-80h440v80H160Zm0-160v-80h440v80H160Zm360 560v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T863-380L643-160H520Zm300-263-37-37 37 37ZM580-220h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('task.unmarkImportant',['task' => $task->id]) }}" class="hover:bg-gray-200 px-1.5 pt-0.5 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                                    <path d="m233-120 65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/countdown.js') }}"></script>
</x-app-layout>