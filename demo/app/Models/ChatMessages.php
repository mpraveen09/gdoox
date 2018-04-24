<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Eloquent
{
    protected $collection = 'chat_messages';
}
