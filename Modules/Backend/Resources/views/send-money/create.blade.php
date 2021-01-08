@extends('backend::master')

@section('title_postfix', '| Send Money')
@section('header')
    Send Money
@stop
@section('subHeader')
    Send Money
@endsection
@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('roles.index',$routePrefix) }}--}}
@stop
@section('content')
    @php($divClass ='6')
    @php($classPartition ='3')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url'=>request()->url(),'class'=>'form-horizontal' ,'enctype'=>"multipart/form-data"]) !!}
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Send Money
                    </h3>
                </div>
                <div class="box-body">
                    @include('backend::common.input',
                    ['name'=>'sender_id',
                    'is_required'=>true,'type'=>'select',
                    'options'=>$selectSenders,'default'=>null])

                    @include('backend::common.input',['name'=>'receiver_id',
                   'is_required'=>true,'type'=>'select',
                   'options'=>[],'default'=>null])

                    <div class="col-md-6 form-group" id="sender-detail"></div>
                    <div class="col-md-6 form-group" id="receiver-detail"></div>
                    @include('backend::common.input',['name'=>'date','is_required'=>true,'class'=>'datePicker'])
                    @include('backend::common.input',['name'=>'sending_amount','type'=>'number','is_required'=>true,'addOn'=>'AUD'])
                    @include('backend::common.input',['name'=>'rate','type'=>'number','is_required'=>true])
                    @include('backend::common.input',['name'=>'receiving_amount','type'=>'number','is_required'=>true,'addOn'=>'NPR'])
                    @include('backend::common.input',['name'=>'charge','type'=>'number','is_required'=>true,'addOn'=>'AUD'])
                    @include('backend::common.input',
                    ['name'=>'payment_type_id','is_required'=>true,'type'=>'select',
                    'options'=>$selectPaymentTypes,'default'=>null      ])
                    @include('backend::common.input',
                    ['name'=>'pickup_address','is_required'=>true,
                    'type'=>'select', 'options'=>$selectDistricts,'default'=>null])
                    @include('backend::common.input',['name'=>'file','type'=>'file','label'=>'Upload File'])
                    @include('backend::common.input',['name'=>'notes','type'=>'textarea'])

                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left">
                        <i class="fa fa-times"></i>
                        Close
                    </button>
                    <button type="submit" class="btn-primary btn-flat btn pull-right">
                        <i class="fa  fa-paper-plane"></i> Send Money
                    </button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@push('scripts')
    <script>
        let template = (detail) => `<div class="col-md-3"></div>
                            <div class="col-md-9" style="background-color: #f0f3f5;padding-top: 5px">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                             ${detail['first_name']}&nbsp;
                                                ${detail['middle_name'] === 'string'
                                         ? detail['middle_name'] : ''}
                                            ${detail['last_name']}&nbsp;
                                            |&nbsp;${detail['code']}
                                    </h3>
                                 </div>

                                <div class="box-body">
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
            $('#rate').val('10.00');
            let senderElement = $('#sender_id');
            let receiverElement = $('#receiver_id');
            onSelect2Change(senderElement, $("#sender-detail"), '{{url('/senders/')}}');
            onSelect2Change(receiverElement, $("#receiver-detail"), '{{url('/receivers/')}}');
            handleOnSelect2Change(senderElement, receiverElement, '{{url('all-receivers-by/sender')}}');
            $('#sending_amount').on('keyup', function () {
                let rate = parseFloat($('#rate').val());
                $('#receiving_amount').val($(this).val() * rate);
                $('#total').val($(this).val() * rate);
            });
            $('#receiving_amount').on('keyup', function () {
                let rate = parseFloat($('#rate').val());
                $('#sending_amount').val($(this).val() / rate);
                $('#total').val($(this).val());
            });

            $('input[name="rate"]').on('keyup', function () {
                let a = parseFloat($('#sending_amount').val());
                $('#receiving_amount').val($(this).val() * a);
                $('#total').val($(this).val() * a);
            })
            $('#charge').on('change', function () {
                $('#total_charge').val($(this).val())
            });
            @if(old())
            $('#sender_id').val('{{old('sender_id')}}').trigger('change');
            @endif
        })
    </script>
@endpush
