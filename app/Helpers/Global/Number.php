<?php

use Illuminate\Support\Facades\DB;

function AutoNumber($table = NULL, $field = NULL, $pattern = NULL,  $beginning = NULL, $digit = NULL)
{
  $last = DB::table($table)
    ->select(DB::raw('MAX(SUBSTRING(' . $field . ',' . $beginning . ' , ' . $digit . ')) as lastno'))
    ->where($field, 'LIKE', $pattern . '%')
    ->first();
  if (!empty($last)) {
    $next = (int)$last->lastno + 1;
  } else {
    $next = 1;
  }
  return $pattern . sprintf("%0" . $digit . "s", $next);
}
