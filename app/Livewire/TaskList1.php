<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList1 extends Component
{


    public $tasks, $trashTasks, $task, $Status = [], $name, $softDelete = [], $sofDeleteAll = false, $permanentDelete = [];

    // these are rules for user input validation
    protected $rules = [
        'name' => 'required'
    ];

    public function mount()
    {
        $this->Status = Task::where('status', 1)->pluck('id')->toArray();
        $this->softDelete = Task::onlyTrashed()->pluck('id')->toArray();
    }

    /**
     * function to toggle the status of the task to done or pending
     ** @param $id is id of task  */
    public function change(int $id)
    {
        $key = array_search($id, $this->Status);
        if ($key === false) {
            // If $id is not present, add it to the array
            $this->Status[] = $id;
        } else {
            // If $id is present, remove it from the array
            unset($this->Status[$key]);
        }
    }

    /**
     * function to add new task to task table
     * */
    public function add()
    {
        $this->validate();    //validation of inputs through rules
        // adding validated data to database
        Task::create([
            'name' => $this->name,
        ]);
        $this->reset('name');  //resetting the values of input box ie. emptying the input box
        session()->flash('success', 'Task added successfully');
        // $this->tasks = Task::withTrashed()->latest()->get();
    }

    /**Restore the soft deleted tasks */
    public function restore($id)
    {
        $key = array_search($id, $this->softDelete);
        if ($key === false) {
            // If $id is not present, add it to the array
            $this->softDelete[] = $id;
        } else {
            // If $id is present, remove it from the array
            unset($this->softDelete[$key]);
        }
    }

    public function save()
    {
        Task::whereIn('id', $this->softDelete)->delete();
        Task::whereNotIn('id', $this->softDelete)->restore();
        Task::whereIn('id', $this->permanentDelete)->forceDelete();
        Task::whereIn('id', $this->Status)->update(['status' => '1']);
        Task::whereNotIn('id', $this->Status)->update(['status' => '0']);
        session()->flash('success', 'Task updated successfully');
    }

    public function render()
    {
        $this->tasks = Task::withTrashed()->latest()->get();
        $this->trashTasks = Task::onlyTrashed()->get();
        return view('livewire.task-list1');
    }
}
