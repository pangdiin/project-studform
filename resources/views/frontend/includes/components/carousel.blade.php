@if(count($sliders))
<div id="slide-show" class="carousel slide" data-ride="carousel">
	@if(count($sliders) > 1)
		<ol class="carousel-indicators">
			@foreach($sliders as $s => $slider)
				<li data-target="#slide-show" data-slide-to="{{ $s }}" class="{{ $loop->first ? 'active' : '' }}"></li>
			@endforeach
		</ol>
	@endif
	<div class="carousel-inner">
		@foreach($sliders as $s => $slider)

			<div class="item {{ $loop->first ? 'active' : '' }}">
				<img src="{{ $slider->path }}" class="img-responsive">
				@if(config('base.slide.title') || config('base.slide.description'))
					<div class="container">
						<div class="hidden-xs carousel-caption {{ $loop->first ? 'first' : '' }}">
							@if(config('base.slide.title'))
								<div class="title">{{ $slider->title }}</div>
							@endif
							<hr>
							@if(config('base.slide.description'))
								<div class="description">{{ $slider->description }}</div>
							@endif
						</div>
						
					</div>
				@endif
			</div>
		
		@endforeach
	</div>
</div>
@endif

@section('after-styles')
	<style type="text/css">
		.carousel-caption{
			background: rgba(23, 125, 225, 0.8);
		    border-radius: 20px;
		    max-width: 550px;
		    min-height: 160px;
		    max-height: 270px;
		    padding: 20px 40px 20px 40px;

		}
		.carousel-caption.get-invited{
			max-width: 300px;
			left: 40%;
		}

		.carousel-caption.get-invited .btn-theme{
			background: #f60b0c;
			font-weight: bold;
			color: #fff;
			font-size: 20px;
			border: 3px solid #fff;
		    padding: 5px 16px;
		    margin: 5px;
		}

		.carousel-caption.get-invited .btn-theme:hover{
			box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5);
		    -webkit-transform: scale(1.1);
		    transform: scale(1.1);
		    transition-duration: 0.3s;
		    -webkit-transition-property: box-shadow, transform;
		    transition-property: box-shadow, transform;
		}
		.carousel-caption.get-invited .title{
			font-family: Verdana,;
			font-size: calc(25px - 50%);

		}
		.carousel-caption.first{
		    left: 5%;
		    top: calc(130px - -12%);
		}

		.carousel-caption.first .title{
			font-family: Verdana,;
			font-size: 30px;
			font-weight: bold;
		}


		.carousel-caption.first hr{
			margin: 10px 0;
		}
		.carousel-caption.first .description{
			font-family: Verdana,;
			font-size: 20px;
		}
	</style>
@append