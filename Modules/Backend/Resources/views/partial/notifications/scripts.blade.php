<script>
    Echo.private(`user.` + '{{ auth()->id() }}')
        .notification((notification) => {
            getNotificationsCount();
        });

    //Notification calls
    $('.notifications-menu').on('click', function () {
        getNotifications();
    });
    $('.markAllRead').on('click', function (e) {
        markAllAsRead();
        e.stopPropagation();
        if ($(this).hasClass('notification-index')) {
        } else {
            getNotifications();
            getNotificationsCount();
            e.stopPropagation();
        }
    });

    function getNotifications() {
        $.ajax({
            method: 'GET',
            url: '{{ route($routePrefix.'notifications.getNotifications') }}',
            success: function (response) {
                $('.notifications-menu').find('.loading').addClass('hide');
                $('.notifications-list').html($(response));
            }, error: function (error) {
                alert('Cannot reach request');
                console.log(error);
                return false;
            }
        });
    }

    function getNotificationsCount() {
        $.ajax({
            method: 'GET',
            url: '{{ route($routePrefix.'notifications.getNotificationCount') }}',
            success: function (response) {
                $('.notification_count').html(response.data);
                $('.notification_count_li').html(response.data);
            }, error: function (error) {
                alert('Cannot reach request');
                console.log(error);
                return false;
            }
        })
    }

    function markAllAsRead() {
        $.ajax({
            method: 'GET',
            url: '{{ route($routePrefix.'notifications.markAllAsRead') }}',
            success: function () {
                return true;
            }, error: function (error) {
                alert('Cannot reach request');
                console.log(error);
                return false;
            }
        })

    }

    function markAsRead(notificationId) {
        {{--axios.get('{!! url('/')  !!}' + '/' + '{{$routePrefix}}' + '/notifications/' + notificationId + '/markAsRead').then((response) => {--}}
        {{--    return true;--}}
        {{--}).catch(function (error) {--}}
        {{--    alert('Cannot reach request');--}}
        {{--    console.log(error);--}}
        {{--    return false;--}}
        {{--});--}}
    }
</script>
