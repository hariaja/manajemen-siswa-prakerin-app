<?php

namespace App\Repositories\Master;

use App\Models\Mentor;

class MentorRepository
{
  public function __construct(protected Mentor $mentor)
  {
    # code...
  }
}
