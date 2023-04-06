<?php

namespace App\Repositories\Activities;

use App\Helpers\Global\Constant;
use App\Models\Journal;
use Illuminate\Database\Eloquent\Model;

class JournalRepository
{
  public function __construct(protected Journal $journal)
  {
    # code...
  }

  public function getData()
  {
    if (isRoleName() === Constant::STUDENT) :
      return $this->journal->query()->where('student_id', isStudent()->id)->latest();
    else :
      return $this->journal->query()->latest();
    endif;
  }

  public function save($request, $proof)
  {
    return $this->journal->firstOrCreate([
      'student_id' => isStudent()->id,
      'title' => $request->title,
      'description' => $request->description,
      'proof' => $proof,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->journal->findOrFail($id);
  }

  public function edit($id, $request, $file)
  {
    $journal = $this->getDataById($id);
    return $journal->updateOrFail([
      'student_id' => isStudent()->id,
      'title' => $request->title,
      'description' => $request->description,
      'proof' => $file,
    ]);
  }

  public function delete($id)
  {
    $journal = $this->getDataById($id);
    return $journal->delete();
  }
}
