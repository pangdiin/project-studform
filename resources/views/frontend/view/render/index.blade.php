@php 
	$views = \App\Models\View\View::whereIn('type', ['block', 'both'])->get();
@endphp
<div class="row">
	@foreach($views as $v => $view)
		<div class="col-sm-12">
			@permission('manage-view')
				<div class="quick-link-container">
					<div class="quick-links">
						<a href="{{ route('admin.view.edit', $view) }}" data-toggle="tooltip" data-placement="right" title="" class="btn btn-circle btn-primary btn-xs" data-original-title="Edit View">
							<i class="fa fa-pencil"></i>
						</a>
					</div>
					@include('frontend.view.template.' . $view->template)
				</div>
			@else
				@include('frontend.view.template.' . $view->template)
			@endauth
		</div>	
	@endforeach
</div>	
