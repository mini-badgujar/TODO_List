<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{

    public $tasks, $status, $name;

    // these are rules for user input validation
    protected $rules = [
        'name' => 'required'
    ];

    /**
     * function to toggle the status of the task to done or pending
     ** @param $id is id of task  */
    public function changeStatus($id)
    {
        $this->status = Task::find($id);       //Getting current status of task with $id
        $status = !$this->status->status;      //toggling the status of task
        Task::where('id', $id)->update(array('status' => $status));   //updating new status on database
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
        session()->flash('message', 'Task added successfully');   //! alert when a task is added

        //// $this->resetErrorBag("name");
        //// $this->name = "";
        //// $this->js('document.getElementById("name").value="";');
    }

    /**temporarily delete the task ie. soft delete */
    public function drop($id)
    {
        Task::where('id', $id)->delete();
    }

    /**Restore the soft deleted tasks */
    public function restore($id)
    {
        Task::where('id', $id)->restore();
    }

    /**permanently delete the task to delete from database */
    public function delete($id)
    {
        Task::where('id', $id)->forceDelete();
    }

    public function render()
    {
        $this->tasks = Task::withTrashed()->latest()->get();
        return view('livewire.task-list');
    }
}