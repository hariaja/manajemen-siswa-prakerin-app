<?php

namespace App\DataTables\Registrations;

use App\Models\Teacher;
use App\Models\Registration;
use App\Helpers\Global\Constant;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RegistrationDataTable extends DataTable
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
      ->editColumn('register_date', function ($row) {
        return customDate($row->register_date);
      })
      ->addColumn('teacher', function ($row) {
        return $row->teacher->user->name;
      })
      ->addColumn('students', function ($row) {
        return $row->students->count();
      })
      ->editColumn('status', 'registrations.registrations.status')
      ->addColumn('action', 'registrations.registrations.action')
      ->rawColumns([
        'status',
        'action',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Registration $model): QueryBuilder
  {

    if (isRoleName() == Constant::TEACHER) :
      $teacher = Teacher::where('user_id', me()->id)->first();
      return $model->newQuery()
        ->join('teachers', 'registrations.teacher_id', '=', 'teachers.id')
        ->where('teacher_id', '=', $teacher->id)
        ->select('registrations.*');
    endif;

    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('registration-table')
      ->columns($this->getColumns())
      ->ajax([
        'url' => route('registrations.index'),
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
      Column::make('teacher')
        ->title(trans('Nama Pendaftar'))
        ->addClass('text-center'),
      Column::make('register_date')
        ->title(trans('Tanggal Daftar'))
        ->addClass('text-center'),
      Column::make('students')
        ->title(trans('Jumlah Siswa'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
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
    return 'Registration_' . date('YmdHis');
  }
}
