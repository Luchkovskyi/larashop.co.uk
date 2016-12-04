<!DOCTYPE html>
<html>
<head>
    <title>корзина</title>
    <script src="{{asset("js/jquery-2.1.4.min.js")}}"></script>
    <script src="{{asset("js/jquery.cookie.js")}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrap-theme.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/style.css")}}"/>
    <script src="{{asset("js/functions.js")}}"></script>
</head>
<body>
<nav class="navbar  navbar-default">
    <div class="container">
        <p class="navbar-text">Магазин</p>
        <a href="/basket" class=" navbar-link navbar-text navbar-right"><span style="font-size:1.5em;" class="glyphicon glyphicon-shopping-cart basket"></span><span class="badge pull-right count_order">0</span></a>
    </div>
</nav>
<div class="container">
    <table class="table">
        <tr>
            <th>Номер заказа</th>
            <th>Сумма заказа</th>
            <th>Действие</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->order_id}}</td>
                <td>{{$order->summa}}</td>
                <td><a href="/orders/{{$order->order_id}}"><i class="glyphicon glyphicon-eye-open"></i> Посмотреть </a></td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>