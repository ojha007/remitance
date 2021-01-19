<!DOCTYPE html>
<html>
<head>
    <title>Registered Remit</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg=="
          crossorigin="anonymous"/>
</head>
<body>
<div class="container">
    <h2>Dear {{$transaction->sender->name}}</h2>
    <p>Thank you for sending money with us. This mail is confirmation that we have received your order.</p>
    <p>Order Id : <strong>{{$transaction->code}}</strong></p>
    <b>Receiver Details:</b>
    <table class="table table-bordered">
        <tr>
            <th>Name:</th>
            <td>{{$transaction->receiver->name}}</td>
        </tr>
        <tr>
            <th>Telephone:</th>
            <td>{{$transaction->receiver->phone_number}}</td>
        </tr>
        <tr>
            <th>Payment Amount:</th>
            <td>NPR {{$transaction->receiving_amount}}</td>
        </tr>
        <tr>
            <th>Payment Type:</th>
            <td>{{$transaction->paymentType->name}}</td>
        </tr>
    </table>
    <p>
        Note :
        # All amount below NPR 1,00,000 will be local Remitted and Remit Charge will be deducted from the receivable
        amount.
        # All amount above NPR 1,00,000 will be bank deposit and any charges by Bank like ABBS charge will be deducted
        from
        receivable amount.
        # Transaction will be completed within 1-2 working days.
    </p>

    <p>Thank You
        Regards
        Registered Remit
        0481007296</p>
    <a href="{{config('app.domain')}}">
        Visit us
    </a>
</div>
