<?php

namespace App;

use App\Models\Concerns\UsesOrder;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use UsesOrder;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function decks()
    {
        return $this->belongsToMany(Deck::class, 'constituents');
    }

    public function constituents()
    {
        return $this->hasMany(Constituent::class);
    }
}
