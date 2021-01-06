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
                            {!! Form::open(['route'=>[$routePrefix.'receivers.destroy',$receiver->id]]) !!}
                            @can('receiver-view')
                                <a href="{{route($routePrefix.'receivers.show',$receiver->id)}}"
                                   class="btn btn-default btn-sm btn-flat">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('receiver-edit')
                                <a href="{{route($routePrefix.'receivers.edit',$receiver->id)}}"
                                   class="btn btn-primary btn-sm btn-flat">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('receiver-delete')
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are You sure to delete ?')"
                                        class="btn btn-danger btn-sm btn-flat">
                                    <i class="fa fa-times"></i>
                                </button>

                            @endcan
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

