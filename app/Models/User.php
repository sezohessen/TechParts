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
    use LaratrustUserTrait, HasApiTokens, HasFactory, Notifiable;
    protected static $recordEvents = ['created'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    const SellerRole        = 'seller';
    const UserRole          = 'user';
    const InitialBase       = '/img/avatar/user-profile.png';
    protected $fillable = [
        'first_name',
        'last_name',
        'email_verified_at',
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


    public static function rules($api=null,$edit_profile=null)
    {

        $rules = [
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'provider'          => 'nullable|string|max:255',
            'whats_app'         => 'nullable|string|digits:11|unique:users,whats_app,'.$edit_profile,
        ];

        if ($edit_profile) {
           $rules['email']      = 'required|string|max:255|unique:users,email,'.$edit_profile;
           $rules['password']   = 'nullable|string|min:8';
        }else {
            $rules['email']     = 'required|string|email|max:255|unique:users';
            $rules['phone']     = 'required|string|digits:11|unique:users,phone'.$edit_profile;
            $rules['password']  = 'required|string|min:8';
        }
        return $rules;
    }
    public static function credentials($request,$FromEdit = NULL)
    {
        $credentials = [
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'whats_app'             => $request->whats_app,
            'password'              => Hash::make($request->password)
        ];
        if($FromEdit)unset($credentials['password']);
        return $credentials;
    }


    public function role()
    {
      return $this->belongsToMany(Role::class);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class,'list_car_users','user_id','car_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
    public function favorite()
    {
      return $this->belongsToMany(Part::class,'users_favorite','user_id','part_id');
    }
}
