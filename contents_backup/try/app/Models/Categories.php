<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Categories extends Eloquent
{
    protected $collection = 'cat_categories';

    public function attributes()
    {
        return $this->hasOne('Gdoox\Models\CategoryAttributes', 'cat_id', '_id');
    }      
}
