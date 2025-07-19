<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Picture;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PictureBox extends Component
{
    public $pictures;
    public $index = 0;

    public function mount()
    {
        $this->pictures = Picture::with('user')
            // ->where('user_id', '!=', auth()->id()) // Uncomment if you want to exclude own pictures
            ->orderByDesc('created_at')
            ->get()
            ->values();
    }

    public function like()
    {
        $picture = $this->pictures[$this->index] ?? null;
        if ($picture && Auth::check()) {
            Like::firstOrCreate([
                'user_id' => Auth::id(),
                'picture_id' => $picture->id,
            ]);
        }
        $this->next();
    }

    public function skip()
    {
        $this->next();
    }

    public function next()
    {
        $this->index++;
    }

    public function render()
    {
        $currentPicture = $this->pictures[$this->index] ?? null;
        return view('livewire.picture-box', compact('currentPicture'));
    }
}
