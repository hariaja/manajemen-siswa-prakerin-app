<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Global\Dashboard;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $data = array();
    $data['dashboard'] = new Dashboard;
    return view('home', $data);
  }
}
