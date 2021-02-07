<?php

namespace App\DataTables;

use App\Models\Car;
use App\Models\Agency;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AgencyCarDatatable extends DataTable
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
            ->editColumn('country.name_ar', '{{Str::limit($country["name_ar"] ?? 1, 100)}}')
            ->editColumn('maker.name', '{{Str::limit($maker["name"] ?? null, 100)}}')
            ->editColumn('phone', '{{Str::limit($phone, 100)}}')
            ->editColumn('price', '{{Str::limit($price, 100)}}')
            ->editColumn('Description', '{!! Str::limit($Description, 100) !!}')
            ->editColumn('Description_ar', '{!! Str::limit($Description_ar, 100) !!}')
            ->addColumn('checkbox', 'dashboard.Agency.Car.btn.checkbox')
            ->editColumn('SellerType', function ($car) {
                if (($car->user->Agency)) {
                    if ($car->user->Agency->center_type == 0)
                        return Agency::StyleAgecnyType()[0][$car->user->Agency->agency_type];
                    elseif ($car->user->Agency->center_type == 1)
                        return Agency::StyleAgecnyType()[1][$car->user->Agency->agency_type];
                    else
                        return Agency::StyleAgecnyType()[2][0];
                }
            })
            ->addColumn('action', 'dashboard.Agency.Car.btn.action')
            ->addColumn('status', 'dashboard.Agency.Car.btn.status')
            ->rawColumns(['checkbox', 'action', 'SellerType', "Description", "Description_ar", 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {

        return Car::query()->has('agencies')->with(['maker', 'country'])->select("cars.*"); //->where("SellerType","=",0)
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
                        'text' =>
                        '<i class="fa fa-trash"></i> ' . __('Delete All'),
                        'className' => 'dt-button buttons-collection delBtn buttons-page-length'
                    ],
                    [
                        "extend" => 'collection',
                        "text" => __("Export"),
                        "buttons" => ['csv', 'excel', 'print']
                    ],
                ],
                'lengthMenu' =>
                [
                    [10, 25, 50, -1],
                    ['10 ' . __('rows'), '25 ' . __('rows'), '50 ' . __('rows'), __('Show all')]
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
            Column::make('country.name_ar')
                ->title(__("Country")),
            Column::make('maker.name')
                ->title(__("Car Make")),
            Column::make('phone')
                ->title(__("User Phone")),
            Column::make('price')->title(__("Price")),
            Column::make('Description')
                ->title(__("Description (EN)"))
                ->width(70),
            Column::make('Description_ar')
                ->title(__("Description (AR)"))
                ->width(70),
            Column::computed('SellerType')
                ->title(__('Seller Type'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(120)
                ->addClass('text-center'),
            Column::computed('status')
                ->title(__('Status'))
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
