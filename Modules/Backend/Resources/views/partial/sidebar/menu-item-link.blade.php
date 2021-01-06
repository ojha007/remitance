@if(isset($item['url']))
    <li>
        <a  href="{{ url($item['url']) }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
            {!! $item['data-compiled'] ?? '' !!}>
            <i class="{{ $item['icon'] ?? 'fa fa-circle-thin' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}">

            </i>
            {{ucwords($item['text'])}}
            @if(isset($item['label']))
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endif
        </a>
    </li>
@endif
