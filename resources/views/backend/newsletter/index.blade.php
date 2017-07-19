@extends ('backend.layouts.app')

@section ('title', 'Newsletter Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>
        Newsletter Management
        <small>Subscribers List</small>
    </h1>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-3">
            <form id="box-form-store" class="box box-primary" action="{{ route('admin.newsletter.store') }}" method="POST" role="form">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Add Subscriber
                    </h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="box-footer">
                    <a name="btn_store" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Subscribe Email</a>
                </div>
            </form>
        </div>
        <div class="col-sm-9">
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
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Last Modified</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Last Modified</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            </div><!--box-->
        </div>
    </div>
@endsection


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
                    url: '{{ route("admin.api.newsletter.index") }}',
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

               
                    {data: 'id',      },
                    {data: 'email_address',         },
                    {
                        data: 'status',  
                        render: function(data){
                            return renderLabels(data);
                        },
                    },

                    {data: 'last_changed',},
                    {
                        data: 'actions', 
                        render: function(data){
                            return renderRawActions(data);
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

            function relaodTable() 
            {
                table.ajax.reload();
            }

            $("body").on("click", "a[name='btn_delete_subscriber']", function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                var email = $(this).attr("data-email");
                swal({
                    title: "Are you sure you?",
                    text: "This will delete all newsletter records under this email.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }).then(function(isConfirmed){
                    if(isConfirmed){
                        var form = { 
                            email: email
                        }
                        ajaxMailChimp('DELETE', form, linkURL);
                    }
                });
            });

            $("body").on("click", "a[name='btn_subscribe']", function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                var email = $(this).attr("data-email");
                swal({
                    title: "Are you sure you?",
                    text: "This email will recieve future newsletter.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Re-subscribe",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }).then(function(isConfirmed){
                    if(isConfirmed){
                        var form = { 
                            email: email
                        }
                        ajaxMailChimp('POST', form, linkURL);
                    }
                });
            });

            $("body").on("click", "a[name='btn_unsubscribe']", function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");
                var email = $(this).attr("data-email");
                swal({
                    title: "Are you sure you?",
                    text: "This email will not recieve future newsletter.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Unsubscribe",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }).then(function(isConfirmed){
                    if(isConfirmed){
                        var form = { 
                            email: email
                        }
                        ajaxMailChimp('POST', form, linkURL);
                    }
                });
            });



            $('#box-form-store').boxStoreForm({
                source: '{{ route('admin.api.newsletter.subscribe') }}', 
                onLoadDone: function(){
                    table.ajax.reload();
                }
            });
            

            function ajaxMailChimp(method, form, linkURL) 
            {
                swalLoader();
                var reload = "dont-reload";
                $.ajax({
                    url: linkURL,
                    type: method,
                    dataType: 'json',
                    data: form,
                    success: function(data){
                        swalSuccess(data.message, 'sa', function(){
                            table.ajax.reload();
                        });
                    },
                    error: function(data){
                        swalError(data.message, 'sa', function(){
                            table.ajax.reload();
                        });
                    }
                });
            }
        });
    </script>
@append
