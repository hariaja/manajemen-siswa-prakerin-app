<?php

namespace App\Services\Master;

use App\Repositories\Master\MentorRepository;

class MentorService
{
  public function __construct(protected MentorRepository $repository)
  {
    # code...
  }
}
