<?php

namespace App\Http\Controllers\API;

use App\Card;
use App\Choice;
use App\CardType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{

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
        $card = Card::create([
            'front'         => $request['card']['sidea'],
            'back'          => $request['card']['sideb'],
            'user_id'       => $user->id,
            'deck_id'       => $request['card']['deckid'],
            'cardtype_id'   => $request['card']['cardtype']['id'],
        ]);
        foreach ($request['choices'] as $choice) {
            Choice::create([
                'body'      => $choice['choice'],
                'correct'   => $choice['active'],
                'card_id'   => $card['id'],
            ]);
        };
        $card = Card::with('cardtype')->find($card->id);
        return $card;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
