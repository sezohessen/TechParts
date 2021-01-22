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
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use LogsActivity;
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


    public static function rules($api=null)
    {
        $rules = [
            'image'             => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240',
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'provider'          => 'nullable|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'country_id'        => 'required|integer',
            'is_phone_virefied' => 'nullable|integer',
            'phone'             => 'required|string|max:255|unique:users',
            'password'          => 'required|string|min:8',

        ];
        if (!$api) {
           $rules['agree'] = 'required';
        }
        return $rules;
    }
    public static function credentials($request)
    {
        $credentials = [
            'first_name'                        => $request->first_name,
            'last_name'                         => $request->last_name,
            'email'                             => $request->email,
            'phone'                             => $request->phone,
            'password'                          => Hash::make($request->password)
        ];
        if($request->file('image')){
            $Image_id = self::file($request->file('Image'));
            $credentials['image_id'] = $Image_id;
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

    public function Agency()
    {
        return $this->hasOne(Agency::class);
    }


}
