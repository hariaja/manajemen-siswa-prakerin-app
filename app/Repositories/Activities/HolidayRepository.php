<?php

namespace App\Repositories\Activities;

use App\Models\Holiday;
use Illuminate\Database\Eloquent\Model;

class HolidayRepository
{
  public function __construct(protected Holiday $holiday)
  {
    # code...
  }

  public function save($request)
  {
    $this->holiday->firstOrCreate([
      'title' => $request->title,
      'study_program_id' => $request->study_program_id,
      'holiday_date' => $request->holiday_date,
      'description' => $request->description,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->holiday->findOrFail($id);
  }

  public function edit($request, $id)
  {
    $holiday = $this->getDataById($id);

    $holiday->updateOrFail([
      'title' => $request->title,
      'study_program_id' => $request->study_program_id,
      'holiday_date' => $request->holiday_date,
      'description' => $request->description,
    ]);
  }

  public function delete($id)
  {
    $holiday = $this->getDataById($id);
    $holiday->delete();
  }
}
