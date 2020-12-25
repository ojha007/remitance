@extends('adminlte::page')

@section('title', 'Role')

@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('roles.create',$routePrefix) }}--}}
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(array('route' => $routePrefix.'roles.store','method'=>'POST','class'=>'form-horizontal')) !!}
            <div class="col-md-6">
                @include('backend::common.input',['name'=>'name','is_required'=>true])
            </div>
            <hr>
        @include('backend::permissions.index')
        <!-- /.box-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-flat float-right">
                    <i class="fa fa-save">
                        Submit
                    </i>
                </button>
                <a href="{{ route($routePrefix.'roles.index') }}" class="btn btn-default float-left btn-flat">
                    <i class="fa fa-arrow-left">
                        Cancel
                    </i>
                </a>
            </div>
        {!! Form::close() !!}
        <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

