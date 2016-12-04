<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameters_values extends Model
{
    protected $fillable=['items_id','parameters_id','value'];
}
