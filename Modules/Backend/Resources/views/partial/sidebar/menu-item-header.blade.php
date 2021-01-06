@if(isset($item['header']))
    <li class="header {{isset( $item['class']) ?? '' }}">
        {{ is_string($item) ? $item : \Illuminate\Support\Str::upper($item['header']) }}
    </li>
@endif
