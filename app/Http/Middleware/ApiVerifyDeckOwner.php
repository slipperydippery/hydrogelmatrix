<?php

namespace App\Http\Middleware;

use App\Deck;
use Closure;

class ApiVerifyDeckOwner
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
        $deckid = $request['card']['deck_id'];
        $deck = Deck::findOrFail($deckid);
        $user = $request->user('api');
        if ($user->id != $deck->user->id) {
            return response('Je bent niet geauthoriseerd om deze pagina te bekijken', 401);
        }
        return $next($request);
    }
}
