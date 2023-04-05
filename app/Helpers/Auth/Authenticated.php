<?php

use App\Models\Leader;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\Teacher;
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
  return Student::where('user_id', me()->id)->first();
}
