<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Scopes\RolesFilter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Settings\UserService;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\UserDataTable;
use App\Helpers\Global\Constant;
use App\Http\Requests\Settings\UserRequest;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected UserService $service)
  {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(UserDataTable $userDataTable, Request $request)
  {
    return $userDataTable->addScope(new StatusFilter($request))
      ->addScope(new RolesFilter($request))
      ->render('settings.users.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    if (isRoleName() == Constant::ADMIN) :
      return view('profile.admin', compact('user'));
    endif;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    $this->service->edit($user, $request);
    return redirect()->route('home')->withSuccess(trans('session.update'));
  }

  /**
   * Update the specified status user resource in storage.
   */
  public function status(User $user)
  {
    $this->service->status($user);
    return response()->json([
      'message' => trans('session.status')
    ], 200);
  }
}
