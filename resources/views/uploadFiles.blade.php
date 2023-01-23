@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/fileInput.css') }}">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <div class="card">
                <div class="card-header">Upload Files Ajax</div>
            </div>
        </div>

        <div class="row">
            <h1>Upload image with progressbar.</h1>
            <input type="hidden" name="resume_file_url" id="id_resume_file_url">
            <section>
                <div id="image_upload">
                    <form class="dropzone needsclick upload_penta"  action="{{ route('uploadFiles.store') }}">
                        <div class="dz-message needsclick">
                            <div class=" img-circle"> <i class="camera-img"><img src="{{ asset('img/photo-camera.svg') }}" alt=""></i>Add photo of slide.</div>
                        </div>

                    </form>
                </div>
            </section>
            <div id="preview-template" style="display: none;">
                <div class="dz-preview dz-file-preview">
                    <div class="dz-image"><img data-dz-thumbnail=""></div>
                    <div class="dz-details">
                        <div class="dz-filename"><span class="uploading">Uploading - </span><span data-dz-name=""></span></div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                    <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>


    </div>
</div>
@endsection
@section('scripts')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // access Dropzone here
            dropzone = new Dropzone('.upload_penta', {
                url: "{{ route('uploadFiles.store') }}",
                headers: {
                    'x-csrf-token': '{{csrf_token()}}',
                },
                maxFilesize: 4,
                addRemoveLinks: true,
                acceptedFiles: ".jpeg, .jpg, .png, .gif, .WebP, .svg",
                previewTemplate: document.querySelector('#preview-template').innerHTML,
                parallelUploads: 2,
                thumbnailHeight: 50,
                thumbnailWidth: 50,
                maxFilesize: 1,
                filesizeBase: 100000000000,
                success: function(file, response) {
                    file.previewElement.classList.add("image__open");
                },
                thumbnail: function(file, dataUrl) {
                    if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                    for (var i = 0; i < images.length; i++) {
                        var thumbnailElement = images[i];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.src = dataUrl;
                    }
                    setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 800);
                    }
                }
            });

            // Now fake the file upload, since GitHub does not handle file uploads
            // and returns a 404

            var minSteps = 6,
            maxSteps = 100,
            timeBetweenSteps = 300,
            bytesPerStep = 10000;

            dropzone.uploadFiles = function(files) {
                var self = this;

                for (var i = 0; i < files.length; i++) {

                    var file = files[i];
                    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                    for (var step = 0; step < totalSteps; step++) {
                        var duration = timeBetweenSteps * (step + 1);
                        setTimeout(function(file, totalSteps, step) {
                            return function() {
                            file.upload = {
                                progress: 100 * (step + 1) / totalSteps,
                                total: file.size,
                                bytesSent: (step + 1) * file.size / totalSteps
                            };

                            self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                            if (file.upload.progress == 100) {
                                file.status = Dropzone.SUCCESS;
                                self.emit("success", file, 'success', null);
                                self.emit("complete", file);
                                self.processQueue();
                            }
                            };
                        }(file, totalSteps, step), duration);
                    }
                }
            }
        });
    </script>

@endsection
