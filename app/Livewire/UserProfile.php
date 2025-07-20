<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserProfile extends Component
{
    public User $user;
    public $modalImage = null;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user-profile');
    }

    public function openModal($imagePath)
    {
        $this->modalImage = $imagePath;
    }

    public function closeModal()
    {
        $this->modalImage = null;
    }

}
