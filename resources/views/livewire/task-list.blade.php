<div class="text-slate-50">
    <div class="text-3xl font-bold p-2 mb-5">
        Daily Tasks
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <th scope="col" class="px-6 py-3">Complete</th>
                <th scope="col" class="px-6 py-3">Task Name</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </thead>
            @foreach ($tasks as $task)
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
                                <div class=" py-0.1 px-0.5 bg-yellow-300 rounded-md text-center text-slate-500">Pending
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="delete('{{ $task->id }}')" class="text-red-500">Delete</button>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>

    </div>
</div>
