<!DOCTYPE html>
<html>
<head>
    <title>Добавить товар</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="{{asset("js/jquery-3.0.0.min.js")}}"></script>
    <script src="{{asset("js/functions.js")}}"></script>
    <script src="{{asset("js/model.js")}}"></script>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" >
</head>
<body>

<h1 align="center">Добавление категории</h1>
<hr>
<div class="container">
    <form method="post" action="{{action('CategoryController@store')}}">
       <div class="row">
            <div class="col-md-8-offset-4">
                <label class="control-label">Название Категории</label>
                <input class="form-control" type="text" name="category"/><br/>
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="submit" value="Сохранить" />
            </div>
        </div>
        </br>

    </form>
</div>

</body>
</html>