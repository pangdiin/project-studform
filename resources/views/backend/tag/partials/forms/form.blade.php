{{-- <div class="modal fade" id="modal-form" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['url' => route('admin.tag.update', $type['route']), 'method' => 'PATCH', 'id' => 'modal-form']) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Update Tag</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id">
					@include('backend.tag.partials.forms.fields')
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button name="btn_save" type="submit" class="btn btn-primary pull-right" ><i class="fa fa-pencil"></i> Save changes</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
 --}}