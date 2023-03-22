
<div>
    <form wire:submit.prevent>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="name">Youtube Video Name</label>
                    <input type="text" id="name" placeholder="Youtube Video name"
                        class="form-control @error('name') is-invalid @enderror" wire:model="name" wire:keydown.enter="submit">
                    @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="iframe">Iframe Video</label>
                    <textarea rows="5" id="iframe"
                        placeholder="&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/cvqGnIEmOyM&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in- picture; web-share&quot; allowfullscreen&gt;&lt;/iframe&gt;"
                        class="form-control @error('iframe') is-invalid @enderror" wire:model="iframe" wire:keydown.enter="submit"></textarea>
                    @error('iframe')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button @if (!$isValidCreation) disabled @endif type="button" class="btn btn-success"
                wire:click="submit" wire:loading.attr="disabled">
                <div wire:loading wire:target="submit" class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Create') }}
            </button>
        </div>
    </form>

</div>
