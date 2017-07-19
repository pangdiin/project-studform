@extends ('backend.layouts.app')

@section ('title', 'Menu Management | Edit Menu ' . $menu->name)

@section('page-header')
     <h1>
        Menu Management
        <small>Edit Menu</small>
    </h1>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">URL Links</h3>
                </div>
                <div class="box-body">
                    @include('backend.menu.forms.widget')
                    @include('backend.menu.forms.custom-node')
                </div>
            </div>
        </div>
        <div class="col-sm-9 main">
            {!! Form::open(['method' => 'PATCH', 'url' => route('admin.menu.update', $menu), 'id' => 'menu-form']) !!}
                @include('backend.menu.forms.main')
                @include('backend.menu.forms.structure')
            {!! Form::close() !!}



            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! history()->renderEntity('Menu', $menu->id) !!}
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection
