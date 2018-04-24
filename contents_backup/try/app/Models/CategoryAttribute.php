<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class CategoryAttribute extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'cat_attributes_relation';
    
    protected $fillable = ['cat_id','attr_ids'];
    
    public function categories(){
          return $this->belongsTo('Gdoox\Models\Category');
    }
    public function attribute(){
         return $this->belongsTo('Gdoox\Models\Attribute');
    }
}
