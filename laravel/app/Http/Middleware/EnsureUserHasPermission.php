<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $menu_group, string $view, string $action): Response
    {
        if (Permission::where('role', Auth::user()->role)->where('menu_group', $menu_group)->where('view', $view)->where($action, true)->doesntExist()) {
            abort(403);
        }
        return $next($request);
    }
}
