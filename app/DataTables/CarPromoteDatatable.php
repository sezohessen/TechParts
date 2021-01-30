<?php

namespace App\DataTables;

use App\Models\CarMaker;
use App\Models\PromoteCar;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CarPromoteDatatable extends DataTable
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
            ->editColumn('subscribe_package.period', '{{Str::limit($subscribe_package["period"], 100)}}')
            ->editColumn('price', '{{Str::limit($price, 100)}}')
            ->editColumn('weaccept_order_id', '{{Str::limit($weaccept_order_id, 100)}}')
            ->editColumn('car.CarMaker_id', function($promote) {
                return Str::limit($promote->car->maker->name ?? "", 100);

            })
            ->editColumn('user.email', '{{ Str::limit($user["email"], 100) }}')
            ->addColumn('checkbox', 'dashboard.CarPromote.btn.checkbox')
            ->addColumn('action', 'dashboard.CarPromote.btn.action')
            ->rawColumns(['checkbox', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return PromoteCar::query()->with(['user','car','subscribe_package'])->select("promote_cars.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('CarPromotes-table')
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
                    [
                        "extend"=> 'collection',
                        "text"=> __("Export"),
                        "buttons" => [ 'csv', 'excel','print' ]
                    ],
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
            Column::make('subscribe_package.period')
            ->title(__("Period")),
            Column::make('price')
            ->title(__("price")),
            Column::make('weaccept_order_id')
            ->title(__("Order ID")),
            Column::make('car.CarMaker_id')
            ->title(__("Car Maker")),
            Column::make('user.email')
            ->title(__("User Email")),
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
