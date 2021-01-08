<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon {{$widget['bg']}}">
            <i class="{{$widget['icon']}}"></i>
        </span>
        <div class="info-box-content">
            <span class="info-box-text text-center">{{ucwords($key)}}</span>
            <span class="info-box-number text-center">{{$widget['total']}}</span>
            <a class="btn btn-block" href="{{$widget['url']}}">
                More info
                <i class="fa fa-arrow-circle-right">
                </i>
            </a>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>

