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
                <div class="box-body">
                    <table class="table dataTable table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            {{--                    <th>Address</th>--}}
                            {{--                    <th>Identification</th>--}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#dataTable').dataTable({
                serverSide: true,
                "language": {
                    "processing": '<i class="fas fa-spinner fa-spin"><i>',
                },
                ajax: {
                    url: '{{request()->getBaseUrl()}}',
                    method: 'GET'
                },
                columns: [
                    {data: "code", name: 'code'},
                    {data: "name", name: 'name'},
                    // {data: "address", name: 'address'},
                    // {data: "name", name: 'name'},
                    {data: "is_active", name: 'is_active'},
                    // {data: "customer_rate", name: 'customer_rate'},
                    // {data: "agent_rate", name: 'agent_rate'},
                    {data: "action", searchable: false},


                ],
                order: [0],
            });
        })
    </script>
@endpush
