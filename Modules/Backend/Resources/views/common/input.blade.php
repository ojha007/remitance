<div class="form-group {{$divClass ?? '' }}  row">
    <label for="{{isset($id) ? $id : strtolower($name)}}"
           class="col-sm-{{isset($classPartition) ? $classPartition : 2 }}
               col-form-label
               text-right
               {{isset($labelClass) ?$labelClass : ''}}
               ">
        {{isset($label) ? $label : ucwords(str_replace('_',' ',str_replace('_id',' ',$name)))}}
        @isset($is_required)
            <span style="color: #ea1a1a">*</span>
        @endisset
    </label>
    <div class="col-sm-{{isset($classPartition) ? 12 - $classPartition : 10}}
    {{ $errors->has($name) ? ' is-invalid': '' }}">
        @if(isset($type) && $type==='checkbox')
            <input type="hidden" name="{{$name}}" value="0">
            <input name="{{$name}}" value="1"
                   class="{{ $errors->has($name) ? ' is-invalid': '' }}"
                   type="checkbox" data-toggle="toggle"
                   data-on="Active" data-off="Inactive">
        @elseif(isset($type) && $type=='select')

            {!! Form::select($name,$options , $default ?? null,
                array(
                "placeholder"=> isset($placeHolder) ? $placeHolder : 'Select '. ucwords(str_replace('id','',str_replace('_',' ',$name))),
                'class' => 'form-control select2',
                'id'=> isset($id) ? $id : strtolower($name),
                'style'=>'width:100%;')) !!}
        @else
            <input type="{{isset($type) ? $type : 'text'}}"
                   @isset( $autofocus)
                   autofocus
                   @endisset
                   class="rounded-0
                   {{isset($type) && $type === 'file'  ? '' : 'form-control'}}
                   {{$class ?? ''}}
                   {{ $errors->has($name) ? ' is-invalid': '' }}"
                   name="{{$name}}"
                   @if(isset($type) && $type==='number')
                   step="any"
                   @endif
                   @if(old($name))
                   value="{{old($name)}}"
                   @elseif(isset($model))
                   value="{{$model->{$name} }}"
                   @endif
                   autocomplete="false"
                   id="{{isset($id) ? $id : strtolower($name)}}"
                   placeholder="{{isset($placeHolder) ? $placeHolder : 'Enter ' . ucwords(str_replace('_',' ',$name))}}">
        @endif
    </div>
</div>

