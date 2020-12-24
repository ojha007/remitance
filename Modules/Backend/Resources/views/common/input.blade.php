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
        <input type="{{$type ? $type : 'text'}}"
               autofocus="{{$autoFocus ?? ''}}"
               class="form-control {{$class ?? ''}}"
               name="{{$name}}"
               @if($type && $type==='number')
               step="any"
               @endif
               autocomplete="false"
               id="{{isset($id) ? $id : strtolower($name)}}"
               placeholder="{{isset($placeHolder) ? $placeHolder : 'Enter '. ucwords(str_replace('_',' ',$name))}}">
    </div>
</div>

