<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

class ChattingUsersRelations extends Eloquent
{
    protected $collection = 'chat_users_relations';
}
