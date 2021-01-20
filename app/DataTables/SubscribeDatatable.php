<?php

namespace App\DataTables;

use App\Models\subscribe_package;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscribeDatatable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('currency_name', '{{Str::limit($currency_name, 100)}}')
            ->editColumn('price', '{{Str::limit($price, 100)}}')
            ->editColumn('period', '{{Str::limit($period, 100)}}')
            ->editColumn('description', '{!! Str::limit($description, 100) !!}')
            ->editColumn('description_ar', '{!! Str::limit($description_ar, 100) !!}')
            ->addColumn('checkbox', 'dashboard.subscribe_package.btn.checkbox')
            ->addColumn('action', 'dashboard.subscribe_package.btn.action')
            ->rawColumns(['checkbox', 'action','description','description_ar']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return subscribe_package::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Subscribes-table')
            ->columns($this->getColumns())
            ->dom('Bfrtip')
            ->parameters([
                'buttons'      => [
                    'pageLength',
                    //old way
                    [
                        'text' =>
                        '<i class="fa fa-trash"></i> ' . __('Delete All'),
                        'className' => 'dt-button buttons-collection delBtn buttons-page-length'
                    ],
                    'export',
                    'print',
                ],
                'lengthMenu' =>
                [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                'language' => datatable_lang(),

            ])
            ->minifiedAjax()
            ->orderBy(1)
            ->search([]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            [
                'name' => "checkbox",
                'data' => "checkbox",
                'title' =>
                "
                <label class='checkbox checkbox-single'>
                    <input type='checkbox'class='check_all' onclick='check_all()'/>
                    <span></span>
                </label>
                ",
                "exportable" => false,
                "printable" => false,
                "orderable" => false,
                "searchable" => false,
            ],
            Column::make('id'),
            Column::make('currency_name')
            ->title(__("Currency")),
            Column::make('period')
            ->title(__('period')),
            Column::make('description')
            ->title(__('Description (EN)')),
            Column::make('description_ar')
            ->title(__('Description (AR)')),
            Column::make('price')
            ->title(__('price')),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(120)
                ->addClass('text-center')

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CarModels_' . date('YmdHis');
    }
}
