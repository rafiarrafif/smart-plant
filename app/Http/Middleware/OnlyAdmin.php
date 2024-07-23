<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()){
            return redirect()->route('welcome');
        }
        if(auth()->user()->role == 'admin'){
            return $next($request);
        }
        return redirect()->route('home')->with('error', 'Hanya akun admin yang memliki akses ke halaman tersebut');
    }
}