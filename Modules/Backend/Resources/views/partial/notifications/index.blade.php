@extends('backend::master')
@section('title_postfix', ' | Notification')
@section('header')
    Notifications
@stop
@section('subHeader')
    List of notifications
@endsection

@section('breadcrumb')
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">View All Notifications</h3>
                    <div class="box-tools pull-right" style="cursor: pointer;">
                        <a class="markAllRead"
                           href="{{ route($routePrefix.'notifications.index') }}">Mark All as Read</a></div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-10">
                            <ul class="sidebar-menu notifications-menu notification-view">
                                @include('backend::partial.notifications.bell-notification')
                            </ul>
                        </div>
                        <div class="col-xs-1">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                        </div>
                        <div class="col-xs-10">
                            <span class="pull-right">{{ $notifications->links() }}</span>
                        </div>
                        <div class="col-xs-1">

                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

