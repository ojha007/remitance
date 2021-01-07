@extends('backend::master')
@section('title_postfix', ' | Create Roles')
@section('header') Roles @stop
@section('subHeader') Create @endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    {!! Form::open(array('route' => $routePrefix.'roles.store','method'=>'POST','class'=>'form-horizontal')) !!}
                    <div class="col-md-12">
                        <div class="col-md-6">
                            @include('backend::common.input',['name'=>'name','is_required'=>true])
                        </div>
                    </div>
                @include('backend::permissions.index')
                <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat pull-right">
                            <i class="fa fa-save">
                                Submit
                            </i>
                        </button>
                        <a href="{{ route($routePrefix.'roles.index') }}" class="btn btn-default pull-left btn-flat">
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
        </div>
    </div>
@endsection

