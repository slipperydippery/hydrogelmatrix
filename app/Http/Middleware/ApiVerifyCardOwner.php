<?php

namespace App\Http\Middleware;

use App\Card;
use Closure;

class ApiVerifyCardOwner
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
        $cardid = $request->route('card')->id;
        $card = Card::findOrFail($cardid);
        $user = $request->user('api');
        if ($user->id != $card->user->id) {
            return response('Je bent niet geauthoriseerd om deze pagina te bekijken', 401);
        }
        return $next($request);
    }
}
