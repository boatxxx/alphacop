<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\CssSetting;


class CustomCSSMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $customCSS = CssSetting::latest()->first();

        // ส่งข้อมูลไปยังทุกวิว
        view()->share('customCSS', $customCSS);

        return $next($request);
    }

}
