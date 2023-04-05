<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserNotActive
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check() && Auth::user()->status == Constant::INACTIVE) {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      Alert::error('Akun Anda Belum Aktif. Mohon Hubungin Admin Untuk Mengaktifkan Akun Anda');
      return redirect()->route('login');
    }

    return $next($request);
  }
}
