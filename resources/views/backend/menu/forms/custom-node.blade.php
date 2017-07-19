<div class="panel box box-success box-link-menus"
     data-type="custom-link">
    <div class="box-header with-border">
        <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#url-link-form" href="#custom-form">
                <i class="fa fa-link"></i> Custom Link
            </a>
        </h4>
    </div>
    <div id="custom-form" class="panel-collapse collapse">
        <div class="box-body">
            <div class="form-group">
                <label class="control-label">
                    <b>Title</b>
                    <span class="required">*</span>
                </label>
                {!! Form::text('title', old('title'), ['class' => 'form-control', 'autocomplete' => 'off', 'data-field' => 'title', 'placeholder' => '' ]) !!}
            </div>
            <div class="form-group">
                 <label class="control-label">
                    <b>Link</b>
                    <span class="required">*</span>
                </label>
                {!! Form::text('url', old('url'), ['class' => 'form-control', 'autocomplete' => 'off', 'data-field' => 'url', 'placeholder' => '' ]) !!}
            </div>
            {{-- <div class="form-group">
                 <label class="control-label">
                    <b>CSS Class</b>
                    <span class="required">*</span>
                </label>
                {!! Form::text('css', old('css'), ['class' => 'form-control', 'autocomplete' => 'off', 'data-field' => 'css', 'placeholder' => '' ]) !!}
            </div>
             <div class="form-group">
                 <label class="control-label">
                    <b>Icon </b>
                    <span class="required">*</span>
                </label>
                {!! Form::text('icon', old('icon'), ['class' => 'form-control', 'autocomplete' => 'off', 'data-field' => 'icon', 'placeholder' => '' ]) !!}
            </div>
            <div class="form-group">
                 <label class="control-label">
                    <b>Target</b>
                    <span class="required">*</span>
                </label>
                {!! Form::select('target', 
                    ['Not set', 'Self', 'Blank', 'Parent', 'Top'], old('target'), 
                    ['class' => 'form-control', 'data-field' => 'target', 'autocomplete' => 'off', 'data-field' => 'target' ]) !!}
            </div> --}}
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-success btn-block btn-flat add-item">
                <i class="fa fa-plus"></i> Add Link
            </button>
        </div>
    </div>
</div>