@extends('adminlte::page')

@section('title', 'Senders')

@section('content_header')
    <h1>Senders</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route($routePrefix.'senders.create')}}"
               class="btn btn-primary btn-flat float-right">
                <i class="fas fa-plus"></i>
                Add Senders
            </a>
        </div>
        <div class="card-body">
            <table class="table dataTable table-bordered" id="dataTables">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Identification</th>
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
