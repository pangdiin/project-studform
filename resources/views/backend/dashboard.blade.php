
@extends('backend.layouts.app')
@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    @include('backend.partials.widgets')
    <div class="row" >
        
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->render() !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection


{{-- 
 <!DOCTYPE html>
<html class="fuelux">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Snippets</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- dependencies -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//www.fuelcdn.com/fuelux/3.1.0/css/fuelux.min.css" rel="stylesheet"/>
    <link href="//www.fuelcdn.com/fuelux-mctheme/1.1.0/css/fuelux-mctheme.min.css" rel="stylesheet"/>
</head>
<body>
    
<div class="repeater" id="myRepeater" data-staticheight="true" style="position:absolute; top:25px; right:25px; bottom:25px; left:25px;">
    <div class="repeater-header">
        <div class="repeater-header-left">
            <span class="repeater-title">Repeater</span>
            <div class="repeater-search">
                <div class="search input-group">
                    <input type="search" class="form-control" placeholder="Search"/>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">
                          <span class="glyphicon glyphicon-search"></span>
                          <span class="sr-only">Search</span>
                      </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="repeater-header-right">

        </div>
    </div>
    <div class="repeater-viewport">
        <div class="repeater-canvas"></div>
        <div class="loader repeater-loader"></div>
    </div>
    <div class="repeater-footer">
        <div class="repeater-footer-left">
            <div class="repeater-itemization">
                <span><span class="repeater-start"></span> - <span class="repeater-end"></span> of <span class="repeater-count"></span> items</span>
                <div class="btn-group selectlist dropup" data-resize="auto">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="selected-label">&nbsp;</span>
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li data-value="5"><a href="#">5</a></li>
                        <li data-value="10" data-selected="true"><a href="#">10</a></li>
                        <li data-value="20"><a href="#">20</a></li>
                    </ul>
                    <input class="hidden hidden-field" name="itemsPerPage" readonly="readonly" aria-hidden="true" type="text"/>
                </div>
                <span>Per Page</span>
            </div>
        </div>
        <div class="repeater-footer-right">
            <div class="repeater-pagination">
                <button type="button" class="btn btn-default btn-sm repeater-prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous Page</span>
                </button>
                <label class="page-label" id="myPageLabel">Page</label>
                <div class="repeater-primaryPaging active">
                    <div class="input-group input-append dropdown combobox dropup">
                        <input type="text" class="form-control" aria-labelledby="myPageLabel">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right"></ul>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control repeater-secondaryPaging" aria-labelledby="myPageLabel">
                <span>of <span class="repeater-pages"></span></span>
                <button type="button" class="btn btn-default btn-sm repeater-next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next Page</span>
                </button>
            </div>
        </div>
    </div>
</div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//www.fuelcdn.com/fuelux/3.2.0/js/fuelux.min.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
    <script>
        $(function() {
            // define the columns in your datasource
            var columns = [
                {
                    label: 'Name &amp; Description',
                    property: 'name',
                    sortable: true
                },
                {
                    label: 'Code',
                    property: 'code',
                    sortable: true
                }
            ];

            function customColumnRenderer(helpers, callback) {
                // determine what column is being rendered
                var column = helpers.columnAttr;

                // get all the data for the entire row
                var rowData = helpers.rowData;
                var customMarkup = '';

                // only override the output for specific columns.
                // will default to output the text value of the row item
                switch(column) {
                    case 'name':
                        // let's combine name and description into a single column
                        customMarkup = '<div style="font-size:12px;">' + rowData.name + '</div><div class="small text-muted">' + rowData.description + '</div>';
                        break;
                    default:
                        // otherwise, just use the existing text value
                        customMarkup = helpers.item.text();
                        break;
                }

                helpers.item.html(customMarkup);

                callback();
            }

            function customRowRenderer(helpers, callback) {
                // let's get the id and add it to the "tr" DOM element
                var item = helpers.item;
                item.attr('id', 'row' + helpers.rowData.id);

                callback();
            }

            // this example uses an API to fetch its datasource.
            // the API handles filtering, sorting, searching, etc.
            function customDataSource(options, callback) {
                // set options
                var pageIndex = options.pageIndex;
                var pageSize = options.pageSize;
                var options = {
                    pageIndex: pageIndex,
                    pageSize: pageSize,
                    sortDirection: options.sortDirection,
                    sortBy: options.sortProperty,
                    filterBy: options.filter.value || '',
                    searchBy: options.search || ''
                };

                // call API, posting options
                $.ajax({
                    type: 'post',
                    url: '/repeater/data',
                    data: options
                })
                .done(function(data) {

                    var items = data.items;
                    var totalItems = data.total;
                    var totalPages = Math.ceil(totalItems / pageSize);
                    var startIndex = (pageIndex * pageSize) + 1;
                    var endIndex = (startIndex + pageSize) - 1;

                    if(endIndex > items.length) {
                        endIndex = items.length;
                    }

                    // configure datasource
                    var dataSource = {
                        page: pageIndex,
                        pages: totalPages,
                        count: totalItems,
                        start: startIndex,
                        end: endIndex,
                        columns: columns,
                        items: items
                    };

                    // invoke callback to render repeater
                    callback(dataSource);
                });
            }

            // initialize the repeater
            var repeater = $('#myRepeater');
            repeater.repeater({
                list_selectable: false, // (single | multi)
                list_noItemsHTML: 'nothing to see here... move along',

                // override the column output via a custom renderer.
                // this will allow you to output custom markup for each column.
                list_columnRendered: customColumnRenderer,

                // override the row output via a custom renderer.
                // this example will use this to add an "id" attribute to each row.
                list_rowRendered: customRowRenderer,

                // setup your custom datasource to handle data retrieval;
                // responsible for any paging, sorting, filtering, searching logic
                dataSource: customDataSource
            });
        });
    </script>

</body>
</html> --}}
{{-- 
<!DOCTYPE html>
<html class="fuelux">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Snippets</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- dependencies -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//www.fuelcdn.com/fuelux/3.1.0/css/fuelux.min.css" rel="stylesheet"/>
    <link href="//www.fuelcdn.com/fuelux-mctheme/1.1.0/css/fuelux-mctheme.min.css" rel="stylesheet"/>
</head>
<body>

<div class="repeater" id="myRepeater" data-staticheight="true" style="position:absolute; top:25px; right:25px; bottom:25px; left:25px;">
    <div class="repeater-header">
        <div class="repeater-header-left">
            <span class="repeater-title">Repeater</span>
            <div class="repeater-search">
                <div class="search input-group">
                    <input type="search" class="form-control" placeholder="Search"/>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">
                          <span class="glyphicon glyphicon-search"></span>
                          <span class="sr-only">Search</span>
                      </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="repeater-header-right">
            <div class="btn-group selectlist repeater-filters" data-resize="auto">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="selected-label">&nbsp;</span>
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Filters</span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li data-value="all" data-selected="true"><a href="#">all</a></li>
                    <li data-value="draft"><a href="#">draft</a></li>
                    <li data-value="archived"><a href="#">archived</a></li>
                    <li data-value="active"><a href="#">active</a></li>
                </ul>
                <input class="hidden hidden-field" name="filterSelection" readonly="readonly" aria-hidden="true" type="text"/>
            </div>
            <div class="btn-group repeater-views" data-toggle="buttons">
                <label class="btn btn-default active">
                    <input name="repeaterViews" type="radio" value="list"><span class="glyphicon glyphicon-list"></span>
                </label>
                <label class="btn btn-default">
                    <input name="repeaterViews" type="radio" value="thumbnail"><span class="glyphicon glyphicon-th"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="repeater-viewport">
        <div class="repeater-canvas"></div>
        <div class="loader repeater-loader"></div>
    </div>
    <div class="repeater-footer">
        <div class="repeater-footer-left">
            <div class="repeater-itemization">
                <span><span class="repeater-start"></span> - <span class="repeater-end"></span> of <span class="repeater-count"></span> items</span>
                <div class="btn-group selectlist dropup" data-resize="auto">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="selected-label">&nbsp;</span>
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li data-value="5"><a href="#">5</a></li>
                        <li data-value="10" data-selected="true"><a href="#">10</a></li>
                        <li data-value="20"><a href="#">20</a></li>
                    </ul>
                    <input class="hidden hidden-field" name="itemsPerPage" readonly="readonly" aria-hidden="true" type="text"/>
                </div>
                <span>Per Page</span>
            </div>
        </div>
        <div class="repeater-footer-right">
            <div class="repeater-pagination">
                <button type="button" class="btn btn-default btn-sm repeater-prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous Page</span>
                </button>
                <label class="page-label" id="myPageLabel">Page</label>
                <div class="repeater-primaryPaging active">
                    <div class="input-group input-append dropdown combobox dropup">
                        <input type="text" class="form-control" aria-labelledby="myPageLabel">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right"></ul>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control repeater-secondaryPaging" aria-labelledby="myPageLabel">
                <span>of <span class="repeater-pages"></span></span>
                <button type="button" class="btn btn-default btn-sm repeater-next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next Page</span>
                </button>
            </div>
        </div>
    </div>
</div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//www.fuelcdn.com/fuelux/3.2.0/js/fuelux.min.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
    <script>
        $(function() {
            // define the columns in your datasource
            var columns = [
                {
                    label: 'Name & Description',
                    property: 'name',
                    sortable: true
                },
                {
                    label: 'Key',
                    property: 'key',
                    sortable: true
                },
                {
                    label: 'Status',
                    property: 'status',
                    sortable: true
                }
            ];

            // define the rows in your datasource
            var items = [];
            var statuses = ['archived', 'active', 'draft'];
            function getRandomStatus() {
                var min = 0;
                var max = 2;
                var index = Math.floor(Math.random() * (max - min + 1)) + min;
                return statuses[index];
            }

            for(var i=1; i<=100; i++) {
                var item = {
                    id: i,
                    name: 'item ' + i,
                    key: 'key ' + i,
                    description: 'desc ' + i,
                    status: getRandomStatus()
                }
                items.push(item);
            }

            function customColumnRenderer(helpers, callback) {
                // determine what column is being rendered
                var column = helpers.columnAttr;

                // get all the data for the entire row
                var rowData = helpers.rowData;
                var customMarkup = '';

                // only override the output for specific columns.
                // will default to output the text value of the row item
                switch(column) {
                    case 'name':
                        // let's combine name and description into a single column
                        customMarkup = '<div style="font-size:12px;">' + rowData.name + '</div><div class="small text-muted">' + rowData.description + '</div>';
                        break;
                    default:
                        // otherwise, just use the existing text value
                        customMarkup = helpers.item.text();
                        break;
                }

                helpers.item.html(customMarkup);

                callback();
            }

            function customRowRenderer(helpers, callback) {
                // let's get the id and add it to the "tr" DOM element
                var item = helpers.item;
                item.attr('id', 'row' + helpers.rowData.id);

                callback();
            }

            // this example uses a static datasource and
            // underscore is used to filter, sort, search, etc.
            function customDataSource(options, callback) {
                var pageIndex = options.pageIndex;
                var pageSize = options.pageSize;

                var data = items;

                // sort by
                data = _.sortBy(data, function(item) {
                    return item[options.sortProperty];
                });

                // sort direction
                if (options.sortDirection === 'desc') {
                    data = data.reverse();
                }

                // filter
                if (options.filter && options.filter.value !== 'all') {
                    data = _.filter(data, function(item) {
                        return item.status === options.filter.value;
                    });
                }

                // search
                if (options.search && options.search.length > 0) {
                    var searchedData = [];
                    var searchTerm = options.search.toLowerCase();

                    _.each(data, function(item) {
                        var values = _.values(item);
                        var found = _.find(values, function(val) {

                            if(val.toString().toLowerCase().indexOf(searchTerm) > -1) {
                                searchedData.push(item);
                                return true;
                            }
                        });
                    });

                    data = searchedData;
                }

                var totalItems = data.length;
                var totalPages = Math.ceil(totalItems / pageSize);
                var startIndex = (pageIndex * pageSize) + 1;
                var endIndex = (startIndex + pageSize) - 1;
                if(endIndex > data.length) {
                    endIndex = data.length;
                }

                data = data.slice(startIndex-1, endIndex);

                var dataSource = {
                    page: pageIndex,
                    pages: totalPages,
                    count: totalItems,
                    start: startIndex,
                    end: endIndex,
                    columns: columns,
                    items: data
                };

                callback(dataSource);
            }

            // initialize the repeater
            var repeater = $('#myRepeater');
            repeater.repeater({
                list_selectable: false, // (single | multi)
                list_noItemsHTML: 'nothing to see here... move along',

                // override the column output via a custom renderer.
                // this will allow you to output custom markup for each column.
                list_columnRendered: customColumnRenderer,

                // override the row output via a custom renderer.
                // this example will use this to add an "id" attribute to each row.
                list_rowRendered: customRowRenderer,

                // setup your custom datasource to handle data retrieval;
                // responsible for any paging, sorting, filtering, searching logic
                dataSource: customDataSource
            });
        });
    </script>

</body>
</html> --}}