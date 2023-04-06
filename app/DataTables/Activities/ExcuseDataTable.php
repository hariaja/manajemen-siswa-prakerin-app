<?php

namespace App\DataTables\Activities;

use App\Models\Excuse;
use App\Services\Activities\ExcuseService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExcuseDataTable extends DataTable
{
  public function __construct(protected ExcuseService $excuseService)
  {
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
      ->addColumn('nisn', function ($row) {
        return $row->student->nisn;
      })
      ->addColumn('name', function ($row) {
        return $row->student->user->name;
      })
      ->addColumn('email_phone', function ($row) {
        return $row->student->user->email . ' / ' . $row->student->user->phone;
      })
      ->editColumn('is_accepted', 'activities.excuses.accepted')
      ->addColumn('action', 'activities.excuses.action')
      ->rawColumns(['is_accepted', 'action']);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Excuse $model): QueryBuilder
  {
    return $this->excuseService->getByDate(request()->attendance->id);
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('excuse-table')
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
      Column::make('nisn')
        ->title(trans('NISN'))
        ->addClass('text-center'),
      Column::make('email_phone')
        ->title(trans('Email / Phone'))
        ->addClass('text-center'),
      Column::make('is_accepted')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::computed('action')
        ->title('Detail')
        ->exportable(false)
        ->printable(false)
        ->width('10%')
        // ->visible($roles)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Excuse_' . date('YmdHis');
  }
}
