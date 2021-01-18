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
        <div class="col-md-3">
            {{--            <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>--}}

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"><i class="fa fa-inbox"></i> Notifications
                                <span class="label label-primary pull-right">12</span></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i>Mails</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                class="fa fa-square-o"></i>
                        </button>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                        <!-- /.pull-right -->
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            @forelse($notifications as $notification)
                                @php($data = json_decode($notification->data))
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{$notification->id}}" name="notification[]"
                                               class="iCheck">
                                    </td>
                                    <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                    <td class="mailbox-subject">
                                        <a href="{{$data->path}}">
                                            {!! $data->message !!}
                                        </a>
                                    </td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">{{isset($notification->read_at) ? \Carbon\Carbon::parse($notification->read_at)->diffForHumans() : ''}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"><strong>No Any Notifications</strong></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{$notifications->links()}}
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    {{--    <div class="row">--}}
    {{--        <div class="col-xs-12">--}}
    {{--            <div class="box">--}}
    {{--                <div class="box-header">--}}
    {{--                    <h3 class="box-title">View All Notifications</h3>--}}
    {{--                    <div class="box-tools pull-right" style="cursor: pointer;">--}}
    {{--                        <a class="markAllRead"--}}
    {{--                           href="{{ route($routePrefix.'notifications.index') }}">Mark All as Read</a></div>--}}
    {{--                </div>--}}
    {{--                <div class="box-body">--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-xs-1">--}}
    {{--                        </div>--}}
    {{--                        <div class="col-xs-10">--}}
    {{--                            <ul class="sidebar-menu notifications-menu notification-view">--}}
    {{--                                @include('backend::partial.notifications.bell-notification')--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-xs-1">--}}

    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-xs-1">--}}
    {{--                        </div>--}}
    {{--                        <div class="col-xs-10">--}}
    {{--                            <span class="pull-right">{{ $notifications->links() }}</span>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-xs-1">--}}

    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--                <!-- /.box-body -->--}}
    {{--            </div>--}}
    {{--            <!-- /.box -->--}}
    {{--        </div>--}}
    {{--    </div>--}}
@stop

