<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;

class DeckTestController extends Controller
{
    public function start(Deck $deck)
    {
    	return view('test.start', compact('deck'));
    }
}
