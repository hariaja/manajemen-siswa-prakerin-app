<?php

namespace App\Repositories\Educations;

use App\Models\School;
use Illuminate\Database\Eloquent\Model;

class SchoolRepository
{
  public function __construct(protected School $school)
  {
    # code...
  }

  public function getSchools()
  {
    return $this->school->newQuery()->orderBy('id', 'ASC')->select('schools.*');
  }

  public function all()
  {
    # code...
  }

  public function save($request)
  {
    return $this->school->firstOrCreate([
      'npsn' => $request->npsn,
      'name' => $request->name,
      'education' => $request->education,
      'status' => $request->status,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->school->findOrFail($id);
  }

  public function edit($id, $request)
  {
    $school = $this->getDataById($id);
    return $school->updateOrFail([
      'npsn' => $request->npsn,
      'name' => $request->name,
      'education' => $request->education,
      'status' => $request->status,
    ]);
  }

  public function delete($id)
  {
    $school = $this->getDataById($id);
    return $school->delete();
  }
}
