<?php

namespace App\Traits;

use App\Http\Requests\Password\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

trait PasswordChange
{
  /**
   * Show the application's login form.
   *
   * @return \Illuminate\View\View
   */
  public function showChangePasswordForm(User $user)
  {
    return view('settings.users.password', compact('user'));
  }

  public function store(PasswordRequest $request)
  {
    $user = User::findOrFail(me()->id);

    $user->updateOrFail([
      'password' => Hash::make($request->password)
    ]);

    Auth::guard()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->route('login')->withSuccess(trans('Berhasil memperbaharui kata sandi anda. Silahkan login ulang.'));
  }
}
