<?php

namespace App\DataTables\Activities;

use App\Models\Holiday;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class HolidayDataTable extends DataTable
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
      ->editColumn('holiday_date', function ($row) {
        return customDate($row->holiday_date);
      })
      ->addColumn('study_program', function ($row) {
        return $row->studyProgram->name;
      })
      ->addColumn('action', 'activities.holidays.action');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Holiday $model): QueryBuilder
  {
    if (isRoleName() === Constant::LEADER) :
      return $model->newQuery()
        ->join('study_programs', 'holidays.study_program_id', '=', 'study_programs.id')
        ->join('leaders', 'study_programs.id', '=', 'leaders.study_program_id')
        ->select('holidays.*')
        ->where('leaders.study_program_id', isLeader()->study_program_id)
        ->orderBy('title', 'ASC');
    elseif (isRoleName() === Constant::MENTOR) :
      return $model->newQuery()
        ->join('study_programs', 'holidays.study_program_id', '=', 'study_programs.id')
        ->join('mentors', 'study_programs.id', '=', 'mentors.study_program_id')
        ->select('holidays.*')
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
      ->setTableId('holiday-table')
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
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('title')
        ->title(trans('Agenda'))
        ->addClass('text-center'),
      Column::make('holiday_date')
        ->title(trans('Tanggal'))
        ->addClass('text-center'),
      Column::make('study_program')
        ->title(trans('Program Studi'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->visible(true)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Holiday_' . date('YmdHis');
  }
}
