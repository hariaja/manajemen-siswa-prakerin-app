<?php

namespace App\Http\Controllers\Activities;

use App\DataTables\Activities\JournalDataTable;
use App\DataTables\Registrations\StudentDataTable;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activities\JournalRequest;
use App\Models\Journal;
use App\Services\Activities\JournalService;
use Illuminate\Http\Request;

class JournalController extends Controller
{
  public function __construct(protected JournalService $service)
  {
    $this->middleware('role:Student|Mentor|Teacher');
  }

  /**
   * Display a listing of the resource.
   */
  public function index(JournalDataTable $journalDataTable)
  {
    if (isRoleName() === Constant::STUDENT) :
      return $journalDataTable->render('students.journals.index');
    else :
      return $journalDataTable->render('activities.journals.index');
    endif;
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('students.journals.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(JournalRequest $request)
  {
    $this->service->save($request);
    return redirect()->route('journals.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Journal $journal)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Journal $journal)
  {
    if (isRoleName() === Constant::STUDENT) :
      return view('students.journals.edit', compact('journal'));
    else :
      return view('activities.journals.edit', compact('journal'));
    endif;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(JournalRequest $request, Journal $journal)
  {
    $this->service->edit($journal, $request);
    return redirect()->route('journals.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Journal $journal)
  {
    $this->service->delete($journal);
    return response()->json([
      'message' => trans('session.delete')
    ]);
  }

  public function status(Request $request, Journal $journal)
  {
    $journal->updateOrFail([
      'status' => $request->status
    ]);

    return redirect()->route('journals.index')->withSuccess(trans('session.update'));
  }
}
