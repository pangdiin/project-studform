<div class="form-group">
  	<label>Name</label>
  	<input name="name" type="text" class="form-control" placeholder="Enter name" @if(isset($tag)) value="{{ $tag->name }}" @endif>
  	<span class="help-block"></span>
</div>
@if($type['description'])
	<div class="form-group">
	  	<label>Description</label>
	  	<textarea name="description" class="form-control" placeholder="Enter Description" >@if(isset($tag)) {{ $tag->description }} @endif</textarea>
	  	<span class="help-block"></span>
	</div>
@endif	

@if($type['image'])
	<div class="form-group">
	  	<label>Image</label>
	    <div class="form-group">
	        <div class="fileinput fileinput-new" data-provides="fileinput">
	            <div class="fileinput-new thumbnail" >
	                <img src={{ (isset($tag) && file_exists($tag->image)) ? asset($tag->image) : asset('img/no-image.png') }}>
	            </div>
	            <div class="fileinput-preview fileinput-exists thumbnail" ></div>
	            <div class="text-center">
	                <span class="btn btn-primary btn-flat btn-file text-center">
		                <span class="fileinput-new">Select</span>
		                <span class="fileinput-exists">Change</span>
		                <input id="image" type="file" name="image">
                    </span>
	                <a href="#" class="btn btn-flat btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
	            </div>
                <span class="help-block"></span>
	        </div>
	    </div>
	</div>
@endif	

@section('after-styles')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.css">
	<style type="text/css">
		.fileinput-new.thumbnail, .thumbnail.fileinput-exists, .fileinput{
			max-height: 200px;
			width: 100%;
		}
	</style>
@append
@section('after-scripts')
	<script type="text/javascript" src="{{ asset('js/plugin/jasny-bootstrap.min.js') }}"></script>
@append