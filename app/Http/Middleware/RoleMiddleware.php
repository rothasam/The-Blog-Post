<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$role_ids): Response
    {
        if(!Auth::check() && !in_array(Auth::user()->role_id, $role_ids)){
            return redirect('/')->with('error', 'Please login.');
        }
        
        

        // if (!in_array(Auth::user()->role_id, $role_ids)) {
        //     return redirect('/')->with('error', 'Access denied.');
        // }

        // if (!in_array(Auth::user()->role_id, $role_ids)) {

        //     return response()->json(['message' => 'Role unpermitted'], Response::HTTP_FORBIDDEN);
        // }

        return $next($request);
        // return redirect('/')->with('error', 'Access denied.');
    }
}
