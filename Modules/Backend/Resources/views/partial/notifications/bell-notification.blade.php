@foreach( $notifications as $notification)
    <li class="@if(!$notification['read_at']) unRead
@endif">
        <a href="{{ $notification['route']}}" title="{!! $notification['message'] !!}"
           onclick="return markAsRead('{{ $notification['id'] }}')">
            <i class="{{ isset($notification['icon']) ? $notification['icon']:' fa fa-circle'}}"></i>
            {!! $notification['message'] !!}
        </a>
    </li>
@endforeach
