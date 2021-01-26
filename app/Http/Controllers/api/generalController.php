<?php

namespace App\Http\Controllers\api;

use App\Models\Image;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class generalController extends Controller
{
    //
    use GeneralTrait;

    public function upload_file(Request $request)
    {
        if ($request->lang) {
            $locale = $request->lang;
            if (in_array($locale, ['ar', 'en'])) {
                default_lang($locale);
            } else {
                default_lang();
            }
        } else {
            default_lang();
        }
        $validator  = Validator::make((array) $request->all(), [
            'file'          => 'required|image|mimes:jpeg,jpg,png,gif|max:10240',
            'type_of_page' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return $this->ValidatorMessages($validator->errors()->getMessages());
        }
        $file = $request->file;
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        switch ($request->type_of_page) {
            case 'user':
                $type_of_page ='/img/users/';
                break;

            case 'car':
                $type_of_page ='/img/cars/';
                break;

            default:
                $type_of_page ='/img/unknow/';
                break;
        }
        $destinationPath = public_path() . $type_of_page;
        $file->move($destinationPath, $fileName);
        $Image = Image::create(['name' => $fileName, 'base' => '/img/users/']);
        return $this->returnData('file_url',find_image($Image) ,__('File Uploaded Successfully') );
    }
}
