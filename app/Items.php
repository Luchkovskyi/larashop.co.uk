<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;
use App\Parameters;
use App\Parameters_values;


class Items extends Model
{
    protected $fillable=['title','description','preview','price','categories_id'];

    public static function parameters($id)
    {
        return DB::table('items')->where('items.id','=',$id)
            ->join('parameters_values','parameters_values.items_id','=','items.id')
            ->join('parameters','parameters_values.parameters_id','=','parameters.id')
            ->select('parameters.title','parameters_values.value','parameters.unit','items.preview')->get();
    }

    public static function del($id)
    {
        return DB::table('parameters_values')->where('items_id','=',$id)
            ->join('parameters','parameters_values.parameters_id','=','parameters.id')
            ->delete();
    }

}
