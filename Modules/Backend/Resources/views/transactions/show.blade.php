@extends('backend::master')
@section('title_postfix', ' | Transaction')
@section('header')
    Transaction
@stop
@section('subHeader')
    Transaction detail
@endsection
@section('breadcrumb')
{{--    {!! \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.transactions.show',$transaction->id) !!}--}}
@endsection

@section('content')
    <div class="box-header " style="padding: 15px;">
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right float-right ">
            <div class="btn-group">
                <button type="button" title="Change Status"
                        data-toggle="modal"
                        data-target="#changeStatus"
                        class="btn btn-default btn-flat">
                    Change Status
                </button>
            </div>
            <div class="btn-group">
                <button type="button" title="Print" class="btn btn-default btn-flat">
                    <i class="fa fa-print"></i>
                </button>
                <button type="button" title="PDF" class="btn btn-default btn-flat">
                    <i class="fa fa-file-pdf-o"></i>
                </button>
                <button type="button" title="Download PDF" class="btn btn-default btn-flat">
                    <i class="fa fa-download"></i>
                </button>

            </div>

        </div>
    </div>
    <section class="invoice" style="margin: 0">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Registered Remit
                    <small class="pull-right">Date: {{$transaction->date}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>{{$transaction->sender}}</strong><br>
                    {{$transaction->s_suburb}} - {{$transaction->post_code}}<br>
                    {{$transaction->s_state}}, {{$transaction->s_country}}<br>
                    {!! $transaction->s_phone_number ? 'Phone: '.$transaction->s_phone_number .'<br>' : '' !!}
                    {{$transaction->s_email ? 'Email: '.$transaction->s_email : ''}}
                </address>
            </div>

            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{$transaction->receiver}}</strong><br>
                    {{$transaction->r_state}}<br>
                    {{$transaction->r_district}},{{$transaction->r_country}}<br>
                    {!! $transaction->r_phone_number ? 'Phone: '.$transaction->r_phone_number .'<br>' : '' !!}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice: #{{$transaction->code}}</b><br>
                <br>
                <b>Transaction Status:</b> {!! spanByStatus($transaction->status) !!}<br>
                <b>Payment Type:</b> {{$transaction->payment_type}}<br>
            </div>
            <!-- /.col -->
        </div>
    {{--    @dd()--}}
    <!-- /.row -->

        <!-- Table row -->
        @if($transaction->payment_type == \Modules\Backend\Database\Seeders\PaymentTypeSeeder::BANK_TRANSFER)
            <div class="row">
                <div class="col-xs-12 ">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Bank</th>
                            <th>Branch</th>
                            <th>Account Number</th>
                            <th>Receiving Amount (NPR)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{$transaction->bank}}</td>
                            <td>{{$transaction->branch}}</td>
                            <td>{{$transaction->account_number}}</td>
                            <td>{{number_format($transaction->receiving_amount)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
    @endif
    {{--        @dd($transaction)--}}
    <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->

            <!-- /.col -->
            <div class="col-xs-6 col-xs-offset-6">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th style="width:50%">Sending Amount(AUD):</th>
                            <td>{{number_format($transaction->sending_amount)}}</td>
                        </tr>
                        <tr>
                            <th>Rate</th>
                            <td>{{number_format($transaction->rate)}}</td>
                        </tr>
                        <tr>
                            <th>Charge(AUD)</th>
                            <td>{{number_format($transaction->charge)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-6">
                    <div class="notes">
                        <strong>Notes :</strong> {{$transaction->notes}}
                    </div>
                </div>
                <div class="col-md-6">
                    <strong>Created By :</strong> {{$transaction->created_by}}
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    @include('backend::transactions.changeStatus')
@endsection
