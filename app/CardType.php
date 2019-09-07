<?php

namespace App;

use App\Card;
use Illuminate\Database\Eloquent\Model;

class Cardtype extends Model
{
    public function cards()
    {
    	return $this->hasMany(Card::class);
    }
}
