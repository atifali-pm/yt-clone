<div>

    @if($channel->image)
        <img src="{{ asset('images/' . $channel->image) }}" alt="">
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form wire:submit.prevent="update">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control" wire:model="video.name">
                    </div>
                    @error('video.title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea cols="30" rows="4" class="form-control" wire:model="video.description"></textarea>
                    </div>
                    @error('video.description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="visiblity">Visiblity</label>
                        <select wire:model="video.visiblity" class="form-control">
                            <option value="private">Private</option>
                            <option value="public">Public</option>
                            <option value="unlisted">Unlisted</option>
                        </select>
                        <textarea cols="30" rows="4" class="form-control" </textarea>
                    </div>
                    @error('video.description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
