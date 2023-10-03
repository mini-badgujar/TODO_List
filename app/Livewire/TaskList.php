<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use illuminate\Database\Eloquent\SoftDeletes;

class TaskList extends Component
{
    public $tasks, $status = false, $name;

    public function changeStatus($id)
    {
        $this->status =  !$this->status;
        Task::where('id', $id)->update(array('status' => $this->status));
    }
    public function add()
    {
        $Validateddata = $this->validate([
            'name' => 'required',
        ]);
        Task::create([
            'name' => $this->name,
        ]);
        session()->flash('message', 'Task added successfully');
        $this->name = null;
    }
    public function delete($id)
    {
        Task::where('id', $id)->delete();
        session()->flash('message', 'Task deleted successfully');
    }
    public function restore($id)
    {
        Task::where('id', $id)->restore();
        session()->flash('message', 'Task has been restored');
    }
    public function render()
    {
        $this->tasks = Task::withTrashed()->latest()->get();
        return view('livewire.task-list');
    }
}
