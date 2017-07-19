<div class="pull-right mb-10 hidden-sm hidden-xs">
    <a href="{{ route('admin.slide.index') }}" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-list"></i> Lists</a>
    <a href="{{ route('admin.slide.create') }}" class="btn btn-xs btn-flat btn-success"><i class="fa fa-plus"></i> Create Slide</a>
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.access.users.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('admin.slide.index') }}">Lists</a></li>
            <li><a href="{{ route('admin.slide.create') }}">Create Slide</a></li>

        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>