@extends('backend::master')

@section('title_postfix', 'Role')

@section('content_header')
    <h1>
        Create Role
    </h1>
@endsection
@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('roles.index',$routePrefix) }}--}}
@stop
@section('content')
    <div class="card">
        @can('rate-create')
            <div class="card-header">
                <a href="{{ route($routePrefix.'roles.create') }}"
                   class="btn btn-primary btn-flat float-right ">
                    <i class="fas fa-plus"></i>
                    Add Roles
                </a>
            </div>
        @endcan
        <div class="card-body">
            <table class="table dataTable table-bordered" id="dataTables">
                <thead>
                <tr>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            @can('role-edit')
                                <a class="btn btn-primary btn-flat btn-sm" data-container="body"
                                   title="Edit"
                                   href="{{ route($routePrefix.'roles.edit', $role->id) }}"><i
                                        class="fa fa-edit "></i></a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE', 'route' => [$routePrefix.'roles.destroy', $role->id],
                                     'style'=>'display:inline', 'onsubmit' => "return confirm('Are you sure you want to delete?')"]) !!}
                                {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-danger btn-flat btn-sm', "data-container"=>"body",
                                                 "title"=>"Delete" ,'role' => 'button', 'type' => 'submit']) }}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
