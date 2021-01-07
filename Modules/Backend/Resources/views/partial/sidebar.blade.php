<section class="sidebar" style="height: auto;">
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="{{url('/dashboard')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @can('send-money-view')
            <li>
                <a href="{{url('/send-money')}}">
                    <i class="fa fa-paper-plane"></i>
                    <span>Send Money</span>
                </a>
            </li>
        @endcan
        @can('rate-view')
            <li>
                <a href="{{url('/rates')}}">
                    <i class="fa fa-dollar"></i>
                    <span>Rates</span>
                </a>
            </li>
        @endcan
        @can(['sender-view','sender-create'])
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Manage Senders</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('sender-view')
                        <li><a href="{{url('/senders')}}">
                                <i class="fa fa-circle-o"></i>All Senders</a>
                        </li>
                    @endcan
                    @can('sender-view')
                        <li><a href="{{url('/senders/create')}}">
                                <i class="fa fa-circle-o"></i>Add Senders</a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can(['receiver-create'])
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-plus"></i>
                    <span>Manage Receivers</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('receiver-create')
                        <li><a href="{{url('/receivers')}}">
                                <i class="fa fa-circle-o"></i>Add Receivers</a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="header">PREFERENCES</li>
        @can(['user-view','role-create'])
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Users And Roles</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('user-view')
                        <li><a href="{{url('/users')}}">
                                <i class="fa fa-circle-o"></i>Users</a>
                        </li>
                    @endcan
                    @can('role-view')
                        <li><a href="{{url('/roles')}}">
                                <i class="fa fa-circle-o"></i>Roles</a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="header">SETTINGS</li>
        <li>
            <a href="{{url('/profile')}}">
                <i class="fa fa-cogs"></i>
                <span>Profile</span>
            </a>
        </li>
    </ul>
</section>
