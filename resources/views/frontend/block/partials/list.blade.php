@if(isset($blocks) && count($blocks))
	@foreach($blocks as $b => $block)
		@permission('manage-block')
			<div class="quick-link-container">
				<div class="quick-links">
					<a href="{{ route('admin.block.edit', $block) }}" class="btn btn-circle btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" ></i></a>
				</div>
				<div class="blur" style="color:white;font-family:Museo-500;">
					<div id="block-{{ $block->slug }}" class="{{ $block->class }} ">
						<div class="text-left">{{ $block->name }}</div>
						{!! $block->content !!}
					</div>
				</div>
			</div>
		@else
			<div id="block-{{ $block->slug }}" class="{{ $block->class }} " style="color:white;font-family:Museo-500;">
				<div class="text-left">{{ $block->name }}</div>
				{!! $block->content !!}
			</div>
		@endif
	@endforeach
@endif