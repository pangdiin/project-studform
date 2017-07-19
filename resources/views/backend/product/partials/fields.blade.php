<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Product Information</h3>

        <div class="box-tools pull-right">
        </div><!--box-tools pull-right-->
    </div><!-- /.box-header -->

    <div class="box-body">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label>Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ isset($product) ? $product->name : old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : '' }}">
            <label>{{ config('tag.type.brand.name') }}</label>
            <select class="form-control" name="brand_id" id="select-brand"  >
              <option selected disabled="" value="" >Select {{ config('tag.type.brand.name') }}</option>
                @foreach($tags as $t => $tag)
                    <option 
                        {{ (isset($product) && $product->brand_id == $tag->id) ? 'selected' : '' }} 
                        data-image="{{ asset($tag->image) }}" 
                        value="{{ $tag->id }}"
                    >
                        {{ $tag->name }} 
                    </option>
                @endforeach
            </select>
            @if ($errors->has('brand_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('brand_id') }}</strong>
                </span>
            @endif
         </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="Enter description">{{ isset($product) ? $product->description : old('description') }}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
            <label>Content</label>
            <textarea name="content" class="form-control textarea ckeditor" placeholder="Enter content">{{ isset($product) ? $product->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('specification') ? 'has-error' : '' }}">
            <label>Specification</label>
            <textarea name="specification" class="form-control textarea ckeditor" placeholder="Enter specification">{{ isset($product) ? $product->specification : old('specification') }}</textarea>
            @if ($errors->has('specification'))
                <span class="help-block">
                    <strong>{{ $errors->first('specification') }}</strong>
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
    <script type="text/javascript">
    $(document).ready(function() {
        $('#select-brand').select2({
          templateResult: withProfileImage,
          templateSelection: withProfileImage
        });
    });
    </script>
@append