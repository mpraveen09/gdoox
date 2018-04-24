<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class BreadcrumbLinks extends Eloquent
{
    protected $collection = 'url_active_n_breadcrumb';
}
