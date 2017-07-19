<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">
            Optional Information 
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        {{-- <div class="form-group {{ $errors->has('row_id') ? 'has-error' : '' }}">
            <label>Row ID</label>
            <input name="row_id" type="text" class="form-control" placeholder="Enter row_id" value="{{ isset($view) ? $view->row_id : old('row_id') }}">
            @if ($errors->has('row_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('row_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('row_class') ? 'has-error' : '' }}">
            <label>Row Class</label>
            <input name="row_class" type="text" class="form-control" placeholder="Enter row_class" value="{{ isset($view) ? $view->row_class : old('row_class') }}">
            @if ($errors->has('row_class'))
                <span class="help-block">
                    <strong>{{ $errors->first('row_class') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('item_class') ? 'has-error' : '' }}">
            <label>Item Class</label>
            <input name="item_class" type="text" class="form-control" placeholder="Enter item_class" value="{{ isset($view) ? $view->item_class : old('item_class') }}">
            @if ($errors->has('item_class'))
                <span class="help-block">
                    <strong>{{ $errors->first('item_class') }}</strong>
                </span>
            @endif
        </div>
 --}}
        <div class="form-group {{ $errors->has('paginate') ? 'has-error' : '' }}">
            <label>Limit</label>
            <input name="paginate" type="text" class="form-control" placeholder="Enter paginate" value="{{ isset($view) ? $view->paginate : old('paginate') }}">
            @if ($errors->has('paginate'))
                <span class="help-block">
                    <strong>{{ $errors->first('paginate') }}</strong>
                </span>
            @endif
        </div>
        
    </div>
</div>


