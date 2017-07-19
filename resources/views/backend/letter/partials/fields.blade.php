<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Product Information</h3>

        <div class="box-tools pull-right">
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ isset($letter) ? $letter->name : old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            <label>Content</label>
            <textarea name="content" class="form-control textarea ckeditor" placeholder="Enter content">{{ isset($letter) ? $letter->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>

      
    </div>
</div><!--box-->
@section('after-styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/select2.min.css') }}">
@append
@section('after-scripts')
    @include('includes.partials.ckeditor')
    <script type="text/javascript" src="{{ asset('js/plugin/select2.min.js') }}"></script>
@append