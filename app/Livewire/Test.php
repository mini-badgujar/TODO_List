<?php

namespace App\Livewire;

use App\Models\Test_model;
use Livewire\Component;

class Test extends Component
{
    public $name;
    public $records;

    protected $rules = [
        'name' => 'required',
    ];
    public function addRecord()
    {
        $data = $this->validate();
        Test_model::create($data);
        $this->reset(['name']);
    }
    public function render()
    {
        $this->records = Test_model::get();

        return view('livewire.test');
    }
}
