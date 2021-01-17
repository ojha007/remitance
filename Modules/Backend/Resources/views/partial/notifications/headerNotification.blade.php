<li class="dropdown notifications-menu">
    <!-- Menu toggle button -->
    @inject('notifications','Modules\Backend\Http\Controllers\NotificationController')
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning notification_count"
              style="display:{{ $notifications->getUnReadNotificationCount()== 0 ?'none':'block' }};">
            {{ $notifications->getUnReadNotificationCount() }}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have <span
                class="notification_count_li">{{ $notifications->getUnReadNotificationCount() }}</span>
            Notifications
            <span class="pull-right"><a class="markAllRead">Mark All as Read</a></span></li>
        <li>
            <!-- Inner Menu: contains the notifications -->
            <div class="text-center loading">
                <div class="overlay">
                    <i class="fa fa-refresh  fa-2x fa-spin"></i>
                </div>
            </div>
            <ul class="menu notifications-list">

            </ul>
        </li>
        <li class="footer">
            <a href="{{ route($routePrefix.'notifications.index') }}">
                View all</a>
        </li>

    </ul>
</li>
