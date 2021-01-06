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
            ->editColumn('salary_through_bank', '{{Str::limit($salary_through_bank, 100)}}')
            ->editColumn('monthly_salary', '{{Str::limit($monthly_salary, 100)}}')
            ->editColumn('paid_loan', '{{Str::limit($paid_loan, 100)}}')
            ->editColumn('existing_loans', '{{Str::limit($existing_loans, 100)}}')
            ->editColumn('provide_amount', '{{Str::limit($provide_amount, 100)}}')
            ->editColumn('user.phone', '{{Str::limit($user["phone"], 100)}}')
            ->editColumn('existing_credit', '{{Str::limit($existing_credit, 100)}}')
            ->editColumn('self_employed', 'dashboard.Finance-request.btn.self_employed')
            ->editColumn('status', 'dashboard.Finance-request.btn.status')
            ->addColumn('checkbox', 'dashboard.Finance-request.btn.checkbox')
            ->addColumn('action', 'dashboard.Finance-request.btn.action')
            ->rawColumns(['checkbox','action','status',"self_employed"]);
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
            Column::make('self_employed'),
            Column::make('salary_through_bank'),
            Column::make('monthly_salary'),
            Column::make('paid_loan'),
            Column::make('existing_loans'),
            Column::make('provide_amount'),
            Column::make('user.phone')
            ->title(__("User Phone")),
            Column::make('existing_credit'),
            Column::computed('action')
            ->title(__('Action'))
            ->exportable(false)
            ->printable(false)
            ->searchable(false)
            ->width(120)
            ->addClass('text-center'),
            Column::computed('status')
            ->title(__('Status'))
            ->exportable(true)
            ->printable(true)
            ->searchable(true)
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
        return 'Finance-requests_' . date('YmdHis');
    }
}
