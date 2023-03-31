<?php

namespace App\DataTables\Registrations;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ScheduleDataTable extends DataTable
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
      ->editColumn('status', function ($row) {
        return $row->isStatus();
      })
      ->editColumn('start', function ($row) {
        return customDate($row->start, true);
      })
      ->editColumn('end', function ($row) {
        return customDate($row->end, true);
      })
      ->addColumn('action', 'registrations.schedules.action')
      ->rawColumns(['status', 'action']);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Schedule $model): QueryBuilder
  {
    return $model->newQuery()->orderBy('id', 'ASC');
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('schedule-table')
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('schedules.index'),
        'type' => 'GET',
        'data' => "
          function(data) {
            _token = '{{ csrf_token() }}',
            data.status = $('select[name=status]').val();
          }"
      ])
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
        ->title(trans('Batch'))
        ->addClass('text-center'),
      Column::make('start')
        ->title(trans('Dibuka Pada'))
        ->addClass('text-center'),
      Column::make('end')
        ->title(trans('Ditutup Pada'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Ditutup Pada'))
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
    return 'Schedule_' . date('YmdHis');
  }
}
