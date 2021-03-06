<?php

namespace App\Http\Livewire\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
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

        $path = explode('/', $this->videoFile->store('videos-temp'))[1];

        $this->video = $this->channel->videos()->create(
            [
                'title' => 'untitled',
                'description' => 'none',
                'uid' => uniqid(true),
                'visibility' => 'private',
                'path' => $path
            ]);

        // Dispatch jobs
        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);

        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video,
        ]);

    }


}
