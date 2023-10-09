<div class="text-slate-50">
    <div>

        <div class="h-10 mb-2">
            @if (session()->has('success'))
                <div class="p-2 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"> <span
                        class="font-bold text-lg border-r px-2 border-green-500">Success </span>
                    <span class="px-3">{{ session('success') }}</span>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="p-2 mb-4 text-sm text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-bold text-lg border-r px-2 border-red-500">ERROR </span>
                    <span class="px-3">{{ session('error') }}</span>
                </div>
            @endif
        </div>
        <div class="flex space-x-2 justify-between items-center">
            <div class="text-3xl font-bold p-2 mb-5">
                Daily Tasks
            </div>
            <div class="w-1/2 mb-3" x-data="{ open: false, display: true }">

                <div class="relative">
                    <input type="text" name="name" id="name"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-l-gray-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                        placeholder="Enter task name here..." wire:model="name">

                    <button wire:click="add(); $refresh"
                        class="absolute top-0 right-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Add Task
                    </button>

                </div>

                @error('name')
                    <span class="text-sm text-red-500 pl-3">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button wire:click="save(); $refresh"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Save changes </button>
            </div>
        </div>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <th scope="col" class="px-6 py-3">Complete</th>
                <th scope="col" class="px-6 py-3">Task Name</th>
                <th scope="col" class="px-6 py-3 text-center">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Remove Task</th>
            </thead>
            @foreach ($tasks as $task)
                @if (!$task->trashed())
                    <tbody class=" text-sm " wire:key="{{ $task->id }}">
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4 pl-10">
                                @if ($task->status)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="status" checked
                                            wire:click="change('{{ $task->id }}')"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="checkbox" class="sr-only">checkbox</label>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <input type="checkbox" name="status" wire:click="change('{{ $task->id }}')"
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
                            <td class="px-6 py-4  ">
                                <div class="flex items-center justify-center ">
                                    <input type="checkbox" wire:model="softDelete" value='{{ $task->id }}'
                                        class=" w-4 h-4 accent-orange-400/10">
                                </div>
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
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <th scope="col" class="px-6 py-3">Task Name</th>
                <th scope="col" class="px-6 py-3 text-center">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Undo</th>
                <th scope="col" class="px-6 py-3 text-center">Delete </th>
            </thead>
            @foreach ($trashTasks as $task)
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
                            <div class="flex items-center justify-center">
                                <input type="checkbox" name="restore" wire:click="restore('{{ $task->id }}')"
                                    class="w-4 h-4 accent-green-400">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center ">
                                <input type="checkbox" wire:model="permanentDelete" value='{{ $task->id }}'
                                    class="w-4 h-4 accent-red-500/10">
                            </div>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>

    </div>
</div>
