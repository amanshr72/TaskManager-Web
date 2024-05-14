<?php 
    $cur_route =  Route::current()->getName(); 
    $categories = App\Models\TaskCategory::orderBy('name')->get(); 
?>
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
          <li>
            <a href="{{ route('dashboard') }}" class="@if($cur_route === 'dashboard') bg-green-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="{{ route('task.allTaskList') }}" class="@if($cur_route === 'task.allTaskList') bg-green-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="material-symbols-outlined">assignment_add</span>
                <span class="ms-3">Task List</span>
            </a>
          </li>
          <li>
            <a href="{{ route('task.assignedToMe') }}" class="@if($cur_route === 'task.assignedToMe' || $cur_route === 'task.edit') bg-green-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="material-symbols-outlined mr-4">person</span>
                Assigned to me
            </a>
          </li>
          <li>
            <a href="{{ route('category.index') }}" class="@if($cur_route === 'category.index' || $cur_route === 'category.edit') bg-green-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <span class="material-symbols-outlined mr-4">category</span>
                Categories
            </a>
          </li>
          <li>
            <a href="{{ route('important') }}" class="@if($cur_route === 'important') bg-green-100 @endif flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="80 -840 800 760" width="1em" class="text-lg mr-4">
                    <path d="m354-247 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-80l65-281L80-550l288-25 112-265 112 265 288 25-218 189 65 281-247-149L233-80Zm247-350Z"/>
                </svg>
                Important
            </a>
          </li>
          <li>
              <button @if($cur_route !== 'task.allTaskList') disabled @endif class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                  <span class="material-symbols-outlined">trending_up</span>
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Category</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                  </svg>
              </button>
              <ul style="list-style-type: circle;" id="dropdown-example" class="hidden py-2 space-y-2 ml-9">
                @foreach($categories as $category)
                    <li><button onclick="filterByCategory('{{ $category->id }}')">{{ $category->name }}</button></li>
                @endforeach
              </ul>
          </li>
        </ul>
    </div>
</aside>

<div class="p-4 sm:ml-64">
    <div class="border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14">
        <main>
            {{ $slot }}
        </main>
    </div>
</div>

<script>
    function filterByCategory(categoryId) {
        $.ajax({
            url: "category-filter",
            type: 'GET',
            data: { category: categoryId },
            success: function (resp) {
                $('#dashboard-task-list').empty();
                $('#dashboard-task-list').html(resp);
            },
            error: function (resp) {
                console.log('Error:', resp);
            }
        });
    }
</script>