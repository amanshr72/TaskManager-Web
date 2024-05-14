<x-app-layout>
    <x-slot name="header"></x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update Task</h2>
            <form action="{{ route('task.update', ['task' => $task->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div>
                        <x-input-label for="title" :value="__('Task Categories')" />
                        <select id="task_category" name="task_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected disabled>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ($task->task_category_id === $category->id) ? 'selected' : '' }} >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="sm:col-span-5">
                        <x-input-label for="title" :value="__('Task Name')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $task->title }}" disabled />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="sm:col-span-6">
                        <x-input-label for="description" :value="__('Task Description')" />
                        <textarea id="description" rows="3" name="description" disabled class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            {{ $task->description }}
                        </textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="sm:col-span-2">
                        <x-input-label for="asignee" :value="__('Assign To')" />
                        <select id="asignee" name="asignee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="" disabled selected>Select Assignee</option>
                            <?php $users = App\Models\User::orderBy('name')->get(); ?>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ (old('asignee') == $user->id || $task->assigned_to == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('asignee')" class="mt-2" />
                    </div>
                    <div class="sm:col-span-2">
                        <?php $taskStatus = ['Unassigned', 'Pending', 'Assigned', 'In Process']; ?>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select Status</option>
                            @foreach ($taskStatus as $status)
                                <option value="{{ $status }}" {{ (old('status') == $status || $task->status == $status) ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div> 
                    <div class="sm:col-span-2">
                        <?php $progressPercentage = ['25','50','75','100']; ?>
                        <x-input-label for="progress" :value="__('Progress')" />
                        <select id="progress" name="progress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select Progress</option>
                            @foreach ($progressPercentage as $progress)
                                <option value="{{ $progress }}" {{ (old('progress') == $status || $task->progress == $progress) ? 'selected' : '' }}>{{ $progress.'%' }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('progress')" class="mt-2" />
                    </div>
                    <div class="sm:col-span-6">
                        <x-input-label for="remark" :value="__('Remark')" />
                        <textarea id="remark" rows="2" name="remark" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write task remark here"></textarea>
                        <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Update task
                    </button>
                    <a href="{{ route('task.index') }}"  type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </section>
    
</x-app-layout>