<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if( Auth::check() ){
            $slugs = Deck::select('slug')->get();
            $decks = Auth::user()->decks()->with('cards')->orderBy('updated_at', 'desc')->get();
            return view('dashboard', compact('decks', 'slugs'));
        }
        return view('welcome');
    }
}
