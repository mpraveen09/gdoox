<?php

namespace Gdoox;
use Jenssegers\Mongodb\Model as Eloquent;

class Permission extends Eloquent
{
    //
    protected $collection='permissions';
    
     protected $fillable = array('role_id', 'read','write','execute');
}
