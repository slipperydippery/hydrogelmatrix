<?php

namespace App;

use App\Deck;
use App\User;
use App\CardType;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	protected $guarded = [];
	
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function deck()
    {
    	return $this->belongsTo(Deck::class);
    }

    public function cardtype()
    {
    	return $this->belongsToMany(CardType::class);
    }
}
