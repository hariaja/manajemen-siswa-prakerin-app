<?php

namespace App\DataTables\Activities;

use App\Models\Attendance;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use App\Services\Activities\AttendanceService;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class AttendanceDataTable extends DataTable
{
  /**
   * Create a new datatable instance.
   *
   * @return void
   */
  public function __construct(
    protected AttendanceService $attendanceService,
  ) {
    // 
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('study_program', function ($row) {
        return $row->studyProgram->name;
      })
      ->editColumn('start_time', function ($row) {
        return substr($row->start_time, 0, -3) . " - " . substr($row->timeout_start_time, 0, -3);
      })
      ->editColumn('end_time', function ($row) {
        return substr($row->end_time, 0, -3) . " - " . substr($row->timeout_end_time, 0, -3);
      })
      ->addColumn('action', 'activities.attendances.action');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Attendance $model): QueryBuilder
  {
    if (isRoleName() === Constant::LEADER || isRoleName() === Constant::MENTOR) :
      return $this->attendanceService->getDataByStudyProgram();
    elseif (isRoleName() === Constant::TEACHER) :
      return $model->newQuery()
        ->join('study_programs', 'attendances.study_program_id', '=', 'study_programs.id')
        ->join('registrations', 'study_programs.id', '=', 'registrations.study_program_id')
        ->select('study_programs.*', 'attendances.*')
        ->where('registrations.teacher_id', '=', isTeacher()->id);
    else :
      return $model->newQuery()->orderBy('title', 'ASC');
    endif;
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('attendance-table')
      ->columns($this->getColumns())
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    $roles = isRoleName() === Constant::ADMIN ? true  : (isRoleName() === Constant::LEADER ? true : (isRoleName() === Constant::MENTOR ? true : (isRoleName() === Constant::TEACHER ? true : false)));
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('title')
        ->title(trans('Absensi'))
        ->addClass('text-center'),
      Column::make('start_time')
        ->title(trans('Masuk'))
        ->addClass('text-center'),
      Column::make('end_time')
        ->title(trans('Pulang'))
        ->addClass('text-center'),
      Column::make('study_program')
        ->title(trans('Program Studi'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('10%')
        ->visible($roles)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Attendance_' . date('YmdHis');
  }
}
