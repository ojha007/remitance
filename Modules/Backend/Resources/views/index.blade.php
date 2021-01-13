@extends('backend::master')
@section('title_postfix', '| Dashboard')
@section('header')
    Dashboard
@stop
@section('subHeader')
    Home
@endsection
@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('roles.index',$routePrefix) }}--}}
@stop
@section('content')
    <div class="row">

        @foreach($widgets as $key=>$widget)
            @include('backend::dashboard.countWidgetTemplate',['widget'=>$widget])
        @endforeach

    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border" style="padding-bottom: 1em">
                    <h3 class="box-title">
                        Latest Transactions
                    </h3>
                    <div class="box-tools pull-right ">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-flat">Status</button>
                            <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu " role="menu">
                                <li><a href="#">All</a></li>
                                <li><a href="#">Awaiting </a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Sender</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($latestTransactions as $transaction)
                            <tr>
                                <td>
                                    <a href="{{route($routePrefix.'transactions.show',$transaction->id)}}"
                                       target="_blank">
                                        {{$transaction->code}}
                                    </a>
                                </td>
                                <td>{{$transaction->sender}}</td>
                                <td>{!! spanByStatus($transaction->status) !!}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <strong>No Transaction is recorded.</strong>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="box-footer">
                        <button class="btn btn-info btn-flat">
                            <i class="fa fa-eye"></i>
                            View All
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border" style="padding-bottom: 1em">
                    <h3 class="box-title">
                        Total Transactions
                    </h3>
                    <div class="box-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-flat">1 Weeks</button>
                            <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-thin"></i>
                                        All</a>
                                </li>
                                <li><a href="#">
                                        <i class="fa fa-circle-thin"></i>
                                        2 Weeks</a></li>
                                <li><a href="#">
                                        <i class="fa fa-circle-thin"></i>
                                        1 Months</a></li>
                                <li><a href="#"><i class="fa fa-circle-thin"></i>
                                        6 Months</a></li>
                                <li><a href="#"><i class="fa fa-circle-thin"></i>
                                        1 Years</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>No.of Orders</th>
                            <th>AUD</th>
                            <th>NPR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($latestTransactions as $transaction)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <strong>No Transaction is recorded.</strong>
                                </td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop
