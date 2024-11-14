<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class EnsureAuthenticationAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request);
        if (Permission::where('role', Auth::user()->role)->where('menu_group', 'authentication')->where('read', true)->doesntExist()) {
            abort(403);
            // return redirect('/home');
        }
        return $next($request);
    }
}
