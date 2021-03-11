<?php

namespace App\DataTables\Bank;

use App\Models\BankOffer;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BankOfferDatatable extends DataTable
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
            ->editColumn('name_ar', '{{Str::limit($name_ar, 100)}}')
            ->editColumn('valid_till', '{{Str::limit($valid_till, 100)}}')
            ->editColumn('down_payment_percentage', '{{Str::limit($down_payment_percentage, 100)}}')
            ->editColumn('interest_rate', '{{Str::limit($interest_rate, 100)}}')
            ->editColumn('number_of_years', '{{Str::limit($number_of_years, 100)}}')
            ->editColumn('installment_months', '{{Str::limit($installment_months, 100)}}')
            ->addColumn('checkbox', 'BankDashboard.Bank-offer.btn.checkbox')
            ->addColumn('action', 'BankDashboard.Bank-offer.btn.action')
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
        $bank = Bank::where('user_id', Auth::id())->first();
        return BankOffer::query()->where('bank_id', $bank->id)->select("bank_offers.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('badges-table')
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
            Column::make('id')->title(__('id')),
            Column::make('name')->title(__('Name')),
            Column::make('name_ar'),
            Column::make('valid_till')->title(__('Valid till')),
            Column::make('down_payment_percentage')->title(__('Down Payment(%)')),
            Column::make('interest_rate')->title(__('Interest Rate(%)')),
            Column::make('number_of_years')->title(__('No. years')),
            Column::make('installment_months')->title(__('Installment Months')),
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
        return 'Bank_' . date('YmdHis');
    }
}
