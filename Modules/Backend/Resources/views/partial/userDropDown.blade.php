<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{asset('backend/images/user2-160x160.jpg')}}" class="user-image" alt="User Image">
        <span class="hidden-xs">{{auth()->user()->name}}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{asset('backend/images/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            <p>{{auth()->user()->name}}
                <small>{{auth()->user()->email}}</small>
                <small>{{\Carbon\Carbon::parse(auth()->user()->created_at)->diffForHumans()}}</small>
            </p>
        </li>
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <a href="#" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>
    </ul>
</li>

