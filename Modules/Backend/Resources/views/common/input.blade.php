<div class="form-group row">
    <label for="{{isset($id) ? $id : strtolower($name)}}"
           class="col-sm-{{isset($classPartition) ? $classPartition : 2 }}
               col-form-label
               text-right
               {{isset($labelClass) ?$labelClass : ''}}
               ">
        {{isset($label) ? $label : ucwords(str_replace('_',' ',$name))}}
        @isset($is_required)
            <span style="color: #ea1a1a">*</span>
        @endisset
    </label>
    <div class="col-sm-{{isset($classPartition) ? 12 - $classPartition : 10}} ">
        @if(isset($type) && $type==='checkbox')
            <input type="hidden" name="{{$name}}" value="0">
            <input name="{{$name}}" value="1"
                   class="{{ $errors->has($name) ? ' is-invalid': '' }}"
                   type="checkbox" data-toggle="toggle"
                   data-on="Active" data-off="Inactive">
        @elseif(isset($type) && $type=='select')
            {!! Form::select($name,$options , $default ?? null,
                array('placeholder' => 'Select Role',
                'class' => 'form-control select2',
                'style'=>'width:100%;')) !!}
        @else
            <input type="{{isset($type) ? $type : 'text'}}"
                   @isset( $autofocus)
                   autofocus
                   @endisset
                   class="form-control {{$class ?? ''}} {{ $errors->has($name) ? ' is-invalid': '' }}"
                   name="{{$name}}"
                   @if(isset($type) && $type==='number')
                   step="any"
                   @endif
                   autocomplete="false"
                   id="{{isset($id) ? $id : strtolower($name)}}"
                   placeholder="{{isset($placeHolder) ? $placeHolder : 'Enter '. ucwords(str_replace('_',' ',$name))}}">
        @endif
    </div>
</div>

