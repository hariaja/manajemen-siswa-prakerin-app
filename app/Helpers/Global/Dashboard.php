<?php

namespace App\Helpers\Global;

use App\Models\School;
use App\Models\StudyProgram;
use App\Models\User;

class Dashboard
{
  public function userActive()
  {
    return User::wherehas('roles', function ($query) {
      $query->whereNotIn('name', [Constant::ADMIN]);
    })->active()->count();
  }

  public function userInactive()
  {
    return User::inactive()->count();
  }

  public function studyProgramActive()
  {
    return StudyProgram::active()->count();
  }

  public function schoolCount()
  {
    return School::count();
  }

  public function studentActive()
  {
    return User::wherehas('roles', function ($query) {
      $query->where('name', Constant::STUDENT);
    })->active()->count();
  }
}
