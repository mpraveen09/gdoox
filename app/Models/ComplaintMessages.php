<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class ComplaintMessages extends Eloquent {
    protected $collection = 'complaint_messages';
}
