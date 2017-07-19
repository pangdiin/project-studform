@extends ('backend.layouts.app')

@section ('title', 'Menu Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
        Menu Management
        <small>Menu List</small>
    </h1>
@endsection


@section('content')
    <div class="row">
        @if(config('menu.can_add'))
        <div class="col-sm-3">
            <form id="box-form-store" class="box box-primary" action="{{ route('admin.menu.store') }}" method="POST" role="form">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Menu Form
                    </h3>
                </div>
                <div class="box-body">
                    @include('backend.menu.partials.fields', ['process' => 'create'])
                </div>
                <div class="box-footer">
                    <a name="btn_store" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add Menu</a>
                </div>
            </form>
        </div>
        <div class="col-sm-9">
        @else
        <div class="col-sm-12">
        @endif
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu List</h3>

                    <div class="box-tools pull-right">
                        {{-- @include('backend.access.includes.partials.user-header-buttons') --}}
                    </div><!--box-tools pull-right-->
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="users-table" class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Last Update</th>
                                    <th>{{ trans('labels.general.actions') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div><!--table-responsive-->
                </div><!-- /.box-body -->
            </div><!--box-->
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
            {!! history()->renderType('Menu') !!}
        </div><!-- /.box-body -->
    </div>
@endsection


@section('after-scripts')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        $(function() {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.api.menu.index") }}',
                    type: 'post',
                    data: {status: 1, trashed: false}
                },
                columns: [
                    // {data: 'id',        },
                    {data: 'name',      },
                    {data: 'position',  },
                    {data: 'updated_at' },
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[2, "desc"]],
                searchDelay: 500
            });

            @if(config('menu.can_add'))
            $('#box-form-store').boxStoreForm({
                source: '{{ route('admin.menu.store') }}', 
                onLoadDone: function(){
                    table.ajax.reload();
                }
            });
            @endif
            
        });




    </script>
@append
