@if(config('base.slide.title'))
<div class="form-group">
    <label>Title</label>
    <input name="title" type="text" class="form-control" placeholder="Enter name" value="{{ isset($slide) ? $slide->title : '' }}">
    <span class="help-block"></span>
</div>
@endif
@if(config('base.slide.description'))
<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control" placeholder="Enter description">{{ isset($slide) ? $slide->description : '' }}</textarea>
    <span class="help-block"></span>
</div>
@endif

<div class="form-group">
    <label>Image :</label>
    <div id="dropzone" class="dropzone text-center">
        <div class="default-dz-message dz-message">
            <div id="image-default" class="text-center">
                @if(isset($slide) && $slide->path)
                    <img src="{{ $slide->image }}" class="img-thumbnail img-responsive" style="max-height: 100%; width: auto">
                @else
                    <div class="dropzone-icon"><i class="fa fa-5x fa-image"></i></div>
                    <span>Drop images here or click to select images.</span>
                @endif
            </div>
        </div>
    </div>
    <span class="help-block"></span>
</div>

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/dropzone.min.css') }}">
@append


@section('after-scripts')
    <script type="text/javascript" src="{{ asset('js/plugin/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzone = new Dropzone('#dropzone', {
            url: "{{ isset($slide) ? route('admin.slide.update', $slide->id) : route('admin.slide.store') }}",
            autoProcessQueue: false,
            type: 'POST',
            paramName: "image", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 2, // MB
            uploadMultiple: false,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            init: function() {
                var myDropzone = this;
                this.on("addedfile", function(file) {
                    if(this.files[1] != null) {
                        this.removeFile(this.files[0]);
                    }
                    @unless(isset($slide))
                    $('#dropzone').css('height', 'auto');
                    $('#dropzone').css('padding-top', '0');
                    @endif
                    $('#image-default').hide();
                });
                this.on("removedfile", function(file) {
                    $('#image-default').show();
                    @unless(isset($slide))
                    $('#dropzone').css('height', '240px');
                    $('#dropzone').css('padding-top', '60px');
                    @endif
                });

                $('a[name=btn_submit]').click(function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    swalLoader();
                    if(myDropzone.getQueuedFiles().length > 0){
                        myDropzone.processQueue();
                    }else{
                        @if(isset($slide))
                            reload();
                            $('#slide-form').submit();
                        @else
                            swalError('Image is required.');
                        @endif
                    }
                });
                this.on("success", function(files, response) {
                    swalSuccess(response.message);
                });


                this.on("error", function(files, response) {
                    if(response.status == 422){
                    }else{
                        swalError(response.message);
                    }
                });

                this.on("sending", function(file, xhr, formData) {
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    @if(isset($slide)) formData.append("_method", 'PATCH'); @endif
                    @if(config('base.slide.title'))
                    formData.append('title',        $('[name=title]').val());
                    @endif
                    {{-- @if(config('base.slide.description')) --}}
                    formData.append('description',  $('[name=description]').val());
                    {{-- @endif --}}
                });

                // this.on("error", function(files, response) {
                //     danger(response);
                //     location.reload();
                // });
                
            },
            error: function(file, response) {
                if($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = 'There was an error that occured';

                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }   
        });
    </script>
@append