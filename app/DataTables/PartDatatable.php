<?php

namespace App\DataTables;

use App\Models\Part;
use App\Models\Seller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
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
                $data = $part->FirstImage->image;
                return view('dashboard.Part.btn.image', compact('data'));
            })
            ->editColumn('user.email', '{{ Str::limit($user["email"]) }}')
            ->editColumn('name', '{{ Str::limit($name) }}')
            ->editColumn('name_ar', '{{ Str::limit($name_ar) }}')
            ->editColumn('car.model.name', function (Part $part) {
                return $part->car->model->name;
            })
            ->editColumn('price', '{{ Str::limit($price) }}')
            ->addColumn('checkbox', 'dashboard.Part.btn.checkbox')
            ->addColumn('action', 'dashboard.Part.btn.action')
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
        if ($this->request()->has("seller_id")) {
            $seller     = Seller::findOrFail($this->request()->seller_id);
            return Part::query()->with(['car','user','images'])->where('user_id', $seller->user_id)->select("parts.*");
        }
        return Part::query()->with(['car','user','images'])->select("parts.*");
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
            Column::make('user.email')
                ->title(__("Email")),
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
