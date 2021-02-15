<?php

namespace App\Http\Resources;

use App\Models\Car;
use App\Models\Image;
use App\Models\Agency;
use App\Models\Badges;
use App\Models\Feature;
use App\Models\AgencyReview;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected $type;
    public function type($value){
        $this->type = $value;
        return $this;
    }
    public function toArray($request)
    {


        if($this->type==1){
            return $this->details();
        }
        elseif($this->type==2)  {

            return $this->item();
        }
        elseif($this->type==3){

            $data=[
                "carFuelType"=>Car::ApiFuelType()[$this->FuelType],
                "transmission"=>Car::ApiTransmissionType()[$this->transmission]
            ];
            return array_merge($this->item(),$data);
        } elseif($this->type==4){
            $data=[
                "promotedExpire"=>$this->promotedExpire,
            ];
            return array_merge($this->details(),$data);
        }
        else {
            return $this->type;
        }

    }
    public function item(){
        $car_badges=[];
        foreach($this->badges as $item){
            ($badge=Badges::where('active', '=', 1)->find($item->badge_id))?$car_badges[]=attr_lang_name($badge->name_ar,$badge->name):'';
        }
        $car_features=[];
        foreach($this->features as $item){
            ($feature=Feature::where('active', '=', 1)->find($item->feature_id))? $car_features[]=attr_lang_name($feature->name_ar,$feature->name):'';
        }
        $data= [
            "adsExpire" =>date("Y-m-d",strtotime($this->adsExpire)),
            "badgeList"=>$car_badges,
            "featureList"=>$car_features,
            "isAdminAproved"=> $this->isAdminAproved,
            "counter_view"=> $this->views ? $this->views : 0,
            "counter_clicks"=> $this->clicks ? $this->clicks : 0,
            "bodyStyle"=>$this->body->name,
            "color"=>@$this->color->code,
        ];
        return array_merge($this->common(),$data);
    }
    public function common(){

        $price= $this->price-($this->price_after_discount*0.01*($this->price));

        $images=[];
        foreach($this->photos as $item){
            $images[]= find_image($item);
        }
        $data=[
            "carModel"=>@$this->model->name,
            "carMaker"=>@$this->maker->name,
            "carState"=> Car::ApiStatusType()[$this->isNew],
            "carYear"=>@$this->year->year,
            "id"=>$this->id,
            "imageList"=>$images,
            "isAccident"=>($this->AccidentBefore) ? true :false,
            "mContact"=> [
                "phone"=>$this->phone,
                "whats"=>$this->whats
            ],
            "price"=> (int)$price,
            "price_before_discount"=> $this->price,
            "promotedStatus"=> ($this->promotedStatus)?true:false,
            "used_kilometers"=> intval($this->kiloUsed)
        ];
        return array_merge($this->Incoming_user_feature(),$data);
    }


    public static function collection($resource){
        return new CarCollection($resource);
    }
    public function details(){
        $carMan=attr_lang_name($this->manufacture->name_ar,$this->manufacture->name);
        $payment=Car::ApiPaymentType()[$this->payment];
        $data = [
            "aboutCar" =>attr_lang_name($this->Description_ar,$this->Description),
            "carFuelType"=>Car::ApiFuelType()[$this->FuelType],
            "bodyStyle"=>$this->body->name,
            "carManufacturing"=>$carMan,
            "color"=>@$this->color->code,
            "mLocation"=>[
                "city_name"=>attr_lang_name(@$this->city->title_ar,@$this->city->title),
                "government_name"=>attr_lang_name(@$this->governorate->title_ar,@$this->governorate->title),
                "latitude"=>$this->lng,
                "longitude"=>$this->lat,
            ],
            "other_costs"=>"",
            "payment_deposit"=> intval( $this->DepositPrice),
            "payment_loan_amount"=> intval($this->InstallmentAmount)  ,
            "payment_loan_period"=> intval($this->InstallmentPeriod) ,
            "payment_method"=> $payment,
            "serviceHistory"=>$this->ServiceHistory,
            "transmission"=> Car::ApiTransmissionType()[$this->transmission]
            //CarCapacity_id
            //SellerType
        ];
        $distributor=$this->CarUserFeature();
        return array_merge($this->item(),$data,$distributor);
    }
    public function Incoming_user_feature(){
        $isalert=false;
        $isfav=false;
        if($auth=auth('sanctum')->user()){
            $alert=$this->AuthAlertCar()->wherePivot('user_id','=',$auth->id)->get()->first();
            $fav=$this->AuthFavCar()->wherePivot('user_id','=',$auth->id)->get()->first();
            if($alert)
                $isalert=($alert->pivot->status) ? true : false;
            if($fav)
                $isfav=true;
        }
        return [
            "isAlertBefore"=>$isalert,
            "isFavorite"=>$isfav,
        ];
    }
    public function CarUserFeature(){


        $image= find_image(@$this->user->image);
        $userType= "individual" ;
        if(($this->user->Agency) ){
            if($this->user->Agency->center_type == Agency::Ag_Agency){
                $userType=Agency::ApiAgecnyType()[$this->user->Agency->agency_type];
                $image = find_image(@$this->user->Agency->img) ;
                $rate   = AgencyReview::where('agency_id',$this->user->Agency->id)
                ->selectRaw('SUM(rate)/COUNT(user_id) AS avg_rating')
                ->first()
                ->avg_rating;
                return
                [   "mDistributor"=>
                    [
                        "image"=>$image,
                        "name"=>attr_lang_name($this->user->Agency->name_ar,$this->user->Agency->name),
                        "rate"=> floatval($rate),
                        "userId"=>$this->user->id,
                        "userType"=>$userType
                    ]
                 ];
            }
        }
        return
        [   "mDistributor"=>
            [
                "rate"=> 0,
                "image"=>$image,
                "name"=>$this->user->first_name." ".$this->user->last_name,
                "userId"=>$this->user->id,
                "userType"=>$userType
            ]
         ];


    }

}
