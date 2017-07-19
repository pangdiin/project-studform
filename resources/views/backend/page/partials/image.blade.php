<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">
			Images
		</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
	</div>
	<div class="box-body">
	    <label>Cover Image</label>
		<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
	        <div class="fileinput fileinput-new" data-provides="fileinput">
	            <div class="fileinput-new thumbnail" >
	                <img  src={{ isset($page) && $page->image ? asset($page->image) : asset('img/no-image.png') }}>
	            </div>
	            <div class="fileinput-preview fileinput-exists thumbnail" ></div>
	            <div class="text-center">
	                <span class="btn btn-primary btn-flat btn-file text-center">
		                <span class="fileinput-new">Select Page Image</span>
		                <span class="fileinput-exists">Change</span>
		                <input type="file" name="image">
                    </span>
	                <a href="#" class="btn btn-flat btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
	            </div>
	            @if ($errors->has('image'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('image') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>

	    <label>Thumbnail</label>
	    <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
	        <div class="fileinput fileinput-new" data-provides="fileinput">
	            <div class="fileinput-new thumbnail" >
	                <img  src={{ isset($page) && $page->thumbnail ? asset($page->thumbnail) : asset('img/no-image.png') }}>
	            </div>
	            <div class="fileinput-preview fileinput-exists thumbnail" ></div>
	            <div class="text-center">
	                <span class="btn btn-primary btn-flat btn-file text-center">
		                <span class="fileinput-new">Select Page Image</span>
		                <span class="fileinput-exists">Change</span>
		                <input type="file" name="thumbnail">
                    </span>
	                <a href="#" class="btn btn-flat btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i></a>
	            </div>
	            @if ($errors->has('thumbnail'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('thumbnail') }}</strong>
	                </span>
	            @endif
	        </div>
	    </div>
	</div>
</div>

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