<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constituent extends Model
{
    protected $guarded = [];

    protected $touches = ['test'];

    public function deck()
    {
        return $this->belongsTo(Deck::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
