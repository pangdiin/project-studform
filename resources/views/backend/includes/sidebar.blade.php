<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>
            @permission('manage-project')
            <li class="{{ active_class(Active::checkUriPattern('admin/project*')) }}">
                <a href="{{ route('admin.project.index') }}">
                    <i class="fa fa-product-hunt"></i>
                    <span>Projects</span>
                </a>
            </li>
            @endauth

            @permission('manage-product')
            <li class="{{ active_class(Active::checkUriPattern('admin/product*')) }}">
                <a href="{{ route('admin.product.index') }}">
                    <i class="fa fa-shopping-bag"></i>
                    <span>Products</span>
                </a>
            </li>
            @endauth

            @permission('manage-newsletter')
                <li class="{{ active_class(Active::checkUriPattern('admin/newsletter*')) }}">
                    <a href="{{ route('admin.newsletter.index') }}">
                        <i class="fa fa-paper-plane"></i>
                        <span>Newsletters</span>
                    </a>
                </li>
            @endauth

            @permission('manage-inquiry')
            <li class="{{ active_class(Active::checkUriPattern('admin/inquiry*')) }}">
                <a href="{{ route('admin.inquiry.index') }}">
                    <i class="fa fa-envelope"></i>
                    <span>Enquiries</span>
                </a>
            </li>
            @endauth

            <li class="header">Account</li>

            @permissions(['manage-users', 'manage-roles'])
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    @permission('manage-users')
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>
                        </a>
                    </li>
                    @endauth

                    @permission('manage-roles')
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </li>
            @endauth

            <li class="header">CMS</li>
           {{--  @if(config('base.slide.active'))
                @permission('manage-slide')
                <li class="{{ active_class(Active::checkUriPattern('admin/slide*')) }}">
                    <a href="{{ route('admin.slide.index') }}">
                        <i class="fa fa-slideshare"></i>
                        <span>Slides</span>
                    </a>
                </li>
                @endauth
            @endif --}}
            
            @permission('manage-page')
            <li class="{{ active_class(Active::checkUriPattern('admin/page*')) }}">
                <a href="{{ route('admin.page.index') }}">
                    <i class="fa fa-files-o"></i>
                    <span>Pages</span>
                </a>
            </li>
            @endauth
            @if(config('tag.active'))
                
                @permission('manage-tag')
                <li class="{{ active_class(Active::checkUriPattern('admin/tag*')) }} treeview">
                    <a href="#">
                        <i class="fa fa-tag"></i>
                        <span>Taxonomy</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/tag*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/tag*'), 'display: block;') }}">
                        @foreach(config('tag.type') as $t => $type)
                            <li class="{{ active_class(Active::checkUriPattern('admin/tag/'. $t .'/*')) }}">
                                <a href="{{ route('admin.tag.index', $t) }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>{{ $type['name'] }}s</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @endauth
            @endif


            
            @permission('manage-block')
            <li class="{{ active_class(Active::checkUriPattern('admin/block*')) }}">
                <a href="{{ route('admin.block.index') }}">
                    <i class="fa fa-cube"></i>
                    <span>Blocks</span>
                </a>
            </li>
            @endauth

            @permission('manage-view')
            <li class="{{ active_class(Active::checkUriPattern('admin/view*')) }}">
                <a href="{{ route('admin.view.index') }}">
                    <i class="fa fa-th"></i>
                    <span>Views</span>
                </a>
            </li>
            @endauth
            
            @permission('manage-menu')
            <li class="{{ active_class(Active::checkUriPattern('admin/menu*')) }}">
                <a href="{{ route('admin.menu.index') }}">
                    <i class="fa fa-list"></i>
                    <span>Menus</span>
                </a>
            </li>
            @endauth

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>
            

            @permission('manage-setting')
            <li class="{{ active_class(Active::checkUriPattern('admin/setting*')) }}">
                <a href="{{ route('admin.setting.index') }}">
                    <i class="fa fa-fa-spin fa-cogs"></i>
                    <span>Settings</span>
                </a>
            </li>
            @endauth
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/setting*')) }}">
                <a href="{!! route('frontend.auth.logout') !!}">
                    <i class="fa fa-sign-out"></i>
                    {{ trans('navs.general.logout') }}
                </a>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>