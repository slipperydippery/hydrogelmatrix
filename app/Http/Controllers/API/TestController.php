<?php

namespace App\Http\Controllers\API;

use App\Deck;
use App\Test;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTest;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
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
    public function store(StoreTest $request)
    {
        $validated = $request->validated();

        $test = Test::create([
            'title' => $validated['title'],
            'slug' => $validated['slug']
        ]);

        $test->save();

        if($user = auth('api')->user()){
            $user->tests()->save($test);
        }

        if($request->deck_id){
           $deck = Deck::findOrFail($request->deck_id);
           $test->decks()->save($deck);
        }

        $test = Test::with('decks')->find($test->id);

        return $test;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
