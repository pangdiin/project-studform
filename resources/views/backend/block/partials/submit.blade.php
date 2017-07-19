<div class="box box-primary">
	<div class="box-body">
		<div class="row">
			<div class="col-sm-6">
				<a href="{{ route('admin.block.index') }}" class="btn btn-flat btn-block btn-warning"><i class="fa fa-cancel"></i> Cancel</a>
			</div>
			<div class="col-sm-6">
			{!! Form::submit('Save Changes', ['id' => 'btn_submit', 'class' => 'btn btn-flat btn-block btn-success']) !!}
			</div>
		</div>
	</div>
</div>

@section('after-scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btn_submit').click(function(){
				swalLoader();
			});
		});
	</script>
@append