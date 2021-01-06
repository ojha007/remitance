@isset($filterBy)
    {{Form::open(['url'=>request()->url(),'method'=>'GET'])}}
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Advanced Search</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"
                        data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"
                        data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body" style="display: block;">
            <div class="row">
                @foreach($filterBy as $filter)
                    <div class="col-md-3">
                        <label for="{{$filter['name']}}" class="col-form-label">
                            {{isset($filter['label']) ? ucwords($filter['label']) : ucwords($filter['name'])}} :
                        </label>
                        <input class="form-control rounded-0"
                               name="{{$filter['name']}}"
                               placeholder="{{isset($filter['placeholder'])
                                ? $filter['placeholder'] : 'Enter '. ucwords($filter['name'])}}"
                               value="{{request()->get($filter['name'])}}">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn  float-left btn-flat btn-primary">
                <i class="fa fa-search"></i>
                Search
            </button>
        </div>
        <!-- /.card-body -->
    </div>
    {!! Form::close() !!}
@endisset
