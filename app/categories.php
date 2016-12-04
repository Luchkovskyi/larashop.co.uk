<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Categories extends Model
{
    protected $fillable=['category'];

    public function Items()
    {
        return $this->hasMany('App\Items');
    }

    public static function cat()
    {
        return DB::table('categories')->select('id','category')->get();
    }

}
