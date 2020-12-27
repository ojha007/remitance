@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
    <i class="fa fa-fw fa-key"></i>
    Edit Role
@endsection

{{--@section('subHeader')--}}
{{--    Edit role--}}
{{--@endsection--}}
{{--@section('breadcrumb')--}}
{{--    {{ Breadcrumbs::render('roles.edit',$role, $routePrefix) }}--}}
{{--@stop--}}
@section('content')
    <div class="row">
        <div class="col-xs-12">
            {{--            {!! Form::model($role,array('route' => [$routePrefix.'roles.update', $role->id], 'method' => 'PATCH','class'=>'form-horizontal')) !!}--}}
            <div class="box">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                        {{ Form::label('name', 'Name:', ['class'=>'col-sm-2 control-label'])}}
                        <div class="col-sm-4">
                            {!! Form::text('name', $role->name , array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    {{--                    @include('auth::permissions.index')--}}
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat  pull-right">
                        <i class="fa fa-save">
                            Submit
                        </i>
                    </button>
                    {{--                    <a href="{{ route($routePrefix.'roles.index') }}" class="btn btn-default btn-flat">--}}
                    <i class="fa fa-arrow-left">
                    </i>
                    Cancel
                    {{--                    </a>--}}
                </div>
            </div>
        {{--        {!! Form::close() !!}--}}
        <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

