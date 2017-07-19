@extends('backend.layouts.app')

@section ('title', 'Product Management')

@section('page-header')
    <h1>
        Product Brochure
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
          <div class="panel panel-default">
            <div class="panel-heading">Upload product brochure</div>
            <div class="pane-body">
              <div class="box box-body">
                <form action="{{ route('admin.product.brochure.store', $product) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="product-brochure">
                  {{ csrf_field() }}
                  <div class="fallback">
                  <input name="file" type="file" multiple />
                </div>
                </form>

                <div class="form-group">
                  <button id="upload-product-gallery" class="btn btn-success pull-right btn-flat">Update Brochure</button></p>
                </div>

              </div>

            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
              <th>Name</th>
              <th>View</th>
              <th>Action</th>
            </thead>
            <tbody>
              @forelse($product->brochures as $brochure)
              <tr>
                <td><p>{{ $brochure->path }}</p></td>
                <td><a href="{{ $brochure->full_path }}" target="_blank">View</a></td>
                <td><a href="{{ route('admin.product.brochure.destroy', $brochure->id) }}" class="btn btn-danger btn-flat btn-xs" ><i class="fa fa-remove"></i></a>
                </td>
              </tr>
              @empty
                
                <tr>
                  <td><h3>No brochure found</h3></td>
                </tr>

              @endforelse
            </tbody>
          </table>
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

@section('after-scripts')
    <script type="text/javascript" src="{{ asset('dropzone/dropzone.js') }}"></script>

    <script type="text/javascript">

      	Dropzone.autoDiscover = false;

      	$(function() {
      		var myDropzone = new Dropzone('form#product-brochure',{
	          maxFiles:10,
	          acceptedFiles: 'application/pdf',
	          dictInvalidFileType: 'This form only accepts pdf.',
	          autoProcessQueue:false,
	          parallelUploads: 10,
            uploadMultiple: true,
	          addRemoveLinks: true,
	        });

	        $('#upload-product-gallery').on('click',function(e){
             	e.preventDefault();
              myDropzone.processQueue();
              swalSuccess("Product brochure successfully updated", "reload");
        	});

      	});
    </script>
@endsection