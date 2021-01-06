@extends('backend::master')
@section('title_postfix', ' | Senders')
@section('header') Senders @stop
@section('subHeader') Select Senders @endsection
@section('content')
    @php($classPartition =3)
    @php($divClass='col-md-10')
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">
                Senders
            </h2>
        </div>
        <div class="box-body">
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
