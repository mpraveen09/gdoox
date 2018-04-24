<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class GdooxPaypalPayment extends Eloquent {
    protected $collection = 'payment_paypal_gdoox';   
}
