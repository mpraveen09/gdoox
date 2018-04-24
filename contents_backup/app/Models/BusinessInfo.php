<?php

namespace Gdoox\Models;

use Jenssegers\Mongodb\Model as Eloquent;

class BusinessInfo extends Eloquent
{
  protected $collection="business_info";

  public function searchstore()
  {
      return $this->hasMany('Gdoox\Models\EcomShops', 'company_id', '_id');
  }
}