@foreach( $notifications as $notification)
    <li class="@if(!$notification['read_at']) unRead
@endif">
        <a href="{{ $notification['data']['routes'] }}"
           onclick="return markAsRead('{{ $notification['id'] }}')">
            <i class="{{ isset($notification['data']['icon'])?$notification['data']['icon']:''}}">
            </i> {{ $notification['data']['message'] }}</a></li>
@endforeach
