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
         $this->middleware('auth')->only('dashboard');
         $this->middleware('verified')->only('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if( Auth::check() ){
            return redirect()->route('dashbaord');
        }

        return view('welcome');
    }

    public function dashboard()
    {
        $slugs = Deck::select('slug')->get();
        $decks = Auth::user()->decks()->with('cards')->get();

        return view('dashboard', compact('decks', 'slugs'));
    }
}
