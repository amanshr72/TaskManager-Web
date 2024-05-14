<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>


    <div class="bg-gray-200 p-4 rounded-lg overflow-y-auto h-400">
        <h2 class="text-xl font-semibold mb-4">Categories</h2>
    
        <div class="flex flex-wrap ">
            @foreach($categories as $category)
                <a href="{{ route('task.allTaskList', ['categoryId' => $category->id]) }}" class="flex-shrink-0 bg-white p-4 rounded-lg shadow-md mb-4 mr-4 hover:bg-slate-200">
                    <h3 class="text-lg font-semibold mb-2">
                        {{ $category->name }}
                        <span class="text-sm text-gray-500">({{ $category->tasks->count() }} tasks)</span>
                    </h3>
                </a>
            @endforeach
        </div>
    </div>
    

</x-app-layout>
