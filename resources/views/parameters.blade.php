<div class="form-inline borderes" role="form">
    <div class="form-group">
        <label for="parameter" class="sr-only">Параметр</label>
        <div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default  add_parameter" type="button"><i class="glyphicon glyphicon-plus"></i></button>
<button class="btn btn-default remove_button"><i class="glyphicon glyphicon-minus"></i></button>
</span>
            <select class="form-control" name="parameter[]">
                @foreach($parameters as $parameter)
                    <option value="{{$parameter->id}}">{{$parameter->title}} ({{$parameter->unit}})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="value" class="sr-only">Значение параметра</label>
            <input class="form-control" name="value[]" placeholder="Значение параметра"/>
        </div>
        <div class="form-group">

        </div>


</div>
</div>


