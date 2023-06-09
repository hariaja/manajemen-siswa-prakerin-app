<?php

namespace App\DataTables\Educations;

use App\Models\Teacher;
use App\Helpers\Global\Constant;
use App\Services\Educations\TeacherService;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class TeacherDataTable extends DataTable
{
  public function __construct(protected TeacherService $service)
  {
    # code...
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
      ->addColumn('name', function ($row) {
        return $row->user->name;
      })
      ->addColumn('phone', function ($row) {
        return $row->user->phone;
      })
      ->addColumn('school', function ($row) {
        return $row->school->name;
      })
      ->editColumn('status', function ($row) {
        return $row->user->isStatus();
      })
      ->addColumn('action', 'educations.teachers.action')
      ->rawColumns(['status', 'action']);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Teacher $model): QueryBuilder
  {
    return $this->service->all();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('teacher-table')
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
      Column::make('school')
        ->title(trans('Sekolah'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status Akun'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('15%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Teacher_' . date('YmdHis');
  }
}
