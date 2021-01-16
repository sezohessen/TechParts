<?php
namespace  App\Traits;
trait GeneralTrait {
    public function returnError($msg){
        return response()->json([
            'status'=>false,
            "msg"=>$msg
        ]);
    }
    public function errorField($field){
        $massage = __($field.' field is required');
        return response()->json([
            "msg" => $massage,
            "status" => false
        ]);
    }
    public function errorMessage($massage){
        return response()->json([
            "msg" => __($massage),
            "status" => false
        ]);
    }
    public function returnSuccess($msg=""){
        return response()->json([
            'status'=>true,
            "msg"=>$msg
        ]);
    }
    public function returnData($key,$value,$msg=""){
        return response()->json([
            $key=>$value,
            'status'=>true,
            "msg"=>$msg
        ]);
    }

    public function returnValidationError($validator){
        return $this->returnError($validator->errors()->first());
    }

}
