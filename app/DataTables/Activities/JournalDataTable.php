<?php

namespace App\DataTables\Activities;

use App\Helpers\Global\Constant;
use App\Models\Journal;
use App\Services\Activities\JournalService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JournalDataTable extends DataTable
{
  public function __construct(protected JournalService $service)
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
        return $row->student->user->name;
      })
      ->editColumn('title', function ($row) {
        return '<a href="' . route('journals.edit', $row->uuid) . '">' . $row->title . '</a>';
      })
      ->editColumn('created_at', function ($row) {
        return $row->created_at->diffForHumans();
      })
      ->editColumn('status', function ($row) {
        return $row->isStatus();
      })
      ->editColumn('proof', 'activities.journals.proof')
      ->addColumn('action', 'activities.journals.action')
      ->rawColumns(['proof', 'action', 'status', 'title']);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Journal $model): QueryBuilder
  {
    return $this->service->getData();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('journal-table')
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
    $roles = me()->hasRole(Constant::MENTOR) ? true : (me()->hasRole(Constant::MENTOR) ?: false);

    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('name')
        ->title(trans('Nama Siswa'))
        ->addClass('text-center'),
      Column::make('title')
        ->title(trans('Materi'))
        ->addClass('text-center'),
      Column::make('created_at')
        ->title(trans('Upload Pada'))
        ->addClass('text-center'),
      Column::make('proof')
        ->title(trans('Bukti'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
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
    return 'Journal_' . date('YmdHis');
  }
}
