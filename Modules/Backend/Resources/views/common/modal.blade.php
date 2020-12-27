<div class="modal fade " id="{{$id ?? ''}}" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        @isset($route)
            {!!  Form::open(['route'=>$route,'class'=>$formClass ?? ''])!!}
        @endisset
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title ?? ''}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @yield('modal_body')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat float-left" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Close
                </button>
                <button  class="btn btn-primary btn-flat float-right"
                         type="submit">
                    <i class="fas fa-save"></i>
                    {{$button ?? ''}}
                </button>
            </div>
        </div>
    @isset($route)
        {!! Form::close() !!}
    @endisset
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
