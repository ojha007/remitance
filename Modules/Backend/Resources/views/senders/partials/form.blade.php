<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            General Information
        </h2>
    </div>
    <div class="card-body">
        <div class="row">
            @include('backend::common.input',['autofocus'=>true,'name'=>'first_name','is_required'=>true])
            @include('backend::common.input',['name'=>'last_name','is_required'=>true])
            @include('backend::common.input',['name'=>'email','is_required'=>true,'type'=>'email'])
            @include('backend::common.input',['name'=>'phone_number','is_required'=>true,'type'=>'tel'])
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
            @include('backend::common.input',['name'=>'street','is_required'=>true])
            @include('backend::common.input',['name'=>'suburb','is_required'=>true,'type'=>'select','options'=>[]])
            @include('backend::common.input',['name'=>'state','is_required'=>true,'type'=>'select','options'=>$selectStates])
            @include('backend::common.input',['name'=>'post_code','is_required'=>true])
            @include('backend::common.input',['name'=>'country','is_required'=>true,'type'=>'select','options'=>$selectCountries])
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
            @include('backend::common.input',['name'=>'id_type','is_required'=>true,'type'=>'select','options'=>$selectIdentityTypes])
            @include('backend::common.input',['name'=>'issued_by','is_required'=>true,'type'=>'select','options'=>[]])
            @include('backend::common.input',['name'=>'id_number','is_required'=>true])
            @include('backend::common.input',['name'=>'date_of_birth','is_required'=>true,'class'=>'datePicker'])
            @include('backend::common.input',['name'=>'expiry_date','is_required'=>true,'class'=>'datePicker'])
            @include('backend::common.input',['name'=>'expiry_date','label'=>'Upload File','class'=>'datePicker','type'=>'file','inputClass'=>null])
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


