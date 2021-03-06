@php($id ='receiver')
<div class="receiver_box">
    <div class="box  box-default">
        <div class="box-header with-border">
            <h2 class="box-title">
                General Information
            </h2>
        </div>
        <div class="box-body">
            <input type="hidden" name="sender_id" value="{{request()->route()->parameter('sender_id') ?? ''}}">
            @include('backend::common.input',['autofocus'=>true,'name'=>'name','is_required'=>true])
            @include('backend::common.input',['name'=>'phone_number','is_required'=>true,'type'=>'tel'])
        </div>

    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            <h2 class="box-title">
                Address Information
            </h2>
        </div>
        <div class="box-body">
            @include('backend::common.input',['name'=>'country_id','is_required'=>true,
                'type'=>'select',
                'options'=>$selectCountries,
                'default'=> $modal->country_id ??  $defaultCountry
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
            @include('backend::common.input',['name'=>'street','is_required'=>true])
        </div>

    </div>

    <div class="box box-warning">
        <div class="box-header with-border">
            <h2 class="box-title">
                Bank Information
            </h2>
        </div>
        <div class="box-body">
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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title ">
                Identification Details
            </h2>
        </div>
        <div class="box-body">
            @include('backend::common.input',['name'=>'identity_type_id','is_required'=>true,'type'=>'select',
                'options'=>$selectIdentityTypes,'default'=>$modal->identity_type_id ?? null])
            @include('backend::common.input',['name'=>'issued_by','is_required'=>true,'type'=>'select','options'=>$selectIssuedBy])
            @include('backend::common.input',['name'=>'id_number','is_required'=>true])
            @include('backend::common.input',['name'=>'date_of_birth','is_required'=>true,'type'=>'date'])
            @include('backend::common.input',['name'=>'expiry_date','is_required'=>true,'type'=>'date'])
            @include('backend::common.input',['name'=>'file','label'=>'Upload File','type'=>'file','inputClass'=>null])
        </div>
        @if($button)
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat pull-right">
                    <i class="fa fa-save">
                        Submit
                    </i>
                </button>
                <a href="{{ route($routePrefix.'senders.index') }}" class="btn btn-default pull-left btn-flat">
                    <i class="fa fa-arrow-left">
                        Cancel
                    </i>
                </a>
            </div>
        @endif
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            let receiver_state = $(".receiver_box #receiver_state_id");
            let receiver_district = $(".receiver_box #receiver_district_id");
            let receiver_country = $('.receiver_box #receiver_country_id');
            $('.receiver_box#addMore').on('click', function () {
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
            receiver_country.val('{{old('country_id')}}').trigger('change');
            @endif
                @if(old('state_id'))
            if (receiver_state.find('option').length > 1) {
                receiver_state.val('{{old('state_id')}}').trigger('change');
            }
            @endif
            handleOnSelect2Change(receiver_country, receiver_state, '{{url('/states/country/')}}');
            handleOnSelect2Change(receiver_state, receiver_district, '{{url('districts/state/')}}');
            // handleOnSelect2Change(receiver_district, $(".receiver_box #receiver_municipality_id"), '{{url('municipalities/district/')}}');
        });
    </script>
@endpush





