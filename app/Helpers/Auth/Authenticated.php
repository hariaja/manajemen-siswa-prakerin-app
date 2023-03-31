<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

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
