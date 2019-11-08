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
        $this->middleware('apiownsdeck')->only('store');
        $this->middleware('apiownscard', ['only' => ['update', 'destroy']]);
//        $this->middleware('apiownscard')->only(['update, delete']);
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
            'front'         => $request->input('card.front'),
            'back'          => $request->input('card.back'),
            'user'          => $user,
            'deck_id'       => $request->input('card.deck_id'),
            'cardtype_id'   => $request->input('card.cardtype.id'),
        ]);

        foreach ($request->input('card.choices') as $choice) {
            Choice::create([
                'body'      => $choice['body'],
                'correct'   => $choice['correct'],
                'card'      => $card,
            ]);
        };

        $card = Card::with('cardtype', 'choices')->find($card->id);
        return $card;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  Card $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Card $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $card->front        = $request->input('card.front');
        $card->back         = $request->input('card.back');
        $card->cardtype_id  = $request->input('card.cardtype.id');
        $card->save();
        $card->choices()->delete();
        foreach ($request->input('card.choices') as $choice) {
            Choice::create([
                'body'      => $choice['body'],
                'correct'   => $choice['correct'],
                'card'      => $card,
            ]);
        };
        return Card::with('choices', 'cardtype')->find($card->id);
    }


    /**
     * Remove the specified resource from storage
     *
     * @param  int  Card $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();

        // set notification of deleted succes
        return 'deleted';
    }
}
