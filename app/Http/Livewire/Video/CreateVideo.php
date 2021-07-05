<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{
    use WithFileUploads;

    public    $channel;
    public    $video;
    public    $videoFile;
    protected $rules
        = [
            'videoFile' => 'required|mimes:mp4|max:1228800',
        ];

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.create-video')
            ->extends('layouts.app');
    }

    public function fileCompleted()
    {
        // validation
        $this->validate();

        $this->video = $this->channel->videos()->create(
            [
                'title' => 'untitled',
                'description' => 'none',
                'uid' => uniqid(true),
                'visiblity' => 'private',

            ]);

        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video,
        ]);

    }


}
