<?php

namespace Gdoox;
use Jenssegers\Mongodb\Model as Eloquent;

class UserRole extends Eloquent
{
    //
    protected $collection='user_role';
    protected $fillable = array('user_id', 'role_id');
    
    public  function user(){
      
      return $this->belongsTo("Gdoox\User");
    }
}
