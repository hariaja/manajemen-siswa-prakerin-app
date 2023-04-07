<?php

namespace App\Helpers\Global;

use App\Models\Registration;
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

  // Leader or Mentor
  public function pendingRegistration()
  {
    if (isRoleName() === Constant::LEADER) {
      return Registration::where('study_program_id', isLeader()->study_program_id)->pending()->count();
    } else {
      return Registration::where('study_program_id', isMentor()->study_program_id)->pending()->count();
    }
  }

  public function approvedRegistration()
  {
    if (isRoleName() === Constant::LEADER) {
      return Registration::where('study_program_id', isLeader()->study_program_id)->approved()->count();
    } else {
      return Registration::where('study_program_id', isMentor()->study_program_id)->approved()->count();
    }
  }

  public function rejectedRegistration()
  {
    if (isRoleName() === Constant::LEADER) {
      return Registration::where('study_program_id', isLeader()->study_program_id)->rejected()->count();
    } else {
      return Registration::where('study_program_id', isMentor()->study_program_id)->rejected()->count();
    }
  }

  public function countStudentByRegistration()
  {
    if (isRoleName() === Constant::LEADER) {
      return Registration::where('study_program_id', isLeader()->study_program_id)->withCount('students')->get()->sum('students_count');
    } else {
      return Registration::where('study_program_id', isMentor()->study_program_id)->withCount('students')->get()->sum('students_count');
    }
  }
}
