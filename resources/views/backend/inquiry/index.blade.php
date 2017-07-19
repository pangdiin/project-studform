@extends('backend.layouts.app')
@section ('title', 'Enquiry Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("css/plugin/colorbox.css") }}
@endsection

@section('page-header')
    <h1>
        Enquiries
        <small>Manage</small>
    </h1>
@endsection
@section('content')
    <div id="content-list" class="box box-primary box-table box-table-image">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list"></i> Enquiry List</h3>
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
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Modified</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Last Modified</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
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
                    url: '{{ route("admin.api.inquiry.index") }}',
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

                // 'id', 'name', 'email', 'subject', 'created_at', 'updated_at'

               
                    {data: 'subject',      },
                    {data: 'name',         },
                    {data: 'email',         },

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
