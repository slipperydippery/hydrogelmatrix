<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Deck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeckController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();
        $deck = Deck::create([
            'title'         => $request->input('deck.title'),
            'description'   => $request->input('deck.description'),
            'user_id'       => $user->id,
            'public'        => $request->input('deck.public'),
        ]);

        return $deck;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Deck $deck
     * @return \Illuminate\Http\Response
     */
    public function show(Deck $deck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Deck $deck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deck $deck)
    {
        $deck->title        = $request->input('deck.title');
        $deck->description  = $request->input('deck.description');
        $deck->public       = $request->input('deck.public');

        $deck->save();

        return $deck;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  Deck $deck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deck $deck)
    {
        $deck->delete();

        // set notification of deleted succes
        return 'deleted';
    }
}
