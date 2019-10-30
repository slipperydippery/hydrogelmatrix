<?php

namespace App;

use App\Card;
use App\User;
use App\Models\Concerns\UsesOrder;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
	use UsesOrder;

	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function cards()
    {
    	return $this->hasMany(Card::class);
    }

    public function testpath()
    {
        return "/deck/{$this->id}/test";
    }
}
