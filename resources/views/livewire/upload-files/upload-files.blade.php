<div>
    <h4 class="mb-2">Upload multiple files to the server</h4>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Specifications</strong></li>
        <li class="list-group-item">Number of files per upload : {{ $NbFiles }}</li>
        <li class="list-group-item">Limit of size per file : {{ $limitSizePerFile }} {{ $unit }}</li>
        <li class="list-group-item">Extension allowed : {{ str_replace(',', ', ', $extensionsString) }}</li>
    </ul>

    <div x-data="fileUpload()">
        <div @drop.prevent="isDropping = false; handleFileDrop($event)" @dragover.prevent="isDropping = true"
            @dragleave.prevent="isDropping = false">

            <div class="relative">

                <!-- Release Files -->
                <div x-cloak x-show="isDropping" class="absolute release-files bg-success">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-3xl text-white">Release file to upload</div>
                    </div>
                </div>
                <!-- Release Files -->

                <label class="m-0 w-100" for="files-upload">
                    <div class="card-body text-center select-files-upload">
                        <h5 class="mb-0">Select your files</h5>
                        <span>(or drag them here)</span>
                    </div>
                    <input class="d-none" wire:model="files" @change="handleFileSelect" type="file" id="files-upload"
                        class="form-control" multiple accept="{{ $acceptString }}">

                    <!-- ProgressBar -->
                    <div x-cloak x-show="isUploading" class="progress-wrapper mt-3">
                        <div class="progress-info">
                            <div class="progress-percentage">
                                <span class="text-sm font-weight-bold"></span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuemin="0"
                                aria-valuemax="100" :style="`width: ${progress}%;`"></div>
                        </div>
                    </div>
                    <!-- ProgressBar -->
                </label>
            </div>
        </div>

        <div class="mt-1">
            @error('files')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-1">
            @error('files.*')
                <span class="text-danger text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if (count($files))
            <ul class="mt-3">
                @foreach ($files as $file)
                    <li class="list-unstyled">
                        - <i class="fa-regular fa-file-lines"></i>
                        <span> {{ $file->getClientOriginalName() }}</span>
                        <i class="ms-3 fa-solid fa-xmark text-danger cancel-upload-files"
                            wire:click="removeUpload('{{ $file->getFilename() }}')"></i>
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="d-flex justify-content-center">
            <button {{ $isValid && count($files) ? '' : 'disabled' }} type="submit" wire:click="upload"
                class="btn btn-primary mt-2">Upload</button>
        </div>
    </div>

    <script>
        function fileUpload() {
            return {
                isDropping: false,
                isUploading: false,
                progress: 0,
                handleFileSelect(event) {
                    if (event.target.files.length) {
                        this.uploadFiles(event.target.files)
                    }
                },
                handleFileDrop(event) {
                    if (event.dataTransfer.files.length > 0) {
                        this.uploadFiles(event.dataTransfer.files)
                    }
                },
                uploadFiles(files) {
                    const $this = this
                    this.isUploading = true
                    @this.uploadMultiple('files', files,
                        function(success) { //upload was a success and was finished
                            $this.isUploading = false
                            $this.progress = 0
                        },
                        function(error) { //an error occured
                            console.log('error', error)
                        },
                        function(event) { //upload progress was made
                            $this.progress = event.detail.progress;
                            document.querySelector('.progress-percentage span').innerHTML = event.detail.progress +
                                ' %';
                        }
                    )
                }
            }
        }
    </script>
</div>
