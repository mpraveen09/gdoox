<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class Orders extends Eloquent
{
    protected $collection = 'orders';
       
}
