@extends('backend::master')

@section('title_postfix', '| Send Money')
@section('header')
    Send Money
@stop
@section('subHeader')
    Send Money
@endsection
@section('breadcrumb')

@stop
@section('content')
    @php($divClass ='6')
    @php($classPartition ='3')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route'=>$routePrefix.'send-money.store','class'=>'form-horizontal' ,'enctype'=>"multipart/form-data"]) !!}
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Send Money
                    </h3>
                </div>
                <div class="box-body">
                    @include('backend::common.input',
                    ['name'=>'sender_id',
                    'is_required'=>true,
                    'type'=>'select',
                    'options'=>$selectSenders,
                    'default'=>null,
                    'buttonId'=>'#sender_form'
                    ])

                    @include('backend::common.input',[
                    'name'=>'receiver_id',
                    'buttonId'=>'#receiver_form',
                    'is_required'=>true,
                    'type'=>'select',
                    'options'=>[],
                    'default'=>null])
                    @include('backend::common.input',['name'=>'date','is_required'=>true,'type'=>'date','defaultValue'=>now()->format('Y-m-d')])
                    @include('backend::common.input',['name'=>'sending_amount','type'=>'number','is_required'=>true,'addOn'=>'AUD'])
                    @include('backend::common.input',['name'=>'rate','type'=>'number','is_required'=>true])
                    @include('backend::common.input',['name'=>'receiving_amount','type'=>'number','is_required'=>true,'addOn'=>'NPR'])
                    @include('backend::common.input',['name'=>'charge','type'=>'number','is_required'=>true,'addOn'=>'AUD'])
                    @include('backend::common.input',
                    ['name'=>'payment_type_id','is_required'=>true,'type'=>'select',
                    'options'=>$selectPaymentTypes,'default'=>null      ])

                    @include('backend::common.input',
                    ['name'=>'pickup_address','is_required'=>true,'divClass'=>'6 hide',
                    'type'=>'select', 'options'=>$selectPickUpAddress,'default'=>null])

                    @include('backend::common.input',
                    ['name'=>'bank_id','is_required'=>true,
                    'divClass'=>'6 hide',
                    'type'=>'select', 'options'=>[],
                    'default'=>null])
                    <div id="receiver_bank_detail" class="form-group col-md-{{$divClass}}"></div>
                    {{--                    @include('backend::common.input',--}}
                    {{--                   ['name'=>'branch','is_required'=>true, 'divClass'=>'6 hide', 'type'=>'select', 'options'=>[],'default'=>null])--}}
                    {{--                    @include('backend::common.input',['name'=>'account_number','is_required'=>true, 'divClass'=>'6 hide',  'type'=>'select', 'options'=>[], 'default'=>null])--}}
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
    @component('backend::send-money.modals.senders',[
            'selectCountries'=>$senders['selectCountries'],
            'selectStates'=>$senders['selectStates'],
            'selectSuburbs'=>$senders['selectSuburbs'],
            'senders'=>true,
            'divClass'=>'12',
            'classPartition'=>'2',
            'defaultCountry'=>$senders['defaultCountry'],
            'selectIdentityTypes'=>$senders['selectIdentityTypes'],
            'selectIssuedBy'=>$senders['selectIssuedBy']])
    @endcomponent

    @component('backend::send-money.modals.receivers',[
            'selectCountries'=>$receivers['selectCountries'],
            'selectStates'=>$receivers['selectStates'],
            'selectDistricts'=>$receivers['selectDistricts'],
            'selectBanks'=>$receivers['selectBanks'],
            'receivers'=>true,
            'selectIdentityTypes'=>$receivers['selectIdentityTypes'],
            'selectIssuedBy'=>$receivers['selectIssuedBy'],
            'banks'=>null,
            'defaultCountry'=>$receivers['defaultCountry'],
            'divClass'=>'12',
            'classPartition'=>'2'

        ])
    @endcomponent
@endsection
@push('scripts')
    <script>
        let template = (detail) => `<div class="col-md-3"></div>
                            <div class="col-md-9" style="padding-top: 5px">
                            <div class="box box-primary" style="border: 3px solid #d2d6de">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                             ${detail['name']}&nbsp;|&nbsp;${detail['code']}
                                    </h3>
                                 </div>

                                <div class="box-body">
                                 <span>${detail['phone_number']}
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
                let val = $(this).val()
                if (val) {
                    if (primary.is('#sender_id')) {
                        $('#receiver_form input[name="sender_id"]').val(val);
                    }
                    $.ajax({
                        url: url + '/' + val,
                        method: 'GET',
                        success: function (response) {
                            secondary.html(template(response));
                        }
                    });
                } else {
                    secondary.html('');
                    $('input[name="sender_id"]').val('');
                }
            });
        }

        $(document).ready(function () {
            let bankDetails = '';
            $('#rate').val('10.00');
            let senderElement = $('#sender_id');
            let receiverElement = $('#receiver_id');
            let payment_type_id = $('#payment_type_id');
            let bank_id = $('#bak_id');
            onSelect2Change(senderElement, $("#sender-detail"), '{{url('/senders/')}}');
            onSelect2Change(receiverElement, $("#receiver-detail"), '{{url('/receivers/')}}');
            handleOnSelect2Change(senderElement, receiverElement, '{{url('all-receivers-by/sender')}}');
            $('#receiver-detail').on('change', function () {
                $('#pickup_address').val()
            })
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
            @if(old('sender_id'))
            $('#sender_id').val('{{old('sender_id')}}').trigger('change');
            bank_id.val('{{old('bank_id')}}').trigger('change');
            @endif

            @if(old('payment_type_id'))
            payment_type_id.val('{{old('payment_type_id')}}').trigger('change');
            @endif

            handleOnSelect2Change($('#sender_form #receiver_id'), $("#sender_form #bank_id"), '{{url('/sender/bank/')}}');
            handleOnSelect2Change($('#sender_form #sender_state_id'), $("#sender_form #sender_suburb_id"), '{{url('/suburbs/state/')}}');

            payment_type_id.on('change', function () {
                if ($('#sender_id').val() === '') {
                    alert('Receiver should be select before payment type?');
                    return false;
                } else {
                    let value = parseInt($(this).val());
                    let pickupDiv = $('label[for="pickup_address"]').parent('.form-group');
                    let bankDiv = $('label[for="bank_id"]').parent('.form-group');
                    if (value === 1) {
                        pickupDiv.removeClass('hide');
                        bankDiv.addClass('hide');
                    }
                    if (value === 2) {
                        bankDiv.removeClass('hide');
                        pickupDiv.addClass('hide');
                    }
                }
                let text = $(this).find("option:selected").html();
                if (text == '{{\Modules\Backend\Database\Seeders\PaymentTypeSeeder::BANK_TRANSFER}}') {
                    $.ajax({
                        url: '{{url('banks-details/receiver/')}}' + '/' + $('#receiver_id').val(),
                        method: 'GET',
                        success: function (response) {
                            $.each(response['banks'], function (id, bank) {
                                $('#bank_id').append($('<option/>', {
                                    value: id,
                                    text: bank.name
                                }));
                            });
                            bankDetails = Object.assign({}, response['banks']);
                            let defaultBank = response['banks'].filter((a, b) => function () {
                                console.log(a, b);
                                return b['is_default'] === 1 ? a : '';
                            });
                            $('#bank_id').val(defaultBank).trigger('change');
                        }
                    });
                }
            });
            bank_id.on('change', function () {
                let id = $(this).val();
                if (id) {
                    let bankTemplate = (bank) => `<div class="col-md-3"></div>
                                        <div class="col-md-9">
                                        <div class="box box-primary" style="border: 3px solid #d2d6de">
                                        <div class="box-title" style="padding: 10px;">
                                        <p>Bank : ${bank['name']}<p>
                                        <p>Branch : ${bank['branch']}<p>
                                        <p>Account Number : ${bank['account_number']}<p>
                                        </div></div></div>`;
                    $('#receiver_bank_detail').html(bankTemplate(bankDetails[id]))
                }

            })
        })
    </script>
@endpush
