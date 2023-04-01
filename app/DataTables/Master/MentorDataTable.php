<?php

namespace App\DataTables\Master;

use App\Models\Mentor;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MentorDataTable extends DataTable
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
      ->addColumn('name', function ($row) {
        return $row->user->name;
      })
      ->addColumn('phone', function ($row) {
        return $row->user->phone;
      })
      ->addColumn('study_program', function ($row) {
        return $row->studyProgram->name;
      })
      ->addColumn('action', 'master.mentors.action');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Mentor $model): QueryBuilder
  {
    return $model->newQuery()->join('users', 'mentors.user_id', '=', 'users.id')->orderBy('name', 'ASC')->select('mentors.*');
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('mentor-table')
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
      Column::make('name')
        ->title(trans('Nama'))
        ->addClass('text-center'),
      Column::make('phone')
        ->title(trans('Telepon'))
        ->addClass('text-center'),
      Column::make('study_program')
        ->title(trans('Program Studi'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->visible(isRoleName() == Constant::ADMIN ? true : false) // Only admin can view action column
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Mentor_' . date('YmdHis');
  }
}
