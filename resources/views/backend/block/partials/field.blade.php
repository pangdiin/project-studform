<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">
            Block Information
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ isset($block) ? $block->name : old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
            <label>Position</label>
            {!! Form::select('position', config('base.position'), isset($block) ? $block->position : old('position'), ['class' => 'form-control', 'placeholder' => 'Enter Position']) !!}
            @if ($errors->has('position'))
                <span class="help-block">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="Enter description">{{ isset($block) ? $block->description : old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        
        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            <label>Content</label>
            <textarea name="content" class="form-control textarea ckeditor" placeholder="Enter content">{{ isset($block) ? $block->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>

        {{-- @if(isset($block))
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label class="control-label">Status</label>
                <label class="switch">
                    <input type="checkbox" name="status" value="active" @if($block->status == "active") checked @endif>
                    <div class="slider round"></div>
                </label>
                @if ($errors->has('status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        @endif --}}
    </div>
</div>

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/bootstrap-tagsinput.css') }}">
@append
@section('after-scripts')
    @include('includes.partials.ckeditor')
    <script type="text/javascript" src="{{ asset('js/plugin/bootstrap-tagsinput.min.js') }}"></script>
@append

