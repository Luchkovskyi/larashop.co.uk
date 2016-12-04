<!DOCTYPE html>
<html>
<head>
    <title>Изменение товара</title>
    <script src="{{asset("js/jquery-3.0.0.min.js")}}"></script>
    <script src="{{asset('js/model.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}"/>
    <link rel="stylesheet" href="{{asset("css/bootstrap-theme.css")}}"/>
    <script src="{{asset("js/functions.js")}}"></script>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/style.css")}}"/>
</head>
<body>
<div class="container">
    <h1>Изменение товара</h1>
    <hr>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            @if(!empty($images)) <!-- проверяем если картинки -->
            @foreach($images as $image)
                <div class="img-thumbnail">
                    <img width=100 src="{{$image}}">
                    <button type="button" title="Удалить" class="btn btn-danger del_image btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                </div>
                <input type="hidden" id="item_id" value="{{$item->id}}"/>
            @endforeach
            @endif
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <input type="file" name="preview[]"/><br>
            </div>
            <div class="col-md-8">
                <i class="glyphicon glyphicon-arrow-left"></i> Выберите миниатюру для товара. <p class="help-block">Размер изображения 150x150px, не более 200Кб</p>
            </div>
        </div>
        <hr>
        <h3>Дополнительные изображения</h3><button class="btn btn-primary add_images" type="button"><i class="glyphicon glyphicon-plus"></i></button>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <label class="control-label" for="name">Название товара</label>
                <input class="form-control" type="text" name="title" value="{{$item->title}}" />
                <label for="description" class="control-label">Описание товара</label>
                <textarea class="form-control" rows="4" name="description">{{$item->description}}</textarea>
                <label class="control-label" for="price">Цена</label>
                <input class="form-control" type="text" name="price" value="{{$item->price}}" />
            </div>
        </div>
        <h3>Параметры товара</h3>
        <hr>
        <button class="btn btn-primary btn-lg add_button" type="button">Добавить</button>
        @foreach($parameters as $param)
            <div class="form-inline">
                <div class="form-group">
                    <label for="parameter" class="sr-only">Параметр</label>
                    <div class="input-group">
     <span class="input-group-btn">
     <button class="btn btn-default  add_parameter" type="button"><i class="glyphicon glyphicon-plus"></i></button>
     </span>
                        <select class="form-control" name="parameter[]">
                            @foreach($parameters_all as $parameter)
                             <option value="{{$parameter->id}}">{{$parameter->title}} ({{$parameter->unit}})</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value" class="sr-only">Значение параметра</label>
                        <input class="form-control" name="value[]" value="{{$param->value}}"/>
                    </div>
                    <div class="form-group">
     <span class="input-group-btn">
     <button class="btn btn-default remove_button" type="button"><i class="glyphicon glyphicon-minus"></i></button>
     </span>
                    </div>
                </div>
            </div>
    @endforeach


        <hr>
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <button type="submit" class="btn btn-default btn-lg save_item">Сохранить товар</button>
</form>

</div>









<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить параметр</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control paramenter_modal" name="parameter" placeholder="Наименование параметра"/><br>
                <input type="text" class="form-control unit_modal" name="unit" placeholder="Единица измерения"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary save_and_close">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

</body>
</html>