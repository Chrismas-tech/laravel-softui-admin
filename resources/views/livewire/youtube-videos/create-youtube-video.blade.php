<div class="p-3">
    <form>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="videoName">Youtube Video Name</label>
                    <input type="text" id="videoName" placeholder="Youtube Video name"
                        class="form-control @error('videoName') is-invalid @enderror" wire:model="videoName">
                    @error('videoName')
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
                        class="form-control @error('videoIframe') is-invalid @enderror" wire:model="videoIframe"></textarea>
                    @error('videoIframe')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button @if (!$isValid) disabled @endif type="button" class="btn btn-success"
                wire:click="createEntry" wire:loading.attr="disabled">
                <div wire:loading wire:target="createEntry" class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                {{ __('Create') }}
            </button>
        </div>
    </form>

</div>