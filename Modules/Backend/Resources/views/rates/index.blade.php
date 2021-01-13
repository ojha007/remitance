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
                            <th>Date</th>
                            <th>Customer Rate</th>
                            <th>Agent Rate</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($rates as $rate)
                            <tr>
                                <td>{{$rate->date}}</td>
                                <td>{{$rate->customer_rate}}</td>
                                <td>{{$rate->agent_rate}}</td>
                                <td>
                                    @inject('dataTableButton','\Modules\Backend\Http\Services\DataTableButton')
                                    @can('rate-edit')
                                        {!! $dataTableButton->editButton($routePrefix.'rates.edit',$rate->id) !!}
                                    @endcan
                                    @can('rate-delete')
                                        {!! $dataTableButton->deleteButton($routePrefix.'rates.destroy',$rate->id) !!}
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    No rates is recorded
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend::rates.partials.modal')
@stop

