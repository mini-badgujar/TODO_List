<div class="text-slate-50">
    <div>
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                <span class="font-bold text-lg border-r px-2 border-green-500">Success </span> <span
                    class="px-3">{{ session('message') }}</span>

                {{-- <button x-on:click="open=false"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button> --}}
            </div>
        @endif
        <div class="flex space-x-2 items-center ">
            <div class="text-3xl font-bold p-2 mb-5">
                Daily Tasks
            </div>
            <div class="w-3/4 mb-3" x-data="{ open: false, display: true }">
                {{-- <button x-on:click="open= true; display = false" x-show="display"
                    class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Add
                    new task</button>
                <div class="relative" x-show="open">
                    <input wire:model="name" type="text"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Enter task name here...">
                    <button wire:click="add()" x-on:click="open= false; display = true"
                        class="absolute top-0 right-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        Task</button>

                </div> --}}
                <div class="relative">
                    <form wire:submit.prevent="add">
                        <input type="text" name="name"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Enter task name here..." wire:model="name">
                        <button type="submit"
                            class="absolute top-0 right-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                            Task</button>
                    </form>

                </div>
                @error('name')
                    <span class="text-sm text-red-500 ">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <th scope="col" class="px-6 py-3">Complete</th>
                <th scope="col" class="px-6 py-3">Task Name</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </thead>
            @foreach ($tasks as $task)
                @if (!$task->trashed())
                    <tbody class=" text-sm">
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                @if ($task->status)
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" name="status" checked
                                            wire:click="changeStatus('{{ $task->id }}')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" name="status"
                                            wire:click="changeStatus('{{ $task->id }}')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                @endif

                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($task->status)
                                    <div class="line-through text-slate-400">{{ $task->name }}</div>
                                @else
                                    <div>{{ $task->name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($task->status)
                                    <div class="py-0.1 bg-green-200 rounded-md text-center text-slate-500">
                                        Done
                                    </div>
                                @else
                                    <div class=" py-0.1 px-0.5 bg-yellow-300 rounded-md text-center text-slate-500">
                                        Pending
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="delete('{{ $task->id }}')"><span
                                        class="material-symbols-rounded text-red-500">
                                        delete
                                    </span></button>
                            </td>
                        </tr>
                    </tbody>
                @endif
            @endforeach
        </table>

    </div>

    <div class="text-3xl font-bold p-2 mb-5"> Deleted Tasks</div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            @foreach ($tasks as $task)
                @if ($task->trashed())
                    <tbody class=" text-sm">
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($task->status)
                                    <div class="line-through text-slate-400">{{ $task->name }}</div>
                                @else
                                    <div>{{ $task->name }}</div>
                                @endif
                            </td>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @if ($task->status)
                                    <div class="py-0.1 bg-green-100 rounded-md text-center text-slate-500">
                                        Done and deleted
                                    </div>
                                @else
                                    <div class=" py-0.1 px-0.5 bg-yellow-100 rounded-md text-center text-slate-500">
                                        Pending but deleted
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="restore('{{ $task->id }}')" class="text-red-500">Undo
                                    Delete</button>
                            </td>
                        </tr>
                    </tbody>
                @endif
            @endforeach
        </table>

    </div>
</div>
