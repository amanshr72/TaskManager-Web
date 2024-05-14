<x-app-layout>

    
    <div class="text-left">
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @elseif(session('danger'))
            <x-alert type="danger" :message="session('danger')" />
        @endif
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">
                {{ isset($category) ? 'Update Category' : 'Add Category' }}
            </h2>
            <form action="{{ isset($category) ? route('category.update', ['category' => $category->id]) : route('category.store') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-12">
                        <x-input-label for="name" :value="__('Category Name')" />
                        <input type="text" name="name" placeholder="Type Category Name" value="{{ old('name', $category->name ?? '') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div> 
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ isset($category) ? 'Update Category' : 'Add Category' }}
                    </button>
                    <a href="{{ route('category.index') }}"  type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </section>
    
</x-app-layout>