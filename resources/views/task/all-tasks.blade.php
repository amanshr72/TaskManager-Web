<x-app-layout>

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
                        <input type="text" id="search-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required="">
                    </div>
                </form>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <select id="status" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                       <option value="" disabled selected>Select Status</option>
                       <option value="Unassigned">Unassigned</option>
                       <option value="Assigned">Assigned</option>
                       <option value="In Process">In Process</option>
                       <option value="Pending">Pending</option>
                    </select>
                </div>
                <button type="button" id="taskCreateModal-1Button" data-modal-target="taskCreateModal-1" data-modal-toggle="taskCreateModal-1" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Add Task
                </button>
                @include('task.create')
                <button id="resstFilterBtn" data-tooltip-target="reset-filter" class="focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    <span class="material-symbols-outlined">filter_alt_off</span>
                    <div id="reset-filter" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Reset Filter
                    </div>
                </button>
            </div>
        </div>

        <section id="dashboard-task-list">
            @include('task.dashboard-task-list')
        </section>
         
        <div class="justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
            {{ $tasks->links() }}
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Search, Filter & Countdown Script -->
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/filter.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('categorySelected', function (event) {
                var categoryId = event.detail.categoryId;
                updateDashboardCategorySelect(categoryId);
            });

            function updateDashboardCategorySelect(categoryId) {
                var dashboardCategorySelect = document.getElementById('category');
                for (var i = 0; i < dashboardCategorySelect.options.length; i++) {
                    if (dashboardCategorySelect.options[i].value == categoryId) {
                        dashboardCategorySelect.options[i].selected = true;
                        break;
                    }
                }
            }
        });
    </script>

</x-app-layout>
