<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // غير مسجّل الدخول
        abort_unless($user, 401);
        abort_unless($user->status, 403, __('Auth/middleware.account_disabled'));

        // الأدمن يمتلك جميع الصلاحيات.
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        $roles = $request->route()->getAction('roles');

        // المسارات التي تحمل هذا middleware تتطلب تحديد صلاحية.
        abort_if(empty($roles), 403, __('Auth/middleware.permission_not_defined'));

        abort_unless($user->hasAnyRole($roles), 403, __('Auth/middleware.access_denied'));

        return $next($request);

    }
}
