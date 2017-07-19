<div class="box box-success">
	<div class="box-body">

				<button type="submit" class="btn btn-flat btn-block btn-success" name="btn_submit">Submit</button>

				<a href="{{ route('admin.letter.index') }}" class="btn btn-flat btn-block btn-warning"><i class="fa fa-cancel"></i> Cancel</a>

	</div>
</div>

@section('after-scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('[name=btn_submit]').click(function(){
				swalLoader();
			});
		});
	</script>
@append