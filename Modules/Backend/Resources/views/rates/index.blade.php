@extends('adminlte::page')

@section('title', 'Rates')

@section('content_header')
    <h1>
        Rates
    </h1>
@stop
@section('content')
    @php($button ='Save')
    <div class="card">
        @can('rate-create')
            <div class="card-header">
                <button data-toggle="modal" data-target="#{{$modal}}"
                        class="btn btn-primary btn-flat float-right bootstrap-modal-form-open">
                    <i class="fas fa-plus"></i>
                    Add Rates
                </button>
            </div>
        @endcan
        <div class="card-body">
            <table class="table dataTable table-bordered" id="dataTables">
                <thead>
                <tr>
{{--                    <th>S.No</th>--}}
                    <th>Date</th>
                    <th>Customer Rate</th>
                    <th>Agent Rate</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('backend::rates.partials.modal')
@stop
{{--@section('adminlte_js')--}}
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
                    // {data: "id", name: 'id'},
                    {data: "date", name: 'date'},
                    {data: "customer_rate", name: 'customer_rate'},
                    {data: "agent_rate", name: 'agent_rate'},
                    {data: "action", searchable: false, oderable: false},


                ],
                order: [0],
            });
        })
    </script>
@endpush
{{--@endsection--}}
