<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Deck;

class VerifyDeckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $deckid = $request->route('deck')->id;
        $deck = Deck::findOrFail($deckid);
        if (Auth::guest()) {
            return redirect()->guest('login');
        }
        if (Auth::id() != $deck->user->id) {
            return response('Je bent niet geauthoriseerd om deze pagina te bekijken', 401);
        }
        return $next($request);
    }
}
