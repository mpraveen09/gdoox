<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model;

class UserLanguagePreference extends Eloquent {
    protected $collection = 'user_language_preference';
}
