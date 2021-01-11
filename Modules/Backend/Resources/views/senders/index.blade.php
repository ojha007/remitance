@extends('backend::master')
@section('title_postfix', ' | Senders')
@section('header')
    Senders
@stop
@section('subHeader')
    List of Senders
@endsection
@section('breadcrumb')
@endsection

@section('content')
    @include('backend::common.filterBox',
        ['filterBy'=>[
                ['name'=>'name'],

            ]
          ])
    <div class="row">
        <div class="col-md-12">
            @can('sender-create')
                <div class="box-header">
                    <a href="{{route($routePrefix.'senders.create')}}"
                       class="btn btn-primary btn-flat pull-right">
                        <i class="fa fa-plus"></i>
                        Add Senders
                    </a>
                </div>
            @endcan

            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <div class="form-group">
                            <input type="text"
                                   placeholder="Search......"
                                   name="q"
                                   value="{{request()->get('q')}}"
                                   class="form-control select2-search">
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($senders as $sender)
                            <tr>
                                <td>{{$sender->code}}</td>
                                <td>{{$sender->name}}</td>
                                <td>
                                    {{$sender->street}},{{$sender->suburb}}, {{$sender->states}}
                                </td>
                                <td>{!! spanByStatus($sender->is_active) !!}</td>
                                <td>
                                    @inject('dataTableButton','\Modules\Backend\Http\Services\DataTableButton')
                                    @can('sender-view')
                                        {!! $dataTableButton->viewButton($routePrefix.'senders.show',$sender->id) !!}
                                    @endcan
                                    @can('sender-edit')
                                        {!! $dataTableButton->editButton($routePrefix.'senders.show',$sender->id) !!}
                                    @endcan
                                    @can('sender-delete')
                                        {!! $dataTableButton->deleteButton($routePrefix.'senders.show',$sender->id) !!}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <strong>
                                        No senders is recorded.
                                    </strong>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="float-right pull-right">
                        {{$senders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

