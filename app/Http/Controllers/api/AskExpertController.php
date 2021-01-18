<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AskExpert;
use App\Models\News;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AskExpertController extends Controller
{
    use GeneralTrait;
    public function create(Request $request)
    {
        if ($locale = $request->lang) {
            if (in_array($locale, ['ar', 'en']) ) {
                default_lang($locale);
            }else {
                default_lang();
            }
        }else {
            default_lang();
        }
        dd(auth()->user() );
        $askExpert = AskExpert::create([
            'message' => $request->question,
        ]);
        return $this->returnSuccess(__("Team Support will contact you soon."));
    }
}
