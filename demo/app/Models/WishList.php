<?php

namespace Gdoox\Models;
use Jenssegers\Mongodb\Model as Eloquent;

class WishList extends Eloquent
{
    protected $collection = 'wishlist_cart';
     
    public function getwishlistproducts()
    {
        return $this->hasOne('Gdoox\Models\Products','product_id','_id');
    }

}
