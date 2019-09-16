<?php

namespace App;

use App\Models\Concerns\UsesOrder;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
	use UsesOrder;
	
    protected $guarded = [];
}
