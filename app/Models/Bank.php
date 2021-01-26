<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $table    = 'banks';
    protected $fillable=[
        'name',
        'status',
        'color',
        'order',
        'show_finance_services',
        'logo_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function img(){
        return $this->belongsTo(Image::class,'logo_id','id');
    }
    public static function  rules($request,$id = NULL)
    {
        $rules = [
            'name'                  => 'required|string|max:255',
            'logo_id'               => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'user_id'               => 'required',
            'order'                 => 'nullable|numeric',
            'color'                 => 'required'
        ];
        if($id == 'Bank'){//For update in Dashborad
            $rules['logo_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            $rules['status'] = 'required';
        }elseif($id == 'BankDash'){//For Create in Bank Dashboard
            unset($rules['show_finance_services']);
            unset($rules['order']);
            unset($rules['status']);
            unset($rules['user_id']);
        }elseif($id){//For update in Bank Dashboard
            $rules['logo_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            unset($rules['show_finance_services']);
            unset($rules['order']);
            unset($rules['status']);
            unset($rules['user_id']);
        }
        return $rules;
    }
    public static function  credentials($request,$id = NULL,$img_id = NULL,$specialCase = 1)
    {
        $credentials = [
            'name'              =>  $request->name,
            'color'             =>  $request->color,
        ];

        if($id){
            $credentials['user_id'] = $id;
        }else{
            $credentials['user_id'] = $request->user_id;
        }
        if($request->show_finance_services!=NULL&&$request->show_finance_services=='on'&&$specialCase){//Check Box
            $credentials['show_finance_services'] = 1;
        }else{
            $credentials['show_finance_services'] = 0;
        }
        if($request->file('logo_id')){
            if($id){
                $Image_id = self::file($request->file('logo_id'),$img_id);
            }else{
                $Image_id = self::file($request->file('logo_id'));
            }
            $credentials['logo_id'] = $Image_id;
        }else{
            if($id){
                $credentials['logo_id'] = $img_id;
            }
        }
        return $credentials;
    }
    public static function file($file,$id = NULL)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/bank/';
        $file->move($destinationPath, $fileName);
        if($id){//For update
            $Image = Image::find($id);
            //Delete Old image
            try {
                $file_old = $destinationPath.$Image->name;
                unlink($file_old);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
            //Update new image
            $Image->name = $fileName;
            $Image->save();
            return $Image->id;
        }else{
            $Image = Image::create(['name' => $fileName,'base'=>"/img/bank/"]);
            return $Image->id;
        }
    }
}
