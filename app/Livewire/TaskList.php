<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use illuminate\Database\Eloquent\SoftDeletes;

class TaskList extends Component
{
    public $tasks, $status = false;

    public function changeStatus($id)
    {
        $this->status =  !$this->status;
        Task::where('id', $id)->update(array('status' => $this->status));
    }
    public function delete($id)
    {
        Task::where('id', $id)->delete();
    }
    public function render()
    {
        $this->tasks = Task::all();
        return view('livewire.task-list');
    }
}
