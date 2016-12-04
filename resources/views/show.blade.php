<html>
<head>
    <title>Товар {{$items->title}} </title>
    <script src="{{asset("js/jquery-3.0.0.js")}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrap-theme.min.css")}}"/>
    <script src="{{asset("js/functions.js")}}"></script>

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        Шапка
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @foreach($images as $image)
                <img class="img-thumbnail" width=100 src="{{$image}}">
            @endforeach
        </div>
    </div>
    <h3>{{$items->title}}</h3>
    <div class="panel panel-default">
        <div class="panel-heading">Описание</div>
        <div class="panel-body">
            {{$items->description}}
        </div>
    </div>
    <h3>Параметры</h3>
    <table class="table table-striped">
        <thead>
        <th>Название</th>
        <th>Значение</th>
        <th>Ед. измерения</th>
        </thead>
        <tbody>

        @foreach($parameters as $parameter)
            <tr>
                <td>{{$parameter->title}}</td> <td>{{$parameter->value}}</td><td>{{$parameter->unit}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2 class="text-success">Цена: {{$items->price}} ua.</h2>
    <hr>
    <button class="btn btn-primary btn-lg">Купить</button>
</div>
</body>
</html>