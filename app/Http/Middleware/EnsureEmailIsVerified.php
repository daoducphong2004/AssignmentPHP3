<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
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
        // Kiểm tra nếu người dùng đã đăng nhập và chưa xác thực email
        if ($request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            // Kiểm tra nếu request không phải là từ trang xác thực email để tránh vòng lặp
            if (!$request->is('email/verify', 'email/verify/*', 'logout')) {
                // Chuyển hướng người dùng đến trang thông báo xác thực email
                return $request->expectsJson()
                        ? abort(403, 'Your email address is not verified.')
                        : redirect()->route('verification.notice');
            }
        }

        // Nếu đã xác thực email hoặc chưa đăng nhập, tiếp tục xử lý request
        return $next($request);
    }
}
