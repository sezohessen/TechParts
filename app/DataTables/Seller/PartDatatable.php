<?php

namespace App\DataTables\Seller;

use App\Models\Part;
use App\Models\Seller;
use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PartDatatable extends DataTable
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
            ->addColumn('images', function(Part $part){
                $data = $part->images->first()->image->name;
                return view('SellerDashboard.Part.btn.image', compact('data'));
            })
            ->editColumn('name', '{{ Str::limit($name,100) }}')
            ->editColumn('name_ar', '{{ Str::limit($name_ar,100) }}')
            ->editColumn('car.model.name', function (Part $part) {
                return $part->car->model->name;
            })
            ->editColumn('price', '{{ Str::limit($price)?? "Negotiate" }}')
            ->addColumn('active', 'SellerDashboard.Part.btn.active')
            ->addColumn('checkbox', 'SellerDashboard.Part.btn.checkbox')
            ->addColumn('action', 'SellerDashboard.Part.btn.action')
            ->rawColumns(['checkbox', 'action','active']);


    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Part::query()->with(['car','user','images'])->where('user_id',Auth()->user()->id)->select("parts.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('parts-table')
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
            Column::make('images')
                ->title(__("Image"))
                ->searchable(false),
            Column::make('name')
                ->title(__("Part name(ENG)")),
            Column::make('name_ar')
                ->title(__("Part name(AR)")),
            Column::make('car.model.name')
                ->title(__("Car Model"))
                ->searchable(false),
            Column::make('price')
                ->title(__("Price"))
                ->searchable(false),
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
        return 'Parts_' . date('YmdHis');
    }
}
