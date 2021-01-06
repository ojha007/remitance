<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset('backend/images/admin-logo.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{auth()->user()->user_name}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search"
                        id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
    </form>
    <ul class="sidebar-menu" data-widget="tree">
        {{--        <li class="header">MAIN NAVIGATION</li>--}}
{{--        <li class="{{request()->is($urlPrefix) ? 'active' :' '}}">--}}
{{--            <a href="{{route($routePrefix.'dashboard')}}">--}}
{{--                <i class="fa fa-dashboard"></i>--}}
{{--                <span>Dashboard</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="treeview {{--}}
{{--            request()->is([$urlPrefix.'/news',--}}
{{--                          $urlPrefix.'/news/*'])--}}
{{--           ? 'active' : ''}} ">--}}
{{--            <a href="#">--}}
{{--                <i class="fa fa-files-o"></i>--}}
{{--                <span>News Management</span>--}}
{{--                <span class="pull-right-container">--}}
{{--              <i class="fa fa-angle-left pull-right"></i>--}}
{{--            </span>--}}
{{--            </a>--}}
{{--            <ul class="treeview-menu">--}}
{{--                <li class="{{request()->is($urlPrefix.'/news') ? 'active':''}}">--}}
{{--                    <a href="{{route($routePrefix.'news.index')}}">--}}
{{--                        <i class="fa fa-circle-o"></i>--}}
{{--                        All News--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{request()->is($urlPrefix.'/news/create') ? 'active':''}}">--}}
{{--                    <a href="{{route($routePrefix.'news.create')}}">--}}
{{--                        <i class="fa fa-circle-o"></i>--}}
{{--                        Add News</a>--}}
{{--                </li>--}}
{{--                <li class="{{request()->is($urlPrefix.'/news/soft-delete') ? 'active':''}}">--}}
{{--                    <a href="{{route($routePrefix.'news.soft-delete')}}">--}}
{{--                        <i class="fa fa-circle-o"></i>--}}
{{--                        Deleted News--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                --}}{{--                <li><a href="flot.html">Breaking News</a></li>--}}
{{--                --}}{{--                <li><a href="inline.html">Special News</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="treeview {{request()->is($urlPrefix.'/news-category',--}}
{{--                    $urlPrefix.'/category/create') ? 'active':''}}">--}}
{{--            <a href="#">--}}
{{--                <i class="fa fa-files-o"></i>--}}
{{--                <span>News Category</span>--}}
{{--                <span class="pull-right-container">--}}
{{--                      <i class="fa fa-angle-left pull-right"></i>--}}
{{--                    </span>--}}
{{--            </a>--}}
{{--            <ul class="treeview-menu">--}}
{{--                <li class="{{request()->is($urlPrefix.'/category') ? 'active': ''}}">--}}
{{--                    <a href="{{route($routePrefix.'category.index')}}">--}}
{{--                        <i class="fa fa-circle-o"></i>--}}
{{--                        All Category--}}
{{--                    </a></li>--}}
{{--                <li class="{{request()->is($urlPrefix.'/category/create') ?'active':'' }}">--}}
{{--                    <a href="{{route($routePrefix.'category.create')}}">--}}
{{--                        <i class="fa fa-circle-o"></i>--}}
{{--                        Add Category--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{request()->is($urlPrefix.'/category-groups/create') ?'active':'' }}">--}}
{{--                    <a href="{{route($routePrefix.'category-groups.create')}}">--}}
{{--                        <i class="fa fa-circle-o"></i>--}}
{{--                        Group Category--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="treeview {{request()->is($urlPrefix.'/news-category',--}}
{{--                    $urlPrefix.'/contacts/create') ? 'active':''}}">--}}
{{--            <a href="#">--}}
{{--                <i class="fa fa-users"></i>--}}
{{--                <span>Contacts</span>--}}
{{--                <span class="pull-right-container">--}}
{{--                      <i class="fa fa-angle-left pull-right"></i>--}}
{{--                    </span>--}}
{{--            </a>--}}

{{--            <ul class="treeview-menu">--}}
{{--                @isset($contactTypes)--}}
{{--                    @foreach($contactTypes as $type)--}}
{{--                        <li class="{{request()->is($urlPrefix.'/'.$type,--}}
{{--                                $urlPrefix.'/'.$type .'/*') ? 'active': ''}}">--}}
{{--                            <a href="{{route($routePrefix.$type.'.index')}}">--}}
{{--                                <i class="fa fa-circle-o"></i>--}}
{{--                                {{ucwords($type)}}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                @endisset--}}
{{--            </ul>--}}
{{--        </li>--}}

{{--        <li class="{{request()->is($urlPrefix.'/team',$urlPrefix.'/team/*') ? 'active' :''}}">--}}
{{--            <a href="{{route($routePrefix.'team.index')}}">--}}
{{--                <i class="fa fa-object-group"></i> <span>Teams</span>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="{{request()->is($urlPrefix.'/advertisements',$urlPrefix.'/advertisements/*') ? 'active' :''}}">--}}
{{--            <a href="{{route($routePrefix.'advertisements.index')}}">--}}
{{--                <i class="fa  fa-sliders"></i> <span>Advertisement</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="{{request()->is($urlPrefix.'/photo-feature',$urlPrefix.'/photo-feature/*') ? 'active' :''}}">--}}
{{--            <a href="{{route($routePrefix.'photo-feature.index')}}">--}}
{{--                <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Photo Feature</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="{{request()->is($urlPrefix.'/comments',$urlPrefix.'/comments/*') ? 'active' :''}}">--}}
{{--            <a href="{{route($routePrefix.'comments.index')}}">--}}
{{--                <i class="fa fa-comment" aria-hidden="true"></i> <span>Comments</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="header">SETTINGS</li>--}}
{{--        @include('auth::partials.sidebar')--}}
{{--        <li class="treeview {{request()->is($urlPrefix.'/news-category',--}}
{{--                    $urlPrefix.'/news-category/create') ? 'active':''}}">--}}
{{--            <a href="#">--}}
{{--                <i class="fa fa-cogs"></i>--}}
{{--                <span>Settings</span>--}}
{{--                <span class="pull-right-container">--}}
{{--                      <i class="fa fa-angle-left pull-right"></i>--}}
{{--                    </span>--}}
{{--            </a>--}}
{{--            --}}
{{--        </li>--}}
        {{--        <li class="header">Media</li>--}}
        {{--        <li class="{{request()->is($urlPrefix.'/file-manager',--}}
        {{--                    $urlPrefix.'/file-manager/*') ? 'active' :''}}">--}}
        {{--            <a href="{{route($routePrefix.'file-manager.index')}}">--}}
        {{--                <i class="fa fa-picture-o" aria-hidden="true"></i> <span>Gallery</span>--}}
        {{--            </a>--}}
        {{--        </li>--}}
        <li class="header">Extra</li>

    </ul>
</section>

<!-- /.sidebar -->
