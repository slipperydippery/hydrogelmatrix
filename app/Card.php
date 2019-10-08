<?php

namespace App;

use App\Deck;
use App\User;
use App\Choice;
use App\CardType;
use App\Models\Concerns\UsesOrder;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use UsesOrder;

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
    	return $this->belongsTo(Cardtype::class);
    }

    public function choices()
    {
    	return $this->hasMany(Choice::class);
    }

    public function setUserAttribute($user)
    {
        $this->attributes['user_id'] = $user->getKey();
        $this->setRelation('user', $user);
    }
}
