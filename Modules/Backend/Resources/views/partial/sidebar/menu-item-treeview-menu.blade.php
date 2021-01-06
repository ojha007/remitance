@if(isset($item['submenu']))
    <li @if(isset($item['id'])) id="{{ $item['id'] }}"
        @endif class="treeview {{ $item['submenu_class'] ?? '' }}">
        {{-- Menu toggler --}}
        <a class="{{ $item['class'] ??''}} "
           href="" {!! $item['data-compiled'] ?? '#' !!}>
            <i class="{{ $item['icon'] ?? 'fa fa-circle-thin' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>
            {{ucwords($item['text'])}}
            <i class="fa fa-angle-left right"></i>
            @if(isset($item['label']))
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endif
        </a>
        {{-- Menu items --}}
        <ul class="treeview-menu">
            @each('backend::partial.sidebar.menu-item', $item['submenu'], 'item')
        </ul>

    </li>
@endif
