<?php

namespace App\Http\Controllers;

use App\Deck;
use App\CardType;
use Illuminate\Http\Request;

class DeckController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('publiclyaccessible', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function show(Deck $deck)
    {
        $deck = Deck::with('cards.cardtype', 'cards.choices')->find($deck->id);
        $slugs = Deck::select('slug')->get();
        $cards = Deck::find($deck->id)->cards;
        $cardtypes = CardType::get();
        $owner = $deck->user->id == auth()->user()->id ? 1 : 0;
        return view('deck.show', compact('deck', 'cards', 'cardtypes', 'slugs', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function edit(Deck $deck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deck $deck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deck  $deck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {
        //
    }
}
