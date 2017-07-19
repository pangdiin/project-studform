@extends ('backend.layouts.app')

@section ('title', 'Taxonomy ' . $type['name'] . ' Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ $type['name'] }} Management
        <small>{{ $type['name'] }} List</small>
    </h1>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-3">
            <form id="box-form-store" class="box box-primary" action="{{ route('admin.tag.store', $type['route']) }}" method="POST" role="form">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Tag Form
                    </h3>
                </div>
                <div class="box-body">
                    @include('backend.tag.partials.forms.fields', ['process' => 'create'])
                </div>
                <div class="box-footer">
                    <a name="btn_store" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add Tag</a>
                </div>
            </form>
        </div>
        <div class="col-sm-9">
            <div id="content-list" class="box box-primary box-table box-table-image">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-list"></i> {{ $type['name'] }} List</h3>
                    <div class="box-tools pull-right">
                        <button type="button" name="btn_refresh" class="btn btn-box-tool" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="content-table" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    @if($type['image'])
                                    <th></th>
                                    @endif
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Last Modified</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    @if($type['image'])
                                    <th></th>
                                    @endif
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

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    {!! history()->renderType('Tag') !!}
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
    @include('backend.tag.partials.forms.form')
@endsection


@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script >
        $(document).ready(function(){
            var overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');
            var table = $('#content-table').DataTable({
                processing: false,
                serverSide: true,
                
                ajax: {
                    url: '{{ route("admin.api.tag.index", $type['route']) }}',
                    type: 'post',
                    data: {status: 1, trashed: false},
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
                    @if($type['name'])
                    {
                        data: 'image',  
                        render: function(data){
                            return renderImage(data);
                        },
                        searchable: false, 
                        sortable: false
                    },
                    @endif
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
            $('#box-form-store').boxStoreForm({
                source: '{{ route('admin.tag.store', $type['route']) }}', 
                image: true,
                onLoadDone: function(){
                    table.ajax.reload();
                }
            });
        });
    </script>
@append
