<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Products extends Eloquent
{
    protected $collection = 'products';
    protected $fillable = [];
    
}
