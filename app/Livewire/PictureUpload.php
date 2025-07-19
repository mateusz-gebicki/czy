<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Picture;

class PictureUpload extends Component
{
    use WithFileUploads;

    public $photo;

    protected $rules = [
        'photo' => 'required|image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->photo->store('pictures', 'public');

        Picture::create([
            'user_id' => auth()->id(),
            'path' => $path,
        ]);

        $this->reset('photo');
        session()->flash('message', 'Picture uploaded successfully!');
    }

    public function render()
    {
        $pictures = Picture::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.picture-upload', compact('pictures'));
    }
}
