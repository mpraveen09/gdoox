<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

class UserChats extends Eloquent
{
    protected $collection = 'user_chats';
}
