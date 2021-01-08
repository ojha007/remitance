@can('sender-create')
    @extends('backend::common.modal',[
        'id'=>'sender_form',
        'route'=>$routePrefix.'senders.store',
        'title'=>'Add Senders',
        'button'=>'Save',
        'formClass'=>'form-horizontal bootstrap-modal-form'
    ])
@section('sender_form_body')
    <div class="col-md-12">
        @include('backend::senders.partials.form',['button'=>false])
    </div>
@endsection
@endcan




