<?php

namespace App\DataTables;

use App\Models\offer_plan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class Offer_planDatatable extends DataTable
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
            ->editColumn('price', '{{Str::limit($price, 100)}}')
            ->editColumn('offer_plan.title_ar', '{{Str::limit($offer_plan["title_ar"], 100)}}')
            ->editColumn('insurance.name_ar', '{{ Str::limit($insurance["name_ar"], 100) }}')
            ->editColumn('description', '{!! Str::limit($description, 100) !!}')
            ->editColumn('description_ar', '{!! Str::limit($description_ar, 100) !!}')
            ->addColumn('checkbox', 'dashboard.offer-plan.btn.checkbox')
            ->addColumn('action', 'dashboard.offer-plan.btn.action')
            ->rawColumns(['checkbox', 'action', 'description', 'description_ar']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {

        return offer_plan::query()->with("offer_plan", "insurance")->select("offer_plans.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('offer_plans-table')
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
            Column::make('title'),
            Column::make('title_ar'),
            Column::make('offer_plan.title_ar')
                ->title(__("Offer Name")),
            Column::make('insurance.name_ar')
                ->title(__("Insurance Name")),
            Column::make('description'),
            Column::make('description_ar'),
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
        return 'Offer-plans_' . date('YmdHis');
    }
}
