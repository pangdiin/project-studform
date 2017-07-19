@if(isset($menus) && count($menus))
	@foreach($menus as $m => $links)
		@permission('manage-menu')

			<div class="quick-link-container {{ isset($type) && $type == "dropdown" ?  'navbar-right' : '' }}">
				<div class="quick-links">
					<a href="{{ route('admin.menu.edit', $links->first()->menu) }}" data-toggle="tooltip" data-placement="right" title="" class="btn btn-circle btn-primary btn-xs" data-original-title="Edit">
						<i class="fa fa-pencil"></i>
					</a>
				</div>
				<div class="clearfix">
					
					<ul class="{{ isset($type) && $type == "dropdown" ?  'nav navbar-nav navbar-right' : 'media-list' }} {{ isset($class) ? $class : '' }} {{ menu()->areActiveRoutes($links) }}">
				    <b style="color:white;font-family:Museo-300;">{{  (isset($title) && $title) ? $links->first()->menu->name : null }}</b>
					@include('frontend.menu.partials.node', ['type' => (isset($type) ? $type : null), 'isChild' => false ])
					</ul>
				</div>
			</div>
		@else
			<ul class="{{ isset($type) && $type == "dropdown" ?  'nav navbar-nav navbar-right' : 'media-list' }} {{ isset($class) ? $class : '' }} {{ menu()->areActiveRoutes($links) }}">
		    <b style="color:white;font-family:Museo-300;">{{  (isset($title) && $title) ? $links->first()->menu->name : null }}</b>
			@include('frontend.menu.partials.node', ['type' => (isset($type) ? $type : null), 'isChild' => false ])
			</ul>
		@endauth
	@endforeach
@endif


