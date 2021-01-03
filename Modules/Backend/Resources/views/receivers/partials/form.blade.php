@if(request()->route()->parameter('sender_id'))
    <input type="hidden" name="sender_id" value="{{request()->route()->parameter('sender_id')}}">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                General Information
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                @include('backend::common.input',['autofocus'=>true,'name'=>'first_name','is_required'=>true])
                @include('backend::common.input',['name'=>'middle_name'])
                @include('backend::common.input',['name'=>'last_name','is_required'=>true])
                @include('backend::common.input',['name'=>'email','type'=>'email'])
                @include('backend::common.input',['name'=>'phone_number1','is_required'=>true,'type'=>'tel'])
                @include('backend::common.input',['name'=>'phone_number2','type'=>'tel'])
            </div>
        </div>

    </div>
    <div class="card ">
        <div class="card-header">
            <h2 class="card-title">
                Address Information
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                @include('backend::common.input',['name'=>'country_id','is_required'=>true,
                    'type'=>'select',
                    'options'=>$selectCountries,
                    'default'=> $modal->country_id ??  null
                    ])

                @include('backend::common.input',['name'=>'state_id',
                    'is_required'=>true,
                    'type'=>'select',
                    'options'=>$selectStates,
                    'default'=> $modal->state_id ??  null
                    ])
                @include('backend::common.input',['name'=>'district_id',
                        'is_required'=>true,
                        'type'=>'select',
                        'options'=>$selectDistricts,
                        'default'=>$modal->district_id ??  null
                        ])

                @include('backend::common.input',['name'=>'municipality_id',
                            'label'=>'VDC/Municipality',
                            'is_required'=>true,
                            'placeHolder'=>'Select VDC or Municipality',
                            'type'=>'select',
                            'options'=>$selectMps,
                            'default'=>$modal->municipaity_id ??  null
                            ])
                @include('backend::common.input',['name'=>'ward_number','is_required'=>true,'type'=>'number'])
                @include('backend::common.input',['name'=>'tole_number','type'=>'number'])
                @include('backend::common.input',['name'=>'street','is_required'=>true])

            </div>
        </div>

    </div>

    <div class="card ">
        <div class="card-header">
            <h2 class="card-title">
                Bank Information
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-bordered" id="bank_table">
                    <thead>
                    <tr>
                        <th width="30%">Bank Name</th>
                        <th width="25%"> Account Name</th>
                        <th width="25%"> Bank Branch</th>
                        <th width="25%"> Account Number</th>
                        <th width="1%">Is Default</th>
                        <th width="1%">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bank_tr">
                        <td>
                            <div class="form-group">
                                {!! Form::select('bank_id[]',$selectBanks,
                                null,['class'=>'form-control select2 rounded-0 ',
                                'style'=>'width:100%','placeholder'=>'Select Bank']) !!}
                            </div>

                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::text('account_name[]', null,['class'=>'form-control rounded-0',
                                'style'=>'width:100%','placeholder'=>'Enter Account Name']) !!}
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::text('branch[]', null,['class'=>'form-control rounded-0',
                                'style'=>'width:100%','placeholder'=>'Enter Branch']) !!}
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::number('account_number[]', null,['class'=>'form-control rounded-0',
                                'style'=>'width:100%','placeholder'=>'Enter Account Number']) !!}
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label>
                                    <input type="hidden" value="0" name="is_default[]">
                                    {!! Form::checkbox('is_default[]',1,['class'=>'iCheck',]) !!}
                                </label>
                            </div>

                        </td>
                        <td>
                            <button class="btn btn-danger btn-flat btn-sm deleteRow" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">
                            <button class="btn btn-flat btn-primary" type="button" id="addMore">
                                <i class="fa fa-plus">
                                    Add More Banks
                                </i>
                            </button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

    <div class="card ">
        <div class="card-header">
            <h2 class="card-title">
                Identification Details
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                @include('backend::common.input',['name'=>'identity_type_id','is_required'=>true,'type'=>'select',
                    'options'=>$selectIdentityTypes,'default'=>$modal->identity_type_id ?? null])
                @include('backend::common.input',['name'=>'issued_by','is_required'=>true,'type'=>'select','options'=>$selectIssuedBy])
                @include('backend::common.input',['name'=>'id_number','is_required'=>true])
                @include('backend::common.input',['name'=>'date_of_birth','is_required'=>true,'class'=>'datePicker'])
                @include('backend::common.input',['name'=>'expiry_date','is_required'=>true,'class'=>'datePicker'])
                @include('backend::common.input',['name'=>'file','label'=>'Upload File','type'=>'file','inputClass'=>null])
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-flat float-right">
                <i class="fa fa-save">
                    Submit
                </i>
            </button>
            <a href="{{ route($routePrefix.'senders.index') }}" class="btn btn-default float-left btn-flat">
                <i class="fa fa-arrow-left">
                    Cancel
                </i>
            </a>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function () {
                onCountryChange.init();
                onStateChange.init();
                onDistrictChange.init();
                $('#addMore').on('click', function () {
                    let toClone = $('#bank_table>tbody>tr:last-child').clone();
                    toClone.find('input').val('');
                    // toClone.find('select').select2("destroy");
                    toClone.find('select').val('').trigger('change');
                    // toClone.find('select').select2({dropdownAutoWidth: true});
                    $('#bank_table tbody').append(toClone)
                });
                $('table').on('click', '.deleteRow', function () {
                    if ($(this).closest('tr').is(':first-child')) {
                        return false;
                    } else {
                        $(this).closest('tr').remove();
                    }
                })
                @if(old('country_id'))
                $('#country_id').val('{{old('country_id')}}').trigger('change');
                @endif
                    @if(old('state_id'))
                if ($('#state_id > option').length > 1) {
                    $('#state_id').val('{{old('state_id')}}').trigger('change');
                }
                @endif
            });
            const onCountryChange = {
                element: $("#country_id"),
                init: function () {
                    this.bindUIActions();
                },
                bindUIActions: function () {
                    this.element.on('change', function () {
                        $("#state_id").find('option').not(':first').remove();
                        $.ajax({
                            url: '{{url('/states/country')}}' + '/' + $(this).val(),
                            method: 'GET',
                            success: function (response) {
                                let states = response.states;
                                $.each(states, function (value, text) {
                                    $('#state_id').append($('<option/>', {
                                        value: value,
                                        text: text
                                    }));
                                });

                            }
                        });
                    });
                }
            }
            const onStateChange = {
                element: $("#state_id"),
                init: function () {
                    this.bindUIActions();
                },
                bindUIActions: function () {
                    this.element.on('change', function () {
                        $("#district_id").find('option').not(':first').remove();
                        if ($(this).val()) {
                            $.ajax({
                                url: '{{url('/districts/state')}}' + '/' + $(this).val(),
                                method: 'GET',
                                success: function (response) {
                                    let states = response['districts'];
                                    $.each(states, function (value, text) {
                                        $('#district_id').append($('<option/>', {
                                            value: value,
                                            text: text
                                        }));
                                    });

                                }
                            });
                        }

                    });
                }
            }
            const onDistrictChange = {
                element: $("#district_id"),
                init: function () {
                    this.bindUIActions();
                },
                bindUIActions: function () {
                    this.element.on('change', function () {
                        $("#municipality_id").find('option').not(':first').remove();
                        if ($(this).val()) {
                            $.ajax({
                                url: '{{url('/municipalities/district')}}' + '/' + $(this).val(),
                                method: 'GET',
                                success: function (response) {
                                    let states = response['municipalities'];
                                    $.each(states, function (value, text) {
                                        $('#municipality_id').append($('<option/>', {
                                            value: value,
                                            text: text
                                        }));
                                    });

                                }
                            });
                        }

                    });
                }
            }

        </script>
    @endpush
@else
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                Senders
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                @include('backend::common.input',[
                    'name'=>'sender_id',
                    'is_required'=>true,
                    'type'=>'select',
                    'label'=>'Select Senders',
                    'options'=>$selectSenders,
                    ])
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function () {
                $("#sender_id").on('change', function () {
                    if ($(this).val()) {
                        window.location.href = '/receivers/create/senders/' + $(this).val();
                    }
                });

            })
        </script>
    @endpush
@endif




