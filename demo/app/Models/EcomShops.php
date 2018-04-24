<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class EcomShops extends Eloquent
{
    //protected $collection = 'ecommerce_companies';
    
    protected $collection = 'business_ecommerce_companies';
    
    public function search()
    {
        return $this->hasOne('Gdoox\Models\BusinessInfo', '_id', 'company_id');
    }
    
}
