<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">
            Content and Filter Criteria
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-3">
                <ul class="nav nav-tabs tabs-left" id="content-type">
                    @foreach(config('view.content') as $c => $content)
                        @php 
                            $type = isset($view) ? $contents->where('type', $c)->first() : null; 
                        @endphp

                        <li class="{{ ($loop->first  ? 'active' : '') }}" data-type="{{ $c }}">
                            <a href="#tab-{{ $c }}" data-toggle="tab">{!! Form::checkbox('contents[]', $c, ( $type ? ['checked' => 'checked'] : [])) !!} {{ ucfirst(str_replace('-', ' ', $c)) }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content">

                    @foreach(config('view.content') as $c => $content)
                        @php 
                            $type = isset($view) ? $contents->where('type', $c)->first() : null;
                        @endphp

                        <div class="tab-pane {{ $loop->first  ? 'active' : '' }}" id="tab-{{ $c }}">
                            <div class="overlay">
                                <div class="text-center">
                                    <i class="fa fa-ban fa-3x"></i>
                                    <br/>
                                    Disabled
                                </div>
                            </div>
                            {{ ucfirst(str_replace('-', ' ', $c)) }}
                            <hr/>
                            <div class="row">
                                <div class="col-sm-3">
                                    {!! Form::select('field', $content['fields'], old('field'), ['class' => 'form-control field'] ) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::select('comparison', config('view.conditions'), old('comparison'), ['class' => 'form-control comparison'] ) !!}
                                </div>
                                <div class="col-sm-3">
                                    {!! Form::text('condition', old('condition'), ['class' => 'form-control condition'] ) !!}
                                </div>
                                <div class="col-sm-3">
                                    <a name="btn_add_criteria" data-type="{{ $c }}" class="btn btn-flat btn-success"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                            <hr/>
                            <div class="table-responsive">
                                <table  class="table table-hover table-striped criteria">
                                    <thead>
                                        <tr>
                                            <th>Criteria</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($type)
                                            @foreach($type->criterias as $cr => $criteria)
                                                <tr>
                                                    <td>
                                                        {{ config('view.content.' . $type->type .'.fields')[$criteria->field] }}
                                                        <span class="text-primary">
                                                            {{ config('view.conditions')[$criteria->comparison] }}
                                                        </span>
                                                        {{ $criteria->condition }}
                                                    </td>
                                                    <td>
                                                        <input name="criteria[{{ $type->type }}][field][]"      value="{{ $criteria->field }}" type="hidden"/>
                                                        <input name="criteria[{{ $type->type }}][comparison][]" value="{{ $criteria->comparison }}" type="hidden"/>
                                                        <input name="criteria[{{ $type->type }}][condition][]"  value="{{ $criteria->condition }}" type="hidden"/>
                                                        <a name="btn_criteria_exist_delete" href="{{ route('admin.api.view.content.criteria.destroy', [$view, $type, $criteria]) }}" class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@section('after-styles')
    <style type="text/css">
    .tabs-left, .tabs-right {
      border-bottom: none;
      padding-top: 2px;
    }
    .tabs-left {
      border-right: 1px solid #ddd;
    }
    .tabs-right {
      border-left: 1px solid #ddd;
    }
    .tabs-left>li, .tabs-right>li {
      float: none;
      margin-bottom: 2px;
    }
    .tabs-left>li {
      margin-right: -4px;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #555;
        background-color: #fff;
        border: 1px solid #ddd;
        border-right-color: transparent;
        cursor: default;
    }
    .tab-pane{
        position: relative;
    }
    .overlay{
        position: absolute;
        width: 100%;
        height: 100%;
        display: none;
    }
    .overlay.disabled{
        display: block;
    }
    .overlay.disabled > div{
        position: absolute;
        top: 50%;
        width: 100%;
    }
    </style>
@append
@section('after-scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var prev_type = '{{ array_keys(config('view.content'))[0] }}';
            $('#content-type li').click(function (e) {
             // e.preventDefault();



                var click_type = $(this).attr('data-type');

                $(this).find('a').tab('show');
                var panel = $($(this).find('a').attr('href'));
                var checkbox = $(this).closest('li').find('input[type="checkbox"]');

             // $(this).tab('show');
                // $(this).closest('ul').find('input[type="checkbox"]').prop('checked','');

                if(prev_type == click_type){
                    if(checkbox.is(':checked')){
                        checkbox.prop('checked','');
                        panel.find('.overlay').addClass('disabled');
                    }else{
                        checkbox.prop('checked','checked');
                        panel.find('.overlay').removeClass('disabled');
                    }
                }else{
                    checkbox.prop('checked','checked');
                    panel.find('.overlay').removeClass('disabled');
                    prev_type = click_type;
                }

            });

            $('[name=btn_add_criteria]').click(function(){
                var type = $(this).attr('data-type');
                var main = $(this).closest('.tab-pane');
                var el = $(this).closest('.row');
                var field       = el.find('.field').val();
                var comparison  = el.find('.comparison').val();
                var condition   = el.find('.condition').val();

                var field_text       = el.find('.field option:selected').text();
                var comparison_text  = el.find('.comparison option:selected').text();
                var condition        = el.find('.condition').val();


                if(condition == ""){
                    el.find('.condition').focus();
                    return;
                }
                var tbody = main.find('tbody');
                tbody.append(`
                    <tr>
                        <td>
                            `+ field_text +` <span class="text-primary">` + comparison_text + `</span> `+ condition +`
                        </td>
                        <td>
                            <input name="criteria[`+ type +`][field][]"       value="`+ field +`"         type="hidden"/>
                            <input name="criteria[`+ type +`][comparison][]"  value="`+ comparison +`"    type="hidden"/>
                            <input name="criteria[`+ type +`][condition][]"   value="`+ condition +`"     type="hidden"/>
                            <a name="btn_delete_criteria" class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                `);

                tbody.on('click', '[name=btn_delete_criteria]', function(){
                    $(this).closest('tr').remove();
                });
                
            });
            $('[name=btn_criteria_exist_delete]').click(function(e){
                e.preventDefault();
                var el = $(this);
                var linkURL = $(this).attr("href");
                swal({
                    title: "Are you sure you want to delete this record?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }).then(function(isConfirmed){
                    if(isConfirmed){
                        swalLoader();
                        $.ajax({
                            url: linkURL,
                            type: 'DELETE',
                            dataType: 'json',
                            data: {},
                            success: function(data){
                                swal.close();
                                el.closest('tr').remove();
                                
                            },
                            error: function(data){
                                swalError(data.message);
                            }
                        });
                    }
                });

            });

          
        });
    </script>
@append