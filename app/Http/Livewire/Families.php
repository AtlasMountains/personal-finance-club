<?php

namespace App\Http\Livewire;

use App\Models\Family;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Families extends Component
{
    public ?Family $family;

    public function mount(): void
    {
        $this->family = auth()->user()->family;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.families');
    }

    public function joinFamily()
    {
    }

    public function leaveFamily()
    {
    }

    public function addMember()
    {
    }

    public function editFamily()
    {
    }
}
