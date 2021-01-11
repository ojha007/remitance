@extends('backend::master')

@section('title_postfix', ' | Receivers')

@section('header')
    Receivers
@stop
@section('subHeader')
    List of Receivers
@endsection
@section('breadcrumb')
@endsection
@section('content')
    @include('backend::common.filterBox',
           ['filterBy'=>
               [
                   ['name'=>'name'],
               ]
             ])

    <div class="box-header">
        <a href="{{route($routePrefix.'receivers.create')}}"
           class="btn btn-primary btn-flat pull-right">
            <i class="fa fa-plus"></i>
            Add Receivers
        </a>
    </div>

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
            <table class="table dataTable table-bordered" id="dataTables">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    {{--                    <th>Status</th>--}}
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($receivers as $receiver)
                    <tr>
                        <td>{{$receiver->code}}</td>
                        <td>{{ucwords($receiver->first_name)}} {{ucwords($receiver->middle_name)}} {{ ucwords($receiver->last_name) }}</td>

                        <td>{{$receiver->phone_number1}} {{ $receiver->phone_number2 ? ' ,'.$receiver->phone_number2 : '' }}</td>
                        <td>
                            {{ucwords($receiver->district)}}
                            -{{$receiver->ward_number}}, {{ucwords($receiver->street)}}

                        </td>
                        <td>
                            @inject('dataTableButton','\Modules\Backend\Http\Services\DataTableButton')
                            @can('receiver-view')
                                {!! $dataTableButton->viewButton($routePrefix.'receivers.show',$receiver->id) !!}
                            @endcan
                            @can('receiver-edit')
                                {!! $dataTableButton->editButton($routePrefix.'receivers.show',$receiver->id) !!}
                            @endcan
                            @can('receiver-delete')
                                {!! $dataTableButton->deleteButton($routePrefix.'receivers.show',$receiver->id) !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

