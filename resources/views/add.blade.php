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

        <h1 align="center">Добавление товара</h1>
        <hr>
  <div class="container">
      <form method="post" action="{{action('ItemsController@save')}}" enctype="multipart/form-data">
        <div class="row">
                        <div class="col-md-4">
                            <input type="file" name="preview" /><br>
                        </div>
                        <div class="col-md-8">
                            <i class="glyphicon glyphicon-arrow-left"></i> Выберите миниатюру для товара. <p class="help-block">Размер изображения 150x150px, не более 200Кб</p>
                        </div>
        </div>
                    <div class="row">
                        <hr>
                        <h3>Дополнительные изображения</h3>
                        <button class="btn btn-primary add_images" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                        <hr>
                    </div>

                      <div class="row">
                          <hr>
                          <h3>Добавить Категорию</h3>
                        <a  class="btn btn-primary " type="button" href="{{action('CategoryController@addview')}}">Add</a>
                          <hr>
                      </div>

                    <div class="row">
                        <div class="col-md-8-offset-4">
                            <label class="control-label">Название товара</label>
                            <input class="form-control" type="text" name="title"/>

                            <label  class="control-label" >Описание товара</label>
                            <textarea class="form-control" rows="4" name="description"></textarea><br/>

                            <label  class="control-label" >Категория</label>
                                <select name="category">
                                @foreach( $categories as $er)
                                      <option value="{{$er->id}}">{{ $er->category }}</option>
                                @endforeach
                                </select>
                            <br/><br/>

                            <label class="control-label" >Цена</label>
                            <input class="form-control" type="text" name="price"/><br/>


                        </div>
                    </div>
        </br>
            <h2>Параметры товара</h2>
            <hr>
            <button class="btn btn-primary btn-md add_button" type="button">Добавить</button><br/><br/><br/>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <button class="btn btn-primary btn-lg add_button" type="submit">Сохранить</button>

      </form>
</div>




</body>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Добавить параметр</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control parameter_modal" name="parameter" placeholder="Наименование параметра"/><br>
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
</html>