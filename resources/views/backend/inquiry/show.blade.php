@extends ('backend.layouts.app')

@section ('title', 'Inquiry Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
        Enquiry Management
        <small>Enquiry : {{ $inquiry->subject }}</small>
    </h1>
@endsection

@section('content')
	<div class="box box-primary">
    	<div class="box-header with-border">
      		<h3 class="box-title">Read Mail</h3>
      		{{-- <div class="box-tools pull-right">
        		<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Resend "><i class="fa fa-chevron-left"></i></a>
        		<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
      		</div> --}}
    	</div>
    	<div class="box-body no-padding">
	      	<div class="mailbox-read-info">
	        	<h3>{{ $inquiry->subject }}</h3>
	        	<h5>From: {{ $inquiry->email }}
	          		<span class="mailbox-read-time pull-right">{{ $inquiry->created_at->format('d M. Y h:i A') }}</span>
	          	</h5>
	      	</div>
      		<div class="mailbox-read-message">
        		<p><strong>Message</strong></p>
	        	<div class="pre-line">{!! strip_tags($inquiry->message) !!}</div>
            <br/>
            <p>Kind regards,<br/> {{ $inquiry->name }}</p>
	      	</div>
	    </div>
	</div>
@endsection
