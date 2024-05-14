<?php 
    $users = App\Models\User::where('id', '!=', auth()->user()->id)->orderBy('name')->get(); 
    $categories = App\Models\TaskCategory::orderBy('name')->get(); 
?>

<div id="taskCreateModal-1" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Task
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="taskCreateModal-1">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            
            <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <x-input-label for="title" :value="__('Task Categories')" />
                        <select id="task_category" name="task_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('task_category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="title" :value="__('Task Name')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" placeholder="Name your task" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="description" :value="__('Task Description')" />
                        <textarea id="description" rows="4" name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write task description here"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="description" :value="__('Start Date')" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="datetime-local" name="start_date" :value="old('start_date') ?? now()->format('Y-m-d\TH:i:s')" />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('End Date')" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="datetime-local" name="end_date" :value="old('end_date') ?? now()->addDays(1)->format('Y-m-d\TH:i:s')" />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>
                      
                    <div>
                        <x-input-label for="asignee" :value="__('Assign To')" />
                        <select id="asignee" name="asignee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="" disabled selected>Select Assignee</option>
                            <option value="{{ auth()->user()->id }}">Myself</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('asignee') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option> 
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('asignee')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Add new task
                        </button>
                    </div>

                    <div class="flex items-center">
                       <div class="flex items-center ms-3">
                          <div class="flex items-center lg:order-2">
                            <button disabled class="px-2" data-popover-target="dueDataPopver-bottom" data-popover-placement="left">
                                <span class="material-symbols-outlined">calendar_month</span>
                            </button>
                            <button disabled class="px-2" data-popover-target="remindPopver-bottom" data-popover-placement="top">
                                <span class="material-symbols-outlined">alarm</span>
                            </button>
                            <button disabled class="px-2" data-popover-target="repeatPopver-bottom" data-popover-placement="right">
                                <span class="material-symbols-outlined">repeat</span>
                            </button>
                          </div>
                       </div>
                    </div>

                </div>

                <!-- Due Date popover -->
                <div data-popover id="dueDataPopver-bottom" role="tooltip" class="absolute z-10 invisible inline-block w-45 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-center">Add a due date</h3>
                    </div>
                    <div class="px-3 py-2 content-center text-base">
                        <select id="due_date" name="due_date" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option class="py-2 text-center" disabled selected value="">Select Due Date</option>
                            <option class="py-2 text-center" value="{{ now()->setTime(19, 0) }}">Today - {{ now()->format('l') }}</option>
                            <option class="py-2 text-center" value="{{ now()->addDay()->setTime(19, 0) }}">Tomorrow - {{ now()->addDay()->format('l') }}</option>
                            <option class="py-2 text-center" value="{{ now()->addWeek()->setTime(19, 0) }}">Next week - {{ now()->addWeek()->format('l') }}</option>
                            <option disabled></option>
                        </select>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <!-- Remind me popover -->
                <div data-popover id="remindPopver-bottom" role="tooltip" class="absolute z-10 invisible inline-block w-45 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-center">Reminder</h3>
                    </div>
                    <div class="px-3 py-2">
                        <select id="reminder" name="reminder" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option class="py-2 text-center" disabled selected value="">Select Reminder</option>
                            <option class="py-2 text-center" value="{{ now()->setTime(19, 0) }}">Later Today - {{ now()->setTime(19, 0)->format('h A') }}</option>
                            <option class="py-2 text-center" value="{{ now()->addDay()->setTime(9, 0) }}">Tomorrow - {{ now()->addDay()->setTime(9, 0)->format('h A') }}</option>
                            <option class="py-2 text-center" value="{{ now()->addWeek()->setTime(9, 0) }}">Next week - {{ now()->addWeek()->setTime(9, 0)->format('h A') }}</option>
                            <option disabled></option>
                        </select>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <!-- Repeat popover -->
                <div data-popover id="repeatPopver-bottom" role="tooltip" class="absolute z-10 invisible inline-block w-45 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Popover bottom</h3>
                    </div>
                    <div class="px-3 py-2">
                        <select id="recurrence" name="recurrence" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option class="py-2 text-center" disabled selected value="">Select Recurrence</option>
                            <option class="py-2 text-center" value="daily">Daily</option>
                            <option class="py-2 text-center" value="weekdays">Weekdays</option>
                            <option class="py-2 text-center" value="weekly">Weekly</option>
                            <option class="py-2 text-center" value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                
            </form>
        </div>
    </div>
</div>