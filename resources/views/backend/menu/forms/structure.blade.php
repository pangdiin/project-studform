<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            Menu Structure
        </h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <div class="dd nestable-menu"></div>
        </div>
    </div>
    <div class="box-footer">
        <div class="clearfix">
            <div class="pull-right">
                <a name="btn_save" class='btn btn-flat btn-success'><i class="fa fa-save"></i> Save</a>
            </div>
        </div>
    </div>
</div>
@section('after-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/nested.css') }}">
@append
@section('after-scripts')
    @include('backend.menu.forms.components.js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#menu-form').menuStructure({
                nodes: {!! isset($nodes) ? $nodes : '[]' !!},
                maxDepth: {{ $menu->depth }}
            });
        });
    </script>
@append