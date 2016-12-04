<!DOCTYPE html>
<html>
<head>
    <title>Магазин</title>
    <script src="{{asset("js/jquery-3.0.0.js")}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrap-theme.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/style.css")}}"/>
    <script src="{{asset("js/functions.js")}}"></script>
    <script src="{{asset("js/jquery.cookie.js")}}"></script>
</head>
<body>
<nav class="navbar  navbar-default">
    <div class="container">
        <p class="navbar-text"><a href="/"></a>InternetShop </p>
        <!-- корзина -->
        <a href="/basket" class=" navbar-link navbar-text navbar-right">
            <span style="font-size:1.5em;" >Корзина</span>
            <span class="badge pull-right count_order" >0</span>
        </a>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-lg-3 col-xs-4-offset-4 col-sm-4-offset-4">

            <form method="post" action="{{action('ItemsController@showGoods')}}" >
                <label  class="control-label"> Выберите категорию товара:</label>
                <div id="selcat">
                    <select class="form-control" name="categoria" id="sel">
                        @foreach( $categories as $er)
                            <option value="{{$er->id}}">{{ $er->category }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <button class="btn btn-primary btn-sm add_button" type="submit" id="but">найти</button>
                </div>
            </form>


        </div>


        @foreach($items as $item)
            <div class="col-md-3 col-lg-3 col-xs-4-offset-4 col-sm-4-offset-4">
                <div class="thumbnail">
                    <img height=100 src="{{explode(';',$item->preview)[0]}}" alt="">     <!-- первая картинка в поле preview в базе -->
                    <div class="caption">
                        <h3>{{$item->title}}</h3>
                        <p>Цена:<span class="price">{{$item->price}}</span> грн.</p>
                        <p>
                            <a href="#" class="btn btn-primary buy-btn" id="{{$item->id}}" role="button">Купить</a>
                            <a href="/show/{{$item->id}}" class="btn btn-default" role="button">Подробнее</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>