@extends('backend.layouts.app')
@section ('title', 'Slide Management')

@section('page-header')
    <h1>
        Slide Management
        <small>Edit Slide</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-pencil"></i> Edit Slide</h3>

            <div class="box-tools pull-right">
                @include('backend.slide.partials.buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-sm-8 col-sm-push-2">
                    {!! Form::open(['method' => 'PATCH', 'url' => route('admin.slide.update', $slide->id), 'file' => 'mutlipart/enctype', 'files' => true, 'id' => 'slide-form' ]) !!}
                        @include('backend.slide.partials.fields')
                        <div class="form-group">
                            <a name="btn_submit" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Update</a>
                        </div>
                    {!! Form::close() !!}
                </div>  
            </div>
        </div>
        <div class="box-footer">
            
        </div>
    </div><!--box-->
@endsection