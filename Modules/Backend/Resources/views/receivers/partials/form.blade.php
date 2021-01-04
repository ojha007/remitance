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
                @if(is_array($banks))
{{--                    @dd($banks)--}}
                    @foreach($banks as $bank)
                        @include('backend::receivers.partials.bankForm')
                    @endforeach
                @else
                    @include('backend::receivers.partials.bankForm')
                @endif
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
            $('#addMore').on('click', function () {
                let element = $('#bank_table>tbody>tr:last-child');
                let oldSelect2 = element.find('select');
                oldSelect2.select2("destroy");
                let toClone = element.clone(true);
                toClone.find('input').val('');
                toClone.find('.icheckbox_square-blue').remove();
                let newSelect2 = toClone.find('select');
                toClone.find('select').val('').trigger('change');
                newSelect2.select2({dropdownAutoWidth: true})
                $('#bank_table tbody').append(toClone);
                oldSelect2.select2({dropdownAutoWidth: true});

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
            handleOnSelect2Change($('#country_id'), $("#state_id"), '{{url('/states/country/')}}');
            handleOnSelect2Change($("#state_id"), $("#district_id"), '{{url('districts/state/')}}');
            handleOnSelect2Change($("#district_id"), $("#municipality_id"), '{{url('municipalities/district/')}}');
        });
    </script>
@endpush





