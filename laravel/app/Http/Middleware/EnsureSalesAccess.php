<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class EnsureSalesAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Permission::where('role', Auth::user()->role)->where('menu_group', 'sales')->where('read', true)->doesntExist()) {
            abort(403);
        }
        return $next($request);
    }
}
