<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithQRCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $qrcode_id = $request->input('qrcode_id');

        if ($qrcode_id) {
            // ทำการเข้าสู่ระบบด้วย ID ที่ได้จาก QR Code
            Auth::loginUsingId($qrcode_id);
        }

        return $next($request);
    }
}
