<?php

namespace App;

use App\Models\Concerns\UsesOrder;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
	use UsesOrder;

    protected $guarded = [];

    protected $casts = [
        'correct' => 'boolean',
    ];

    public function setCardAttribute($card)
    {
    	$this->attributes['card_id'] = $card->getKey();
    	$this->setRelation('card', $card);
    }
}
