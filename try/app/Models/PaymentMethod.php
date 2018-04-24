<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class PaymentMethod extends Eloquent
{
     protected $collection = 'payment_methods';
}
