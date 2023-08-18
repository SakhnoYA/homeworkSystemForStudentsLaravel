<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Type
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (! $user && ! in_array('guest', $roles)) {
            return redirect()->route('login');
        }

        if (! $user && in_array('guest', $roles)) {
            return $next($request);
        }

        if (in_array($user->user_type->name, $roles)) {
            return $next($request);
        }

        return redirect()->route($user->user_type->name.'.index');
    }
}
