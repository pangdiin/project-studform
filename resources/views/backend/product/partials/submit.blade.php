<div class="box box-success">
	<div class="box-body">
		<div class="row">
			<div class="col-sm-6">
				<a href="{{ route('admin.product.index') }}" class="btn btn-flat btn-block btn-warning"><i class="fa fa-cancel"></i> Cancel</a>
			</div>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-flat btn-block btn-success" name="btn_submit">Submit</button>
			</div>
		</div>
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