<!DOCTYPE html>
<html>
<head>
    <title>Заказ принят</title>
</head>
<body>
<div class="container">
    <h2>Ваш заказ принят!</h2>
    <table width=90%  align="center" border>
        <thead>
        <tr>
            <th>Идентификатор</th>
            <th>Изображение</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Итого</th>
        </tr>
        </thead>
        @foreach($orders as $order)
            <tr>
                <td align="center">{{$order->item_id}}</td>
                <td align="center" ><img height=50 src="{{$order->items->preview}}"></td>
                <td align="center">{{$order->items->title}}</td>
                <td align="center">{{$order->price}}</td>
                <td align="center">{{$order->amount}}</td>
                <td align="center">{{$order->price*$order->amount}}
            </tr>
        @endforeach
    </table>
    <h2>Общая сумма заказа: {{$total}}    </h2>
    <hr>
    <h2>Информация о доставке</h2>
    Адресс:{{$orders[0]->address}}<br>
    Имя: {{$orders[0]->name}}<br>
    Телефон: {{$orders[0]->phone}}<br>
</div>
</body>
</html>