<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class Category extends Eloquent
{
    //
      protected $connection = 'mongodb';
      protected $collection = 'cat_categories';
      
//      public function attributes(){
//          return $this->belongsToMany('Gdoox\Models\Attribute','Gdoox\Models\AttributeCategory','cat_id');
//      }
//
}
