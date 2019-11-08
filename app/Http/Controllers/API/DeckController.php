<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Deck;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDeck;
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
    public function store(StoreDeck $request)
    {
        $validated = $request->validated();

        $user = auth('api')->user();
        $deck = Deck::create([
            'title'         => $validated['title'],
            'slug'          => $validated['slug'],
            'description'   => $validated['description'],
            'user_id'       => $user->id,
            'public'        => $validated['public'],
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
    public function update(StoreDeck $request, Deck $deck)
    {
        $deck->title        = $request->input('title');
        $deck->slug         = $request->input('slug');
        $deck->description  = $request->input('description');
        $deck->public       = $request->input('public');

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
