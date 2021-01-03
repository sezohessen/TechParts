<?php
   if(!function_exists('datatable_lang')){
    function datatable_lang(){
      return [
            'sProcessing'     => __('admin.sProcessing'),
            'sLengthMenu'     => __('admin.sLengthMenu'),
            'sZeroRecords'    => __('admin.sZeroRecords'),
            'sEmptyTable'     => __('admin.sEmptyTable'),
            'sInfo'           => __('admin.sInfo'),
            'sInfoEmpty'      => __('admin.sInfoEmpty'),
            'sInfoFiltered'   => __('admin.sInfoFiltered'),
            'sInfoPostFix'    => __('admin.sInfoPostFix'),
            'sSearch'         => __('admin.sSearch'),
            'sUrl'            => __('admin.sUrl'),
            'sInfoThousands'  => __('admin.sInfoThousands'),
            'sLoadingRecords' => __('admin.sLoadingRecords'),
            'oPaginate'       => [
            'sFirst'         => __('admin.sFirst'),
            'sLast'          => __('admin.sLast'),
            'sNext'          => __('admin.sNext'),
            'sPrevious'      => __('admin.sPrevious'),
            ],
            'oAria'            => [
            'sSortAscending'  => __('admin.sSortAscending'),
            'sSortDescending' => __('admin.sSortDescending'),
            ],

    ];
    }
}
