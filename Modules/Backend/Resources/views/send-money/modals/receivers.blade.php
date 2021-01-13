@can('receiver-create')
    @extends('backend::common.modal',[
            'id'=>'receiver_form',
            'route'=>$routePrefix.'receivers.store',
            'title'=>'Add Receivers',
            'button'=>'Save',
            'formClass'=>'form-horizontal bootstrap-modal-form'
        ])
@section('receiver_form_body')
    <div class="col-md-12">
        <input type="hidden" value="0" name="reload">
        @include('backend::receivers.partials.form',['button'=>false])
    </div>
@endsection
@endcan
