<?php

namespace App\Services\Activities;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Activities\AttendanceRepository;

class AttendanceService
{
  public function __construct(protected AttendanceRepository $repository)
  {
    # code...
  }
}
