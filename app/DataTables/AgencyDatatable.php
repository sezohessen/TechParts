<?php

namespace App\DataTables;

use App\Models\Agency;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AgencyDatatable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $counter = 0;
        return datatables()
            ->eloquent($query)
            ->editColumn('name', '{{Str::limit($name, 100)}}')
            ->editColumn('name_ar', '{{Str::limit($name_ar, 100)}}')
            ->editColumn('user.email', '{{Str::limit($user["email"], 100)}}')
            ->editColumn('center_type', 'dashboard.Agency.btn.center_type')
            ->addColumn('checkbox', 'dashboard.Agency.btn.checkbox')
            ->addColumn('action', 'dashboard.Agency.btn.action')
            ->addColumn('active', 'dashboard.Agency.btn.active')
            ->editColumn('view', function($agency) {
                if(($agency->Car->count()) ){
                   return  "<a href='".route('dashboard.agency.show',['agency'=>$agency->id,'agency_id'=>$agency->id])."' target='_blank'><i class='fa fa-eye'></i></a>";
                }

             })
            ->rawColumns(['checkbox', 'action', 'center_type','active','view']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        if ($this->request()->has("center_type")) {
            return Agency::query()->with("user")->where("center_type",request('center_type'))->select("agencies.*");
        }
            return Agency::query()->with("user")->select("agencies.*");

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('agency-table')
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
            Column::make('name')->title(__('Name')),
            Column::make('name_ar'),
            Column::make('user.email')
                ->title(__("User Email")),
            Column::make('center_type'),
            Column::computed('active')
            ->title(__('Active'))
            ->exportable(false)
            ->printable(false)
            ->searchable(false)
            ->width(120)
            ->addClass('text-center'),
            Column::computed('view')
            ->title(__('Own Cars'))
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
        return 'Agency_' . date('YmdHis');
    }
}
