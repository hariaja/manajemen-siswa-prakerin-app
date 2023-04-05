<?php

namespace App\DataTables\Activities;

use App\Helpers\Global\Constant;
use App\Models\Attendance;
use App\Models\Leader;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AttendanceDataTable extends DataTable
{
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
    if (isRoleName() === Constant::LEADER) :
      return $model->newQuery()
        ->join('study_programs', 'attendances.study_program_id', '=', 'study_programs.id')
        ->join('leaders', 'study_programs.id', '=', 'leaders.study_program_id')
        ->select('attendances.*')
        ->where('leaders.study_program_id', isLeader()->study_program_id)
        ->orderBy('title', 'ASC');
    elseif (isRoleName() === Constant::MENTOR) :
      return $model->newQuery()
        ->join('study_programs', 'attendances.study_program_id', '=', 'study_programs.id')
        ->join('mentors', 'study_programs.id', '=', 'mentors.study_program_id')
        ->select('attendances.*')
        ->where('mentors.study_program_id', isMentor()->study_program_id)
        ->orderBy('title', 'ASC');
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
    $roles = isRoleName() === Constant::ADMIN ? true  : (isRoleName() === Constant::LEADER ? true : false);
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
