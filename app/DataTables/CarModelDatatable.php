<?php

namespace App\DataTables;

use App\Models\CarModel;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CarModelDatatable extends DataTable
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
            ->editColumn('name', '{{Str::limit($name, 100)}}')
            ->editColumn('maker.name', '{{Str::limit($maker["name"], 100)}}')
            ->addColumn('checkbox', 'dashboard.CarModel.btn.checkbox')
            ->addColumn('action', 'dashboard.CarModel.btn.action')
            ->addColumn('active', 'dashboard.CarModel.btn.active')
            ->rawColumns(['checkbox','action',"active"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return CarModel::query()->with("maker")->select("car_models.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('CarModels-table')
                    ->columns($this->getColumns())
                    ->dom('Bfrtip')
                    ->parameters([
                        'buttons'      => [
                            'pageLength',
                            //old way
                            [
                                'text'=>
                                '<i class="fa fa-trash"></i> '.__('Delete All'),
                                'className'=>'dt-button buttons-collection delBtn buttons-page-length'
                            ],
                            'export',
                            'print',
                            ],
                            'lengthMenu' =>
                            [
                                [ 10, 25, 50, -1 ],
                                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                            ],
                            'language' => datatable_lang(),

                        ])
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->search([

                    ]);

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
                'name'=>"checkbox",
                'data'=>"checkbox",
                'title'=>
                "
                <label class='checkbox checkbox-single'>
                    <input type='checkbox'class='check_all' onclick='check_all()'/>
                    <span></span>
                </label>
                ",
                "exportable"=>false,
                "printable"=>false,
                "orderable"=>false,
                "searchable"=>false,
            ],
            Column::make('id'),
            Column::make('maker.name')->title(__("Maker")),
            Column::make('name'),
            Column::computed('active')
            ->title(__('Active'))
            ->exportable(false)
            ->printable(false)
            ->searchable(false)
            ->width(120)
            ->addClass('text-center'),
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
