@extends('backend::master')
@section('title_postfix', ' | Receiver')
@section('header')
    Receiver
@stop
@section('subHeader')
    Receiver details
@endsection
@section('breadcrumb')
    {!! \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.receivers.show',$receiver[0]) !!}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary box-outline">
                <div class="box-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{$receiver[0]->file ??  asset('backend/images/user-128x128.png')}}"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">
                        {{ucwords($receiver[0]->name)}}
                    </h3>
                    <p class="text-muted text-center">{{$receiver[0]->code}}</p>
                    <div class="text-center">
                        {!! spanByStatus($receiver[0]->is_active) !!}
                    </div>
{{--                    <p class="text-muted text-center">{{$receiver[0]->email}}</p>--}}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box ">
                <div class="box-header">
                    <h3 class="box-title">About {{ucwords($receiver[0]->name)}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-user"></i>Personal Information</strong>
                    <br>
                    <span class="text-muted">
                        Number: {{$receiver[0]->phone_number  }}
                    </span>
                    <br>
                    <span class="text-muted">
                        DOB: {{$receiver[0]->date_of_birth  }}
                    </span>

                    <hr>

                    <strong><i class="fa fa-map-marker"></i> Location</strong>

                    <p class="text-muted">
{{--                        Ward NO: {{ucwords($receiver[0]->ward_number)}}<br>--}}
                        Street : {{ucwords($receiver[0]->street)}}<br>
                        District : {{ucwords($receiver[0]->district)}}<br>
                        State : {{ucwords($receiver[0]->state)}}<br>
                        Country : {{ucwords($receiver[0]->country)}}

                    </p>

                    <hr>
                    <strong>
                        <i class="fa fa-file"></i>
                        Identification
                    </strong>
                    <br>
                    <span class="text-muted">
                        Identity Type : {{ucwords($receiver[0]->identity_type)}}
                    </span>
                    <br>
                    <span class="text-muted">
                        Identity Number : {{$receiver[0]->id_number}}
                    </span>
                    <br>
                    <span class="text-muted">
                        Issued By : {{\Modules\Backend\Entities\Receiver::getIssuedByArray()[$receiver[0]->issued_by]}}
                    </span>
                    <br>
                    <span class="text-muted">
                        Expiry date : {{$receiver[0]->expiry_date}}
                    </span>
                </div>
                <!-- /.box-body -->


                <div class="box-footer">
                    @can('receiver-delete')
                        {!! Form::open(['route'=>[$routePrefix.'receivers.destroy',$receiver[0]->id]]) !!}
                        @method('DELETE')
                        <button type="submit"
                                onclick="confirm('Are You sure to delete the receiver ?')"
                                class="btn btn-flat btn-danger pull-right">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        {!! Form::close() !!}
                    @endcan
                    @can('receiver-edit')
                        <a href="{{route($routePrefix.'receivers.edit',$receiver[0]->id)}}"
                           class="btn btn-primary  pull-left btn-flat"
                           type="submit">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    @endcan
                </div>


            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box">
                <div class="box-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item">
                            <a class="nav-link " href="#banks" data-toggle="tab">Banks Details</a>
                        </li>
                    </ul>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                         alt="user image">
                                    <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                    <span class="description">Shared publicly - 7:30 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                        Like</a>
                                    <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                                </p>

                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                         alt="User Image">
                                    <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore the hate as they create awesome
                                    tools to help create filler text for everyone from bacon lovers
                                    to Charlie Sheen fans.
                                </p>

                                <form class="form-horizontal">
                                    <div class="input-group input-group-sm mb-0">
                                        <input class="form-control form-control-sm" placeholder="Response">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-danger">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.post -->

                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg"
                                         alt="User Image">
                                    <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                                    <span class="description">Posted 5 photos - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                                <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <p>
                                    <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                    <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                        Like</a>
                                    <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                                </p>
                                <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane " id="banks">
                            <!-- The timeline -->
                            <table class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bank Name</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Branch</th>
                                    <th>Default</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($receiver as $r)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$r->bank_name}}</td>
                                        <td>{{$r->account_name}}</td>
                                        <td>{{$r->account_number}}</td>
                                        <td>{{$r->branch}}</td>
                                        <td>
                                            {{$r->is_default === 1 ? 'Yes' : 'No'}}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.box-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
