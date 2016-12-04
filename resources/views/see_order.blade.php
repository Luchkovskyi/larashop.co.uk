<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="{{asset("js/jquery-3.0.0.js")}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrap-theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/style.css")}}"/>
    <script src="{{asset("js/functions.js")}}"></script>
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 offset-md-10 col-lg-10 offset-lg-6">
            <h3>Number order№ {{$orders->id}}</h3>
            <h3>Title: {{$items->title}}</h3>
            <h3>Price: {{$items->price}}</h3>
            <h3>Amount number № {{$orders->amount}}</h3>
            <h3>Name people: {{$orders->name}}</h3>
            <h3>Address:  {{$orders->address}}</h3>
            <h3>Phone: {{$orders->phone}}</h3>
        </div>
    </div>
</div>



</body>
</html>

