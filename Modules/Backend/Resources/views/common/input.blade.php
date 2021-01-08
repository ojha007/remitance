<div class="form-group col-md-{{$divClass ?? '' }}    {{ $errors->has($name) ? ' has-error': '' }}">
    <label for="{{isset($id) ? $id : strtolower($name)}}"
           class="col-md-{{isset($classPartition) ? $classPartition : 4 }}
               control-label
               {{isset($labelClass) ? $labelClass : ''}}
               ">
        {{isset($label) ? $label : ucwords(str_replace('_',' ',str_replace('_id',' ',$name)))}}
        @isset($is_required)
            <span style="color: #ea1a1a">*</span>
        @endisset

    </label>
    <div class="col-sm-{{isset($classPartition) ? 12 - $classPartition : 8}}
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
        @elseif(isset($type) && $type=='textarea')
            <textarea
                class="rounded-0 form-control
                   {{$class ?? ''}}"
                name="{{$name}}"
                rows="5"
                id="{{isset($id) ? $id : strtolower($name)}}">
                @if(old($name))
                    {{old($name)}}
                @elseif(isset($model))
                    {{$model->{$name} }}
                @endif
            </textarea>
        @else
            @isset($addOn)
                <div class="input-group">
                    <div class="input-group-addon">
                    <span class="input-group-text">
                        {!! $addOn !!}
                        {{--                        <i class="fas fa-envelope"></i>--}}
                    </span>
                    </div>
                    @endisset
                    <input type="{{isset($type) ? $type : 'text'}}"
                           @isset( $autofocus)
                           autofocus
                           @endisset
                           class="rounded-0
                          {{isset($type) && $type === 'file'  ? '' : 'form-control'}}
                           {{$class ?? ''}}"
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
                    @isset($addOn)
                </div>
            @endisset
        @endif
        @isset($buttonId)
            <button type="button"
                    data-toggle="modal"
                    data-target="{{$buttonId}}"
                    class="btn btn-flat btn-primary {{$buttonClass ?? ''}}"
                    style="margin-top: 2px;">
                <i class="fa fa-user-plus">
                    Add {{ucwords(str_replace('_id',' ',$name))}}
                </i>
            </button>

        @endisset
    </div>
    @isset($buttonId)
        @if($buttonId==='#sender_form')
            <div class="float-left" id="sender-detail" style="margin-top: 2px"></div>
        @else
            <div class="float-right" id="receiver-detail" style="margin-top: 2px"></div>
        @endif
    @endisset
</div>
{{--@dd($name)--}}
{{--@dd($template)--}}
