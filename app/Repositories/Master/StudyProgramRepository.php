<?php

namespace App\Repositories\Master;

use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class StudyProgramRepository
{
  public function __construct(protected StudyProgram $studyProgram)
  {
    // 
  }

  public function all(): QueryBuilder
  {
    return $this->studyProgram->newQuery()->orderBy('name', 'ASC');
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
