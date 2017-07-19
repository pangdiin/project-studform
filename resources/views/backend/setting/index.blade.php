@extends('backend.layouts.app')
@section ('title', 'Settings')


@section('page-header')
    <h1>
        <i class="fa fa-cogs"></i> Settings
    </h1>
@endsection

@section('content')
	<div class="row">
		@forelse($groups as $g => $group)
			<div class="col-sm-6">
				<div class="box box-success">
			    	<div class="box-header">
			    		<h3 class="box-title">
			    			{{ $group['name'] }}
			    		</h3>
			    	</div>
			        <div class="box-body">
			    		{{ $group['description'] }}
			        </div>
			        <div class="box-footer">
			        	<div class="clearfix">
			        		<div class="pull-right">
			        			<a href="{{ route('admin.setting.show', $g) }}" class="btn btn-flat btn-primary"><i class="fa fa-cog"></i> Configure</a>
			        		</div>
			        	</div>
			        </div>
			    </div>
			</div>
		@empty

		@endif
	</div>
@append

