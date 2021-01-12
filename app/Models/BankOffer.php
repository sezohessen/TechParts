<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankOffer extends Model
{
    use HasFactory;
    protected $table    = 'bank_offers';
    protected $fillable=[
        'name',
        'name_ar',
        'description',
        'description_ar',
        'valid_till',
        'down_payment_percentage',
        'interest_rate',
        'number_of_years',
        'installment_months',
        'bank_id',
        'logo_id'
    ];
    public function img(){
        return $this->belongsTo(Image::class,'logo_id','id');
    }
    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id','id');
    }
    public static function  rules($request,$id = NULL)
    {
        $rules = [
            'name'                      => 'required|string|max:255',
            'name_ar'                   => 'required|string|max:255',
            'logo_id'                   => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'description'               => 'required|min:3|max:1000',
            'description_ar'            => 'required|min:3|max:1000',
            'valid_till'                => 'required|date|after:today',
            'down_payment_percentage'   => 'required|numeric|min:0|max:100',
            'interest_rate'             => 'required|numeric|min:0|max:100',
            'installment_months'        => 'required|numeric|min:0|max:500',
            'number_of_years'           => 'required|numeric|min:0|max:100',
            'bank_id'                   => 'required',
        ];
        if($id == 'Bank-offer'){//For update in Dashborad
            $rules['logo_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
        }elseif($id){//For update in Insurance Dashboard
            $rules['logo_id'] = 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048';
            unset($rules['user_id']);
        }
        return $rules;
    }
    public static function  credentials($request,$id = NULL,$img_id = NULL)
    {
        $credentials = [
            'name'                          =>  $request->name,
            'name_ar'                       =>  $request->name_ar,
            'description'                   =>  $request->description,
            'description_ar'                =>  $request->description_ar,
            'valid_till'                    =>  $request->valid_till,
            'down_payment_percentage'       =>  $request->down_payment_percentage,
            'interest_rate'                 =>  $request->interest_rate,
            'installment_months'            =>  $request->installment_months,
            'number_of_years'               =>  $request->number_of_years,
        ];
        if($id){
            $credentials['bank_id'] = $id;
        }else{
            $credentials['bank_id'] = $request->bank_id;
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
        $destinationPath = public_path() . '/img/bank-offer/';
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
            $Image = Image::create(['name' => $fileName]);
            return $Image->id;
        }
    }
}
