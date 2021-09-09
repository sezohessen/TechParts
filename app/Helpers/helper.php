<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
   if(!function_exists('datatable_lang')){
        function datatable_lang(){
        return [
                'sProcessing'     => __('Processing...'),
                'sLengthMenu'     => __('Show _MENU_ entries'),
                'sZeroRecords'    => __('No matching records found'),
                'sEmptyTable'     => __('No data available in table'),
                'sInfo'           => __('Showing _START_ to _END_ of _TOTAL_ entries'),
                'sInfoEmpty'      => __('Showing 0 to 0 of 0 entries'),
                'sInfoFiltered'   => __('(filtered from _MAX_ total entries)'),
                'sSearch'         => __('Search:'),
                'sUrl'            => __('Url'),
                'sInfoThousands'  => __(','),
                'sLoadingRecords' => __('Loading...'),
                'oPaginate'       => [
                    'sFirst'         => __('First'),
                    'sLast'          => __('Last'),
                    'sNext'          => __('Next'),
                    'sPrevious'      => __('Previous'),
                ],
                'oAria'            => [
                    'sSortAscending'  => __('Activate to sort column ascending'),
                    'sSortDescending' => __('Activate to sort column descending'),
                ],

            ];
        }
    }
    if(!function_exists('MapTOken')){
        function MapTOken(){
            return "sensor=false&libraries=places&key=AIzaSyDcl_4E5iBaAR4bUuZePK3MIL-pO_oDoCA";
        }
    }
    if(!function_exists('default_lang')){
        function default_lang($lang='en'){
            session()->put('app_locale', $lang);
            App::setLocale($lang);
            return true;
        }
    }
    if(!function_exists('attr_lang_name')){
        function attr_lang_name($attr_ar,$attr){
            return  (Session::get('app_locale')=='ar') ?
                $attr_ar
                :
                $attr;
        }
    }

    if(!function_exists('site_base')){
        function site_base(){
            //return 'https://3arabiat.homeberry.co';
            if(isset($_SERVER['HTTPS'])){
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
            }
            else{
                $protocol = 'http';
            }
            return $protocol . "://" . $_SERVER['HTTP_HOST'] ;
        }
    }
    if(!function_exists('find_image')){
        function find_image($img, $base=null){
            $src= '';
            if (@$img->name and @$img->base) {
                if (strpos($img->base, 'http') !== false or strpos($img->base, 'https') !== false) {
                    $src = $img->base . $img->name ;
                }else{
                    $src = site_base().$img->base.@$img->name;
                }
            }elseif(@$img->name){
                $src = url($img->base.@$img->name);
            }
            return $src;
        }
    }
    if(!function_exists('distance')){
        function distance($lat1, $lon1, $lat2, $lon2, $unit) {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
              return 0;
            }
            else {
              $lat1 = floatval($lat1);
              $lat2 = floatval($lat2);
              $lon1 = floatval($lon1);
              $lon2 = floatval($lon2);

              $theta = $lon1 - $lon2;
              $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $miles = $dist * 60 * 1.1515;
              $unit = strtoupper($unit);

              if ($unit == "K") {
                return ($miles * 1.609344);
              } else if ($unit == "N") {
                return ($miles * 0.8684);
              } else {
                return $miles;
              }
            }
          }
    }
    if(!function_exists('d_constent')){
        function d_constent(){
            return 70;
        }
    }
    if(!function_exists('LangDetail')){
        function LangDetail($eng,$ar){
            return Session::get('app_locale')=='en' ? $eng : $ar;
        }
    }


