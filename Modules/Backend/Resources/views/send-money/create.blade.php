@extends('adminlte::page')

@section('title', 'Send Money')

@section('content_header')
    <h1>Send Money</h1>
@endsection
@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('roles.index',$routePrefix) }}--}}
@stop
@section('content')
    @php($divClass ='col-md-6')
    {!! Form::open(['url'=>request()->url()]) !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                @include('backend::common.input',
                ['name'=>'sender_id',
                'is_required'=>true,'type'=>'select',
                'options'=>$selectSenders,'default'=>null])

                @include('backend::common.input',['name'=>'receiver_id',
               'is_required'=>true,'type'=>'select',
               'options'=>[],'default'=>null])

                <div class="col-md-6 row form-group" id="sender-detail"></div>
                <div class="col-md-6 row form-group" id="receiver-detail"></div>
                @include('backend::common.input',['name'=>'sending_amount','type'=>'number','is_required'=>true,'addOn'=>'AUD'])
                @include('backend::common.input',['name'=>'rate','type'=>'number','is_required'=>true])
                @include('backend::common.input',['name'=>'receiving_amount','type'=>'number','is_required'=>true,'addOn'=>'NPR'])
                @include('backend::common.input',['name'=>'charge','type'=>'number','is_required'=>true])
                @include('backend::common.input',
                ['name'=>'payment_type_id',
                'is_required'=>true,'type'=>'select',
                'options'=>[],'default'=>null
                ])
                @include('backend::common.input',
                ['name'=>'pickup_address',
                'is_required'=>true,
                'type'=>'select',
                'options'=>[],'default'=>null])
                @include('backend::common.input',['name'=>'notes','type'=>'textarea'])
                @include('backend::common.input',['name'=>'file','type'=>'file','label'=>'Upload File'])

            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-default btn-flat float-left">
                <i class="fas fa-times"></i>
                Close
            </button>
            <button type="submit" class="btn-primary btn-flat btn float-right">
                <i class="fas  fa-paper-plane"></i> Send Money
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@push('js')
    <script>
        let template = (detail) => `<div class="col-md-2"></div>
                            <div class="col-md-10" style="background-color: #f0f3f5">
                            <div class="card-default">
                                <div class="card-header" style="padding-bottom: 1px;"><div class="card-title">
                                <div class="card-title">
                                    <p>${detail['first_name']}&nbsp;
                                    ${typeof detail['middle_name'] === 'string' ? detail['last_name'] : null}
                                        ${detail['last_name']}&nbsp;
                                        |&nbsp;${detail['code']}</p>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding-top: 2px">
                                 <span>${typeof detail['phone_number'] === 'string' ? detail['phone_number'] : detail['phone_number1']}
                                    |&nbsp;Email&nbsp;:&nbsp;${detail['email']}</span><br>
                                  <span>${detail['country']}, ${detail['state']}</span><hr>
                                  <span> Id&nbsp;:&nbsp;${detail['identity_type']}&nbsp;
                                        |&nbsp;Id Number&nbsp;:&nbsp;${detail['id_number']}
                                        |&nbsp;Issued By&nbsp;:&nbsp;${detail['issued_by'].toUpperCase()}
                                   </span><br>
                                 <span>DOB:&nbsp;${detail['date_of_birth']}&nbsp;
                                |&nbsp;Expiry Date&nbsp;:&nbsp;${detail['expiry_date']}<span>
                                </div>
                                </div>
                           </div>`

        function onSelect2Change(primary, secondary, url) {
            primary.on('change', function () {
                if ($(this).val()) {
                    $.ajax({
                        url: url + '/' + $(this).val(),
                        method: 'GET',
                        success: function (response) {
                            secondary.html(template(response))
                        }
                    });

                } else
                    secondary.html('')
            });
        }

        $(document).ready(function () {
            let senderElement = $('#sender_id');
            let receiverElement = $('#receiver_id');
            onSelect2Change(senderElement, $("#sender-detail"), '{{url('/senders/')}}');
            onSelect2Change(receiverElement, $("#receiver-detail"), '{{url('/receivers/')}}');
            handleOnSelect2Change(senderElement, receiverElement, '{{url('all-receivers-by/sender')}}')
        })
    </script>
@endpush
