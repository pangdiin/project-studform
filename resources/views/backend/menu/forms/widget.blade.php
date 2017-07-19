@if(count($widgets))
	@foreach($widgets as $w => $widget)
		<div class="panel box box-primary box-link-menus" data-type="{{ $w }}">
		  	<div class="box-header with-border">
		    	<h4 class="box-title">
		        	{{ strtoupper($w) }}
			    </h4>
		  	</div>
	    	<div class="box-body">
	    		{!! Form::select('menus[]', $widget->pluck('title', 'id')->toArray(), old('menus[]'), ['class' => 'form-control select-mutliple', 'multiple']) !!}
	    	</div>
			<div class="box-body">
				<button type="button" class="btn btn-success btn-block btn-flat add-item">
		            <i class="fa fa-plus"></i> Add Link
		        </button>
			</div>
		</div>
	@endforeach
@endif
@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/select2.min.css') }}">
@append
@section('after-scripts')
	<script type="text/javascript" src="{{ asset('js/plugin/select2.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
            $(".select-mutliple").select2();
		});
	</script>
@append