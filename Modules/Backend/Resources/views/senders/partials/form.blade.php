@php($id ='sender')
<div class="sender_box">
    <div class="box  box-default">
        <div class="box-header with-border">
            <h2 class="box-title">
                General Information
            </h2>
        </div>
        <div class="box-body">
            <div class="row">
                @include('backend::common.input',['autofocus'=>true,'name'=>'name','is_required'=>true])
                @include('backend::common.input',['name'=>'email','is_required'=>true,'type'=>'email'])
                @include('backend::common.input',['name'=>'phone_number','is_required'=>true,'type'=>'tel'])
            </div>
        </div>

    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">
                Address Information
            </h2>
        </div>
        {{--    @dd($sender)--}}
        <div class="box-body">
            <div class="row">
                @include('backend::common.input',['name'=>'country_id','is_required'=>true,
                   'type'=>'select',
                   'options'=>$selectCountries,
                   'default'=>$modal->country_id ??  $defaultCountry
                   ])
                @include('backend::common.input',['name'=>'state_id',
                    'is_required'=>true,
                    'type'=>'select',
                    'options'=>$selectStates,
                    'default'=>$modal->state_id ??  null
                    ])
                @include('backend::common.input',['name'=>'suburb_id','is_required'=>true,
                        'type'=>'select',
                        'options'=>$selectSuburbs,
                        'default'=>$modal->suburb_id ??  null
                        ])

                @include('backend::common.input',['name'=>'street','is_required'=>true])
                @include('backend::common.input',['name'=>'post_code','is_required'=>true,'type'=>'number'])


            </div>
        </div>

    </div>

    <div class="box box-warning">
        <div class="box-header with-border">
            <h2 class="box-title">
                Identification Details
            </h2>
        </div>
        <div class="box-body">
            <div class="row">
                @include('backend::common.input',['name'=>'identity_type_id','is_required'=>true,'type'=>'select',
                    'options'=>$selectIdentityTypes,'default'=>$modal->identity_type_id ?? null])
                @include('backend::common.input',['name'=>'issued_by','is_required'=>true,'type'=>'select','options'=>$selectIssuedBy])
                @include('backend::common.input',['name'=>'id_number','is_required'=>true])
                @include('backend::common.input',['name'=>'date_of_birth','is_required'=>true,'type'=>'date'])
                @include('backend::common.input',['name'=>'expiry_date','is_required'=>true,'type'=>'date'])
                @include('backend::common.input',['name'=>'file','label'=>'Upload File','type'=>'file'])
            </div>
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
            let state_id = $('.sender_box #sender_state_id');
            let suburbs = $('.sender_box #sender_suburb_id');
            state_id.on('change', function () {
                suburbs.find('option').not(':first').remove();
            });
            handleOnSelect2Change($('.sender_box #sender_country_id'), state_id, '{{url('/states/country')}}');
            suburbs.select2({
                ajax: {
                    url: function () {
                        return '{{url('/suburbs/state')}}' + '/' + state_id.val();
                    },
                    delay: 250,
                }
            });
            handleOnSelect2Change(suburbs, $('.sender_box #sender_post_code'), '{{url('/postalCode/suburbs')}}');
        })
    </script>
@endpush


