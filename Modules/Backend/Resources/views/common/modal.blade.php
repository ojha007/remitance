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
               <div class="row">
                   @yield('modal_body')
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button  class="btn btn-primary btn-flat pull-right"
                         type="submit">
                    <i class="fa fa-save"></i>
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
