<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">Task Name</th>
                <th scope="col" class="px-4 py-3">Task Category</th>
                <th scope="col" class="px-4 py-3">Assigned By</th>
                <th scope="col" class="px-4 py-3">Assigned to</th>
                <th scope="col" class="px-4 py-3">Start Date</th>
                <th scope="col" class="px-4 py-3">End Date</th>
                <th scope="col" class="px-4 py-3">Status</th>
                <th scope="col" class="px-4 py-3">Time Left</th>
                <th scope="col" class="px-4 py-3">Progress %</th>
                <th scope="col" class="px-4 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr class="border-b background-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <button data-modal-target="taskTimelineModal-{{$task->id}}" data-modal-toggle="taskTimelineModal-{{$task->id}}" class="text-teal-600 font-semibold">
                            {{ $task->title }}
                        </button>
                        <!-- Main modal -->
                        <div id="taskTimelineModal-{{$task->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-green-500 dark:text-white">{{ $task->title }}</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="taskTimelineModal-{{$task->id}}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4 text-balance">
                                        <ol class="relative border-s border-gray-200 dark:border-gray-700">                  
                                                @forelse($task->logs as $log)
                                                    <li class="ms-4 mb-5">
                                                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ date('d-m-Y', strtotime($log->created_at)) }}</time>
                                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Status: {{ $log->status }}</h3>
                                                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $log->remark }}</p>
                                                    </li>
                                                @empty
                                                    <li class="mb-10 ms-4">
                                                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">No logs yet</h3>
                                                    </li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    <!-- Modal footer -->
                                </div>
                            </div>
                        </div>
                    </th>
                    <td class="px-4 py-3">{{ $task->category->name ?? '' }}</td>
                    <td class="px-4 py-3">{{ getUserNameById($task->assigned_by) }}</td>
                    <td class="px-4 py-3">{{ getUserNameById($task->assigned_to) }}</td>
                    <td class="px-4 py-3">{{ $task->start_date }}</td>
                    <td class="px-4 py-3">{{ $task->end_date }}</td> 
                    <td class="px-4 py-3">{{ $task->status }}</td> 
                    <td scope="col" class="px-4 py-3">
                        <p class="countdown" data-start="{{ $task->start_date }}" data-end="{{ $task->end_date }}"></p>
                    </td>
                    <td class="px-4 py-3">
                        @if($task->progress == 0)
                            <p class="text-orange-600 font-semibold">No Progress Yet</p>
                        @else
                            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{$task->progress}}%"> {{$task->progress}}%</div>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-around">
                            <a href="{{ route('task.edit',['task' => $task->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="30"  width="30" viewBox="0 -960 960 960">
                                    <path d="M160-400v-80h280v80H160Zm0-160v-80h440v80H160Zm0-160v-80h440v80H160Zm360 560v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T863-380L643-160H520Zm300-263-37-37 37 37ZM580-220h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z"/>
                                </svg>
                            </a>
                            @if ($task->is_important !== 1)
                                <a href="{{ route('task.markImportant',['task' => $task->id]) }}" class="hover:bg-gray-200 px-1.5 pt-0.5 rounded-lg">
                                    <span class="material-symbols-outlined">star</span>
                                </a>
                            @else
                                <a href="{{ route('task.unmarkImportant',['task' => $task->id]) }}" class="hover:bg-gray-200 px-1.5 pt-0.5 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                        <path d="m233-120 65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>