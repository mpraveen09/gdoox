<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class InviteUser extends Eloquent
{
     protected $collection = 'invite_users';
}
