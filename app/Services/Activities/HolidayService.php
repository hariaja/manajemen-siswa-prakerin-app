<?php

namespace App\Services\Activities;

use App\Repositories\Activities\HolidayRepository;

class HolidayService
{
  public function __construct(protected HolidayRepository $holidayRepository)
  {
    # code...
  }
}
