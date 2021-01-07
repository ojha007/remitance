@extends('backend::master')

@section('title_postfix', ' | Rates')

@section('header')
    Rates
@stop
@section('subHeader')
    List of Rates
@endsection

@section('breadcrumb')
@endsection
@section('content')
    @php($button ='Save')
    @php($divClass ='12')
    @php($classPartition ='2')
    <div class="row">
        <div class="col-md-12">
            @can('rate-create')
                <div class="box-header">
                    <button data-toggle="modal" data-target="#{{$modal}}"
                            class="btn btn-primary btn-flat pull-right bootstrap-modal-form-open">
                        <i class="fa fa-plus"></i>
                        Add Rates
                    </button>
                </div>
            @endcan
            <div class="box box-default">
                <div class="box-body">
                    <table class="table dataTable table-bordered" id="dataTables">
                        <thead>
                        <tr>
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
        </div>
    </div>

    @include('backend::rates.partials.modal')
@stop
{{--@section('adminlte_js')--}}
@push('scripts')
    <script type="text/javascript">
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
