<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Orders extends Model
{
    protected $fillable=['item_id','order_id','price','amount','name','address','phone'];

    public function items() //этот метод нам понадобится чуть позже
    {
    return $this->belongsTo('App\Items', 'item_id', 'id');   //связь один к одному
    }

    public static function allorders()
    {
        return DB::table('orders')->groupBy('order_id')->select('order_id',DB::raw('sum(price) as summa'))->get();
    }


}

