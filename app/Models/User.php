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
        'first_name',
        'last_name',
        'phone',
        'whats_app',
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
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'provider'          => 'nullable|string|max:255',
        ];

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


        if (isset($request->provider)) {
            $credentials['provider'] = $request->provider;
        }

        return $credentials;
    }


    public function role()
    {
      return $this->belongsToMany(Role::class);
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
