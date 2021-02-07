<?php

namespace App\DataTables;

use App\Models\Finance_request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class Finance_requestDatatable extends DataTable
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
            ->editColumn('salary_through_bank', 'dashboard.Finance-request.btn.salary_through_bank')
            ->editColumn('paid_loan', 'dashboard.Finance-request.btn.paid_loan')
            ->editColumn('existing_loans', 'dashboard.Finance-request.btn.existing_loans')
            ->editColumn('existing_credit', 'dashboard.Finance-request.btn.existing_credit')
            ->editColumn('user.phone', '{{Str::limit($user["phone"], 100)}}')
            ->editColumn('self_employed', 'dashboard.Finance-request.btn.self_employed')
            ->editColumn('status', '{{Str::limit($status, 100)}}')
            ->addColumn('checkbox', 'dashboard.Finance-request.btn.checkbox')
            ->addColumn('action', 'dashboard.Finance-request.btn.action')
            ->rawColumns([
                'checkbox', 'action', 'status', "self_employed", 'salary_through_bank',
                'paid_loan', 'existing_loans', 'existing_credit'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {

        return Finance_request::query()->with("user")->select("finance_requests.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Finance_requests-table')
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
            Column::make('self_employed'),
            Column::make('salary_through_bank'),
            Column::make('paid_loan'),
            Column::make('existing_loans'),
            Column::make('existing_credit'),
            Column::make('user.phone')
                ->title(__("User Phone")),
            Column::computed('status')
                ->title(__('Status'))
                ->exportable(true)
                ->printable(true)
                ->searchable(true)
                ->width(120)
                ->addClass('text-center'),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Finance-requests_' . date('YmdHis');
    }
}
