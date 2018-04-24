<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class Attribute extends Eloquent
{
    protected $collection = 'cat_attributes';
    
//    public function assoc()
//    {
//        return $this->hasOne('Gdoox\Models\AttributesAssoc', 'id', 'class');
//    }  
//    public function atype()
//    {
//        return $this->hasOne('Gdoox\Models\AttributesType', 'id', 'field_type');
//    }      
    
    public function categories(){
        return $this->belongsToMany('Gdoox\Models\Category','Gdoox\Models\CategoryAttribute','attr_ids','attr_id');
    }
       
}
