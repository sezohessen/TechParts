<?php

namespace App\DataTables;

use App\Models\City;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Str;

class CityDatatable extends DataTable
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

            ->editColumn('title', '{{Str::limit($title, 100)}}')
            ->editColumn('title_ar', '{{Str::limit($title_ar, 100)}}')
            ->editColumn('country.name_ar', '{{ Str::limit($country["name_ar"], 100) }}')
            ->editColumn('governorate.title_ar', '{{ Str::limit($governorate["title_ar"], 100) }}')
            ->addColumn('checkbox', 'dashboard.City.btn.checkbox')
            ->addColumn('action', 'dashboard.City.btn.action')
            ->addColumn('active', 'dashboard.City.btn.active')
            ->rawColumns(['checkbox', 'action', "active"]);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return City::query()->with("country", "governorate")->select("cities.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Cities-table')
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
            Column::make('title'),
            Column::make('title_ar'),
            Column::make('country.name_ar')
                ->title(__("Country")),
            Column::make('governorate.title_ar')
                ->title(__("Governorate")),
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
        return 'Cities_' . date('YmdHis');
    }
}
