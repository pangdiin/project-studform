@extends('backend.layouts.app')

@section ('title', 'Product Management')

@section('page-header')
    <h1>
        Product Galleries
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">Upload product galleries</div>
            <div class="pane-body">
              <div class="box box-body">
                <form action="{{ route('admin.gallery.product.store', $product) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="product-gallery">
                  {{ csrf_field() }}
                  <div class="fallback">
                  <input name="file" type="file" multiple />
                </div>
                </form>

                <div class="form-group">
                  <button id="upload-product-gallery" class="btn btn-success pull-right btn-flat">Update Gallery</button></p>
                </div>

              </div>

            </div>
          </div>
        </div>
    </div>
@endsection

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('dropzone/dropzone.css') }}">

    <style type="text/css">
      .box {
        border-top: none;
        margin-bottom: 0;
      }
    </style>
@append
@php
  $galleries = $product->galleries()
    ->select(['id', 'path'])->get()
    ->each(function($item){ 
      return $item->photo = asset($item->fullPath); 
    });
@endphp
@section('after-scripts')
    <script type="text/javascript" src="{{ asset('dropzone/dropzone.js') }}"></script>

    <script type="text/javascript">

      	Dropzone.autoDiscover = false;

      	$(function() {
          var removeImages = [];
          var images = json_decode('{!! json_encode($galleries) !!}');
      		var myDropzone = new Dropzone('form#product-gallery',{
	          maxFiles:12,
	          acceptedFiles: 'image/*',
	          dictInvalidFileType: 'This form only accepts images.',
	          autoProcessQueue:false,
	          parallelUploads: 10,
            uploadMultiple: true,
	          addRemoveLinks: true,
            sendingmultiple: function(file, xhr, formData) {
                formData.append('removed', removeImages);
            }
	        });

          for (var i = images.length - 1; i >= 0; i--) {
            var image = images[i];

            var mockFile = { 
                name: image.id, 
                size: 12345, 
                status: Dropzone.COMPLETE, 
                url: image.photo 
            };
            // Call the default addedfile event handler
            myDropzone.emit("addedfile", mockFile);

            // And optionally show the thumbnail of the file:
            myDropzone.emit("thumbnail", mockFile, image.photo);
            myDropzone.files.push(mockFile);

          }

           myDropzone.on('removedfile', function(file){
            var id = file.name;
            removeImages.push(id);
          });

           myDropzone.on('successmultiple', function(files, response){
              swalSuccess("Successfully saved the images.", "reload");
          });


	        $('#upload-product-gallery').on('click',function(e){
             	e.preventDefault();
              
              if(myDropzone.getQueuedFiles().length > 0){
                  myDropzone.processQueue();
              }else{
                if(removeImages.length > 0){
                  var remove = removeImages;
                  $.ajax({
                    url: $('#product-gallery').attr('action'),
                    type: 'POST', 
                    dataType: 'json',
                    data: { removed: remove },
                    success: function(data){
                      console.log(data);
                      swalSuccess(data.message, "reload");
                    }, error: function(data){
                      console.log(data);
                      swal.close();
                    }
                  });

                }else{
                  swalError("You haven't changed anything at this point.");
                }

              }

        	});

      	});
    </script>
@endsection