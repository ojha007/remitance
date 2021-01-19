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
    Your Order ID : <strong> {{$transaction->code}}</strong> with us has been successfully paid in Nepal.
    <p>
        Thank you for your business with us.
        Please recommend your friends and families to use our service.
        And hope you had a great day.
    </p>
    <p>
        Thank You
        Regards
        Registered Remit
        0481007296
    </p>
    <a href="{{config('app.domain')}}">
        Visit us
    </a>
</div>
