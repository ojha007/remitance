@extends('backend::common.modal',[

            'id'=>$modal,
            'route'=>$routePrefix.'users.store',
            'title'=>'Add New Users',
            'formClass'=>'form-horizontal bootstrap-modal-form'
        ])
@section('modal_body')
    @include('backend::common.input',['name'=>'name','is_required'=>true,'autofocus'=>true])
    @include('backend::common.input',['name'=>'email','type'=>'email','is_required'=>true])
    @include('backend::common.input',['name'=>'is_active','type'=>'checkbox','is_required'=>true])
    @if (Auth::user()->isSuper())
        @include('backend::common.input',['name'=>'is_super','type'=>'checkbox','is_required'=>true])
    @endif
    @include('backend::common.input',['name'=>'roles','type'=>'select','options'=>$roles])
@endsection


