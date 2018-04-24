<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

class ChatContacts extends Eloquent
{
    protected $collection = 'chat_contacts';
}
