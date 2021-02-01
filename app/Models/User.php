<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use LaratrustUserTrait, LogsActivity, HasApiTokens, HasFactory, Notifiable;
    protected static $logAttributes = ['first_name',"phone","email"];
    protected static $recordEvents = ['created'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_id',
        'first_name',
        'last_name',
        'country_code',
        'country_phone',
        'is_phone_virefied',
        'phone',
        'whats_app',
        'interest_country',
        'email',
        'password',
    ];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "User has been {$eventName}";
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function rules($api=null,$edit_profile=null,$email_not_unique=null)
    {

        $rules = [
            'image'             => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240',
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'provider'          => 'nullable|string|max:255',
            'is_phone_virefied' => 'nullable|integer',
        ];
        if (!$api) {
           $rules['image'] = 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240';
           $rules['agree'] = 'required';
           $rules['country_id'] = 'required|integer';
        }else {

            $rules['image'] = 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240';
            $rules['country_code'] = 'required|string';
            $rules['country_number'] = 'required|string';
        }
        if ($edit_profile) {
           $rules['email'] = 'required|string|max:255|unique:users,email,'.$edit_profile;
           //$rules['phone'] = 'required|string|max:255|unique:users,phone,'.$edit_profile;
        }else {
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['phone'] = 'required|string|max:255|unique:users';
            $rules['password'] = 'required|string|min:8';
        }
        return $rules;
    }
    public static function credentials($request,$api=null,$edit_profile=null)
    {
        $credentials = [
            'first_name'                        => $request->first_name,
            'last_name'                         => $request->last_name,
            'email'                             => $request->email,
        ];
        if (!$edit_profile) {
            $credentials['password'] =Hash::make($request->password);
            $credentials['phone'] = $request->phone;
        }
        if (!$api) {
            if(property_exists($request, 'file') ){
                $Image_id = self::file($request->file('image_id'));
                $credentials['image_id'] = $Image_id;

            }
        }else {
            if($request->image){
                $Image_id = self::fileApi($request->image);
                $credentials['image_id'] = $Image_id;
            }
        }
        if ( isset($request->is_phone_virefied) ) {
            $credentials['is_phone_virefied'] = $request->is_phone_virefied;
        }
        if (isset($request->country_id) ) {
            $country = Country::find($request->country_id);
            if ($country) {
                $credentials['country_code'] = $country->code;
                $credentials['country_phone'] = $country->country_phone;
            }
        }
        if ($api) {
            $country = Country::where('code', $request->country_code)->first();
            if ($country) {
                $credentials['country_code'] = $country->code;
                $credentials['country_phone'] = $country->country_phone;
            }else {
                $credentials['country_code'] = $request->country_code;
                $credentials['country_phone'] = $request->country_number;
            }
        }
        if (isset($request->interest_country) ) {
            $credentials['interest_country'] = $request->interest_country;
        }
        if (isset($request->provider)) {
            $credentials['provider'] = $request->provider;
        }

        return $credentials;
    }

    public static function file($file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . rand(11111, 99999) . '.' . $extension;
        $destinationPath = public_path() . '/img/users/';
        $file->move($destinationPath, $fileName);
        $Image = Image::create(['name' => $fileName, 'base' => '/img/users/']);
        return $Image->id;
    }
    public static function fileApi($file)
    {
        $img=parse_url($file);
        if (is_array($img) and  $img['path']) {
            $array = explode('/',$img['path']);
            $image_name = end($array);
            $path = str_replace($image_name,'',$img['path']);
            $old_image = Image::where(['name' => $image_name, 'base' => $path])->first();
            if ($old_image) {
                return $old_image->id;
            }
            $Image = Image::create(['name' => $image_name, 'base' => $path]);
            return $Image->id;
        }
    }

    public function role()
    {
      return $this->belongsToMany(Role::class);
    }

    public function interestCountry()
    {
        return $this->belongsTo(Country::class, 'interest_country', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    public function AuthFavCar()
    {
        return $this->belongsToMany(Car::class, 'user_fav_cars', 'user_id','car_id');
    }
    public function agencyFav()
    {
        return $this->belongsToMany(Agency::class,'user_fav_agencies','user_id','agency_id')
        ->where('agencies.center_type',Agency::center_type_Agency);
    }
    public function MaintenanceFav()
    {
        return $this->belongsToMany(Agency::class,'user_fav_agencies','user_id','agency_id')
        ->where('agencies.center_type',Agency::center_type_Maintenance);
    }
    public function cars()
    {
        return $this->belongsToMany(Car::class,'list_car_users','user_id','car_id');
    }

    public function List_cars()
    {
        return $this->belongsToMany(Car::class,'list_car_users','car_id','user_id');
    }
    public function Agency()
    {
        return $this->hasOne(Agency::class);
    }


}
