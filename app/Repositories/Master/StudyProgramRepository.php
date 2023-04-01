<?php

namespace App\Repositories\Master;

use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Model;

class StudyProgramRepository
{
  public function __construct(protected StudyProgram $studyProgram)
  {
    // 
  }

  public function all()
  {
    return $this->studyProgram->orderBy('name', 'ASC')->active()->get();
  }

  public function save($request)
  {
    return $this->studyProgram->firstOrCreate([
      'name' => $request->name,
      'status' => $request->status,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->studyProgram->findOrFail($id);
  }

  public function edit($id, $request)
  {
    $studyProgram = $this->getDataById($id);
    return $studyProgram->updateOrFail([
      'name' => $request->name,
      'status' => $request->status,
    ]);
  }

  public function delete($id)
  {
    $studyProgram = $this->getDataById($id);
    return $studyProgram->delete();
  }
}
