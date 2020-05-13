<?php

namespace App\Http\Controllers;

use App\Deck;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
         $this->middleware('auth')->only('dashboard');
         $this->middleware('verified')->only('dashboard');
    }

    /**
     * Show the welcome screen.
     */
    public function index()
    {
        if( Auth::check() ){
            return redirect()->route('dashboard');
        }

        return view('welcome');
    }

    /**
     * Show the user dashboard.
     */
    public function dashboard()
    {
        $deckslugs = Deck::select('slug')->get();
        $decks = Auth::user()->decks()->with('cards')->orderBy('updated_at', 'desc')->get();
        $tests = Auth::user()->tests()->with('decks')->orderBy('updated_at', 'desc')->get();
        $testslugs = Test::select('slug')->get();
        return view('dashboard', compact('decks', 'tests', 'deckslugs', 'testslugs'));
    }

}
