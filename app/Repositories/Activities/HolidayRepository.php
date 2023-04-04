<?php

namespace App\Repositories\Activities;

use App\Models\Holiday;

class HolidayRepository
{
  public function __construct(protected Holiday $holiday)
  {
    # code...
  }
}
