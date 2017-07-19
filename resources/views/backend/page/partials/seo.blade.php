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
		<div class="form-group">
            <label>SEO Key words</label>
            <input name="seo" type="text" class="form-control" placeholder="Enter keywords for this page" value="{{ isset($page) ? $page->seo : '' }}" data-role="tagsinput" >
            <span class="help-block"></span>
        </div>

        <div class="form-group">
            <label>Meta Description</label>
            <textarea name="meta" class="form-control" placeholder="Enter meta description">{{ isset($page) ? $page->meta : '' }}</textarea>
            <span class="help-block"></span>
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
