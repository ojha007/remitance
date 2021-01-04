@extends('adminlte::page')
@section('title', 'Receivers')
@section('content_header')
    <h1>Add Receiver</h1>
@stop
@section('content')
    @php($classPartition =3)
    @php($divClass='col-md-10')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                Senders
            </h2>
        </div>
        <div class="card-body">
            <div class="row">
                @include('backend::common.input',[
                    'name'=>'sender_id',
                    'is_required'=>true,
                    'type'=>'select',
                    'label'=>'Select Senders',
                    'options'=>$selectSenders,
                    ])
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function () {
                $("#sender_id").on('change', function () {
                    if ($(this).val()) {
                        window.location.href = '/receivers/create/senders/' + $(this).val();
                    }
                });

            })
        </script>
    @endpush
@endsection
