<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class TotalLikesRanking extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::withCount('receivedLikes')
            ->orderByDesc('received_likes_count')
            ->get();
    }

    public function render()
    {
        return view('livewire.total-likes-ranking');
    }
}
