@extends('backend.layouts.app')
@section ('title', 'Project Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("css/plugin/colorbox.css") }}
@endsection

@section('page-header')
    <h1>
        Projects
        <small>Manage</small>
    </h1>
@endsection
@section('content')
    <div id="content-list" class="box box-danger box-table box-table-image">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Deleted Project List</h3>
            <div class="box-tools pull-right">
                <button type="button" name="btn_refresh" class="btn btn-box-tool" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh"></i></button>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                    <i class="fa fa-cogs" data-toggle="tooltip" data-placement="top" title="Views"></i> <span class="caret"></span>
                </a>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.project.index') }}">Projects</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.project.deleted') }}">Deleted</a></li>
                </ul>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="content-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Last Modified</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Last Modified</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('Project') !!}
        </div><!-- /.box-body -->
    </div>
@append
@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}
    <script type="text/javascript" src="{{ asset('js/plugin/colorbox.min.js') }}"></script>
    <script>

        $(document).ready(function(){
            var overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');
            var table = $('#content-table').DataTable({
                processing: false,
                serverSide: true,
                
                ajax: {
                    url: '{{ route("admin.api.project.index") }}',
                    type: 'post',
                    data: {status: 1, trashed: true},
                    beforeSend: function(){
                        $('#content-list').prepend(overlay);
                    },
                    dataSrc: function(response){
                        $('#content-list').find('.overlay').remove();
                        return response.data;
                    }
                },
                scrollY: '50vh',
                scrollCollapse: false,
                columns: [
                    {
                        data: 'image',  
                        render: function(data){
                            return renderImage(data);
                        },
                        searchable: false, 
                        sortable: false
                    },
                    {data: 'name',      },
                    {data: 'slug',      },
                    {data: 'updated_at',},
                    {
                        data: 'actions', 
                        render: function(data){
                            return renderActions(data);
                        },
                        searchable: false, 
                        sortable: false
                    }
                ],
                order: [[3, "desc"]],
                searchDelay: 500,
                fnInitComplete:function(){
                    
                    $('#content-list').find('.overlay').remove();
                    $('[name=btn_refresh]').click(function(){
                        table.ajax.reload();
                    });
                },
            });
        });
    </script>
@append
