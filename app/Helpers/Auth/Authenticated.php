<?php

use App\Models\Leader;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\StudyProgram;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

function me(): Authenticatable
{
  return Auth::user();
}

function isRoleName()
{
  return me()->roles->implode('name');
}

function isRoleId()
{
  return me()->roles->implode('uuid');
}

function isLeader()
{
  return Leader::where('user_id', me()->id)->first();
}

function isMentor()
{
  return Mentor::where('user_id', me()->id)->first();
}

function isTeacher()
{
  return Teacher::where('user_id', me()->id)->first();
}

function isStudent()
{
  return Student::with(['registrations.studyProgram'])->where('user_id', me()->id)->first();
}

function getPath()
{
  $path = '/home';
  if (Auth::check() && isRoleName() === Constant::STUDENT) {
    $path = '/students/home';
  }
  return redirect($path);
}

function getStudentStudyProgram()
{
  $student = isStudent();
  $registrations = $student->registrations;

  $studyProgramIds = $registrations->pluck('study_program_id');
  $studyPrograms = StudyProgram::whereIn('id', $studyProgramIds)->first();

  // $studyProgramObjects = $studyProgramIds->map(function ($id) use ($studyPrograms) {
  //   return $studyPrograms->firstWhere('id', $id);
  // });

  return $studyPrograms;
}
