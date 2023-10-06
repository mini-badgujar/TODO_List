<div class="text-slate-50">
    <div>

        @if (session()->has('message'))
            <div class="p-2 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">
                <span class="font-bold text-lg border-r px-2 border-green-500">Success </span> <span
                    class="px-3">{{ session('message') }}</span>


            </div>
        @endif
        <div class="flex space-x-2 justify-between items-center ">
            <div class="text-3xl font-bold p-2 mb-5">
                Daily Tasks
            </div>
            <div class="w-3/4 mb-3" x-data="{ open: false, display: true }">

                <div class="relative">
                    <form wire:submit="add">
                        <input type="text" name="name" id="name"
                            class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            placeholder="Enter task name here..." wire:model="name">

                        <button
                            class="absolute top-0 right-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                            Task</button>
                    </form>

                </div>
                @error('name')
                    <span class="text-sm text-red-500 pl-3">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <th scope="col" class="px-6 py-3">Complete</th>
                <th scope="col" class="px-6 py-3">Task Name</th>
                <th scope="col" class="px-6 py-3 text-center">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
            </thead>
            @foreach ($tasks as $task)
                @if (!$task->trashed())
                    <tbody class=" text-sm" wire:key="{{ $task->id }}">
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                @if ($task->status)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="status" checked
                                            wire:click="changeStatus('{{ $task->id }}')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox" class="sr-only">checkbox</label>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <input type="checkbox" name="status"
                                            wire:click="changeStatus('{{ $task->id }}')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox" class="sr-only">checkbox</label>
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
                            <td class="px-6 py-4 text-center">
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
                            <td class="px-6 py-4 text-center">
                                <button wire:click="drop('{{ $task->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em"
                                        viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            svg {
                                                fill: #d30000
                                            }
                                        </style>
                                        <path
                                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                    </svg>
                                </button>
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
                    <tbody class=" text-sm" wire:key="{{ $task->id }}">
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
                                    <div class="px-0.5 py-0.1 bg-green-100 rounded-md text-center text-slate-500">
                                        Done and deleted
                                    </div>
                                @else
                                    <div class="px-0.5 py-0.1 bg-yellow-100 rounded-md text-center text-slate-500">
                                        Pending but deleted
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="restore('{{ $task->id }}')" class="text-red-500">Undo</button>
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="delete('{{ $task->id }}')" class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1.25em"
                                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            svg {
                                                fill: #b10000
                                            }
                                        </style>
                                        <path
                                            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                @endif
            @endforeach
        </table>

    </div>
</div>
