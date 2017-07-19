@extends ('backend.layouts.app')

@section ('title', 'Taxonomy ' . $type['name'] . ' Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ $type['name'] }}
        <small>Update</small>
    </h1>
@endsection

@section('content')
	<div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Tag</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">
					{!! Form::open(['url' => route('admin.tag.update', [$type['route'], $tag]), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'tag-form', 'method' => 'PATCH' ]) !!}
	                    @include('backend.tag.partials.forms.fields', ['process' => 'update'])
	                    <div class="form-group clearfix">
	                    	<a class="btn btn-flat btn-warning" href="{{ route('admin.tag.index', $type['route']) }}">Cancel</a>
	                    	{!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-flat pull-right', 'id' => 'btn_submit']) !!}
	                    </div>
				    {!! Form::close() !!}
                </div>  
            </div>
        </div>
    </div>
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderEntity('Tag', $tag->id) !!}
        </div><!-- /.box-body -->
    </div>
@endsection


@section('after-scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btn_submit').click(function(){
				swalLoader();
			});
		});
	</script>
@append