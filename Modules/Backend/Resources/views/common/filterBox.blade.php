@isset($filterBy)
    {{Form::open(['url'=>request()->url(),'method'=>'GET'])}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Advanced Search</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool"
                        data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
        <div class="card-body" style="display: block;">
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
        <div class="card-footer">
            <button type="submit" class="btn  float-left btn-flat btn-primary">
                <i class="fa fa-search"></i>
                Search
            </button>
        </div>
        <!-- /.card-body -->
    </div>
    {!! Form::close() !!}
@endisset
