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
        $car_badges_ids=[];
        foreach($this->newbadges as $item){
            if ($item->active == 1) {
                $car_badges[]=attr_lang_name($item->name_ar,$item->name);
                $car_badges_ids[]=$item->id;
            }
        }
        $car_features=[];
        $car_features_ids=[];
        foreach($this->newfeatures as $item){
            if ($item->active == 1) {
                $car_features[] = attr_lang_name($item->name_ar,$item->name);
                $car_features_ids[]=$item->id;
            }

        }
        $data= [
            "adsExpire" =>date("Y-m-d",strtotime($this->adsExpire)),
            "badgeList"=>$car_badges,
            "badgeList_ids"=>$car_badges_ids,
            "featureList"=>$car_features,
            "featureList_ids"=>$car_features_ids,
            "isAdminAproved"=> $this->isAdminAproved,
            "counter_view"=> $this->views ? $this->views : 0,
            "counter_clicks"=> $this->clicks ? $this->clicks : 0,
            "bodyStyle"=>$this->body->name,
            "bodyStyle_id"=>$this->body->id,
            "color"=>@$this->color->code,
            "color_id"=>@$this->color->id,
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
            "carModel_id"=>@$this->model->id,
            "CarCapacity"=>@$this->Capacity->capacity,
            "CarCapacity_id"=>@$this->Capacity->id,
            "carMaker"=>@$this->maker->name,
            "carMaker_id"=>@$this->maker->id,
            "carState"=> Car::ApiStatusType()[$this->isNew],
            "carState_id"=> $this->isNew,
            "carYear"=>@$this->year->year,
            "carYear_id"=>@$this->year->id,
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
            "carFuelType_id" => $this->FuelType,
            "bodyStyle"=>$this->body->name,
            "carManufacturing"=>$carMan,
            "carManufacturing_id" => $this->manufacture->id,
            "color"=>@$this->color->code,
            "mLocation"=>[
                "city_name"=>attr_lang_name(@$this->city->title_ar,@$this->city->title),
                "government_name"=>attr_lang_name(@$this->governorate->title_ar,@$this->governorate->title),
                "city_id" => @$this->city->id,
                "government_id" => @$this->governorate->id,
                "latitude"=>$this->lng,
                "longitude"=>$this->lat,
            ],
            "other_costs"=>"",
            "payment_deposit"=> $this->DepositPrice ? intval( $this->DepositPrice) : "",
            "payment_loan_amount"=> $this->InstallmentAmount ? intval( $this->InstallmentAmount) : "" ,
            "payment_loan_period"=> $this->InstallmentPeriod ? intval( $this->InstallmentPeriod) : "",
            "payment_method"=> $payment,
            "serviceHistory"=>$this->ServiceHistory,
            "transmission"=> Car::ApiTransmissionType()[$this->transmission],
            "transmission_id" => $this->transmission
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
