<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

class WeeklyLikesRanking extends Component
{
    public $users;

    public function mount()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $this->users = User::withCount(['receivedLikes' => function ($query) use ($startOfWeek) {
            $query->where('likes.created_at', '>=', $startOfWeek);
        }])
            ->orderByDesc('received_likes_count')
            ->get();
    }

    public function render()
    {
        return view('livewire.weekly-likes-ranking', [
            'users' => $this->users
        ]);
    }
}
