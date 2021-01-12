<?php

namespace App\DataTables;

use App\Models\Car;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CarDatatable extends DataTable
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
            ->editColumn('country.name_ar', '{{Str::limit($country["name_ar"], 100)}}')
            ->editColumn('maker.name', '{{Str::limit($maker["name"], 100)}}')
            ->editColumn('phone', '{{Str::limit($phone, 100)}}')
            ->editColumn('price', '{{Str::limit($price, 100)}}')
            ->editColumn('Description', '{!! Str::limit($Description, 100) !!}')
            ->editColumn('Description_ar', '{!! Str::limit($Description_ar, 100) !!}')
            ->addColumn('checkbox', 'dashboard.Car.btn.checkbox')
            ->addColumn('SellerType', 'dashboard.Car.btn.SellerType')
            ->addColumn('action', 'dashboard.Car.btn.action')
            ->rawColumns(['checkbox','action','SellerType',"Description","Description_ar"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Car::query()->with(['maker','country'])->select("cars.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('cars-table')
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
            Column::make('country.name_ar')
            ->title(__("Country")),
            Column::make('maker.name')
            ->title(__("Car Make")),
            Column::make('phone')
            ->title(__("User Phone")),
            Column::make('price'),
            Column::make('Description')
            ->width(70),
            Column::make('Description_ar')
            ->width(70),
            Column::computed('SellerType')
            ->title(__('Seller Type'))
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
        return 'Cars_' . date('YmdHis');
    }
}