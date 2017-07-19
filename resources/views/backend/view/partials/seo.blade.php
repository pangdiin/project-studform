<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">
			Seo Information

		</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
	</div>
	<div class="box-body">
        <div class="form-group {{ $errors->has('seo') ? 'has-error' : '' }}">
            <label>SEO Key words</label>
            <input name="seo" type="text" class="form-control" placeholder="Enter keywords for this view" value="{{ isset($view) ? $view->seo : '' }}" data-role="tagsinput" >
            @if ($errors->has('seo'))
                <span class="help-block">
                    <strong>{{ $errors->first('seo') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('meta') ? 'has-error' : '' }}">
            <label>Meta Description</label>
            <textarea name="meta" class="form-control" placeholder="Enter meta description">{{ isset($view) ? $view->meta : old('') }}</textarea>
            @if ($errors->has('meta'))
                <span class="help-block">
                    <strong>{{ $errors->first('meta') }}</strong>
                </span>
            @endif
        </div>
        
	</div>
</div>

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/bootstrap-tagsinput.css') }}">
@append
@section('after-scripts')
    @include('includes.partials.ckeditor')
    <script type="text/javascript" src="{{ asset('js/plugin/bootstrap-tagsinput.min.js') }}"></script>
@append
