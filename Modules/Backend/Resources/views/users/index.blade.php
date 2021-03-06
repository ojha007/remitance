@extends('backend::master')
@section('title_postfix', ' | Users')
@section('header') Users @stop
@section('subHeader') List @endsection

@section('breadcrumb')
    {{--    {{ Breadcrumbs::render('user',$routePrefix) }}--}}
@stop
@section('content')
    @php($button ='Save')
    @php($divClass ='12')
    @php($classPartition ='2')
    @can('user-create')
        @include('backend::users.partials.modal')
    @endcan
    <div class="row">
        <div class="col-md-12">
            @can('user-create')
                <div class="box-header">
                    <button class="btn btn-primary btn-flat pull-right  bootstrap-modal-form-open"
                            data-toggle="modal"
                            data-target="#{{$modal ?? ''}}">
                        <i class="fa fa-user-plus"></i>
                        Add User
                    </button>

                </div>
            @endcan
            <div class="box box-default">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-condensed dataTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th class="no-sort action-col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-success btn btn-flat ">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge bg-primary btn btn-flat">Active</span>
                                    @else
                                        <span class="badge bg-danger btn btn-flat">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @can('user-edit')
                                        <button class="btn btn-primary edit-button btn-sm btn-flat" data-toggle="modal"
                                                data-container="body" data-tooltip="tooltip"
                                                title="Edit" data-placement="bottom"
                                                data-target="#modal-edit" value="{{ $user->id }}"><i
                                                class="fa fa-edit "></i></button>
                                    @endcan
                                    @if( $user->id != auth()->id())
                                        @can('user-delete')
                                            {!! Form::open(['method' => 'DELETE', 'route' => [$routePrefix.'users.destroy', $user->id], 'style'=>'display:inline', 'onsubmit' => "return confirm('Are you sure you want to delete?')"]) !!}
                                            {{ Form::button('<i class="fa fa-times"></i>',
                                                ['class' => 'btn btn-danger btn-sm btn-flat',
                                                'role' => 'button', 'type' => 'submit',"data-container"=>"body",
                                                 "data-tooltip"=>"tooltip",
                                                 "title"=>"Delete", "data-placement"=>"bottom"]) }}
                                            {!! Form::close() !!}
                                        @endcan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!-- /.box -->

@endsection


@push('scripts')

    <script>
        $(document).ready(function () {
            @if (Auth::user()->isSuper())
            $("input[name='super']").on('ifChecked', function (event) {
                $("select[name='roles']").val('1');
            });
            $("input[name='super']").on('ifUnchecked', function (event) {
                $("select[name='roles']").val('');
            });
            @endif
        });
    </script>

@endpush
