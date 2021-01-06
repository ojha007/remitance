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
    <div class="box-header">
        <a href="{{route($routePrefix.'senders.create')}}"
           class="btn btn-primary btn-flat pull-right">
            <i class="fas fa-plus"></i>
            Add Senders
        </a>
    </div>
    <div class="box">
        <div class="box-body">
            <table class="table dataTable table-bordered" id="dataTables">
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
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#dataTables').dataTable({
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
                    {data: "action", searchable: false, oderable: false},


                ],
                order: [0],
            });
        })
    </script>
@endpush
