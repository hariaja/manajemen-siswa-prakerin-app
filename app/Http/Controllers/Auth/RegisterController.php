<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\School;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Services\Auth\RegisterService;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Foundation\Auth\RedirectsUsers;

class RegisterController extends Controller
{

  // use RegistersUsers;
  use RedirectsUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected RegisterService $service)
  {
    $this->middleware('guest');
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\View\View
   */
  public function showRegistrationForm(): View
  {
    $schools = $this->service->getSchools()->get();
    return view('auth.register', compact('schools'));
  }


  /**
   * Handle a registration request for the application.
   *
   * @param  \App\Http\Requests\Auth\RegisterRequest  $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
   */
  public function register(RegisterRequest $request): RedirectResponse
  {
    // dd($request->all());
    event(
      new Registered(
        $user = $this->service->registered($request)
      )
    );

    $this->guard()->login($user);
    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
  }

  /**
   * Get the guard to be used during registration.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard();
  }

  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  protected function registered(Request $request, $user)
  {
    //
  }
}
