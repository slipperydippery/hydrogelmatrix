<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;

class DeckTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start(Deck $deck)
    {
    	$deck = Deck::with('cards.cardtype', 'cards.choices')->find($deck->id);
    	return view('test.start', compact('deck'));
    }
}
