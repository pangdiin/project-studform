@extends('frontend.layouts.app')
@section('content')
    <h1 class="page-heading">{{ $node->name }}</h1>
    
    @unless(access()->guest())
    	@permission('manage-tag')
    		<div role="tabpanel">
    			<ul class="nav nav-tabs" role="tablist">
    				<li role="presentation" class="active">
    					<a href="#content" aria-controls="content" role="tab" data-toggle="tab"><i class="fa fa-search"></i> View</a>
    				</li>
    				<li role="presentation">
    					<a href="{{ route('admin.tag.edit', [$node->getTypeRouteKey(), $node]) }}"><i class="fa fa-pencil"></i> Edit</a>
    				</li>
    			</ul>
    			<div class="tab-content">
    				<div role="tabpanel" class="tab-pane active" id="content">
					    {!! strip_tags($node->description) !!}
    				</div>
    			</div>
    		</div>
    	@else
    		<hr/>
		    {!! $node->description !!}
    	@endauth
    @else
    	<hr/>
	    {!! $node->description !!}
    @endif
@append

