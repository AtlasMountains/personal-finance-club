<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Transactions extends Component
{
    public $types = ['type 1', 'type 2'];
    public $tags = ['tag 1', 'tag 2'];
    public $categories = ['category 1', 'category 2'];

    public function render()
    {
        return view('livewire.transactions');
    }

    public function createTransaction()
    {
        # code...
    }
}
